<?php


namespace App\Services;


use App\Entity\Matches;
use App\Entity\User;
use App\Message\AnalyzeDemo;
use App\Message\DownloadDemo;
use App\Message\SaveDemo;
use App\Middleware\CloudflareMiddleware;
use App\SteamApi\Command\CSGOPlayers\GetNextMatchSharingCode;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\FileCookieJar;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Steam\Steam;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Process\Process;

class Demo implements LoggerAwareInterface
{
    /**
     * @var string
     */
    public string $matchesDir;

    /**
     * @var string
     */
    public string $projectDir;

    /**
     * @var LoggerInterface
     */
    public LoggerInterface $logger;

    /**
     * Demo constructor.
     * @param EntityManagerInterface $entityManager
     * @param MessageBusInterface $bus
     * @param SharecodeDecoder $sharecodeDecoder
     * @param JsonImporter $jsonImporter
     * @param Steam $steam
     * @param Client $client
     * @param string $matchesDir
     * @param string $projectDir
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MessageBusInterface $bus,
        private readonly SharecodeDecoder $sharecodeDecoder,
        private readonly JsonImporter $jsonImporter,
        private readonly Steam $steam,
        private readonly Client $client,
        string $matchesDir,
        string $projectDir
    ) {
        $this->matchesDir = $matchesDir;
        $this->projectDir = $projectDir;
    }

    /**
     * @param AnalyzeDemo $message
     * @param OutputInterface|null $output
     * @return int
     */
    public function AnalyzeDemo(AnalyzeDemo $message, ?OutputInterface $output = null): int
    {
        if ($message->getMatchId() === 'all') {
            $aMatch = $this->entityManager->getRepository(Matches::class)->findBy(
                ['downloaded' => true],
                ['updatedAt' => 'ASC']
            );
            foreach ($aMatch as $oMatch) {
                $this->Analyze($oMatch);
                $output->writeln($oMatch->getId().' analyzed');
            }

            return Command::SUCCESS;
        }
        if (null === $message->getMatchId()) {
            /** @var Matches[] $aMatch */
            $aMatch = $this->entityManager->getRepository(Matches::class)->findBy(
                ['downloaded' => true, 'analyzed' => false],
                ['updatedAt' => 'ASC'],
                1
            );
            if (empty($aMatch)) {
                return Command::SUCCESS;
            }
            $oMatch = $aMatch[0];
        } else {
            /** @var Matches $oMatch */
            $oMatch = $this->entityManager->getRepository(Matches::class)->find($message->getMatchId());
            if (is_file($this->matchesDir.$oMatch->getId().'.dem')) {
                $oMatch->setDownloaded(true);
            }
            if (!$oMatch->isDownloaded()) {
                return Command::FAILURE;
            }
        }
        $this->Analyze($oMatch);

        return Command::SUCCESS;
    }

    private function Analyze(Matches $oMatch): int
    {
        $outputfile = $this->matchesDir.$oMatch->getId().'/stats.json';
        if (!is_file($this->matchesDir.$oMatch->getId().'.dem')) {
            $oMatch->setDownloaded(false);
            $this->saveMatch($oMatch);
            throw new DirectoryNotFoundException(
                "MatchDirectory: ".$this->matchesDir.$oMatch->getId()." does not exist"
            );
        }
        $process = new Process(['node', 'custom_assets/node/analyze-demo.js', $oMatch->getId()]);
        $process->start();
        while ($process->isRunning()) {
        }

        preg_match('/panic/', $process->getOutput(), $matches);
        if (!empty($matches)) {
            $oMatch->setDownloaded(false);
            $this->saveMatch($oMatch);
            throw new DirectoryNotFoundException($oMatch->getId()." download not successful");
        }
        if (is_file($outputfile)) {
            $oMatch->setAnalyzed(true);
            $this->saveMatch($oMatch);
        } else {
            $oMatch->setDownloaded(false);
            $this->saveMatch($oMatch);
            throw new DirectoryNotFoundException($outputfile." failed to analyze");
        }
        $this->saveMatch($oMatch);
        $this->logger->info("analyzed MatchId:".$oMatch->getId());

        $this->bus->dispatch(new SaveDemo($oMatch->getId(), true));

        return Command::SUCCESS;
    }

    /**
     * @param DownloadDemo $message
     * @return int
     * @throws \Exception
     */
    public function DownloadDemo(DownloadDemo $message): int
    {
        if (null === $message->getMatchId()) {
            /** @var Matches[] $oMatch */
            $oMatch = $this->entityManager->getRepository(Matches::class)->findBy(
                ['downloaded' => false],
                ['updatedAt' => 'ASC'],
                1
            );
            if (empty($oMatch)) {
                /** @var Matches[] $oMatch */
                $oMatch = $this->entityManager->getRepository(Matches::class)->findBy(
                    ['downloaded' => true, 'analyzed' => false],
                    ['updatedAt' => 'ASC'],
                    1
                );
                if (empty($oMatch)) {
                    return Command::SUCCESS;
                }
            }
            $match = $oMatch[0];
        } else {
            $match = $this->entityManager->getRepository(Matches::class)->find($message->getMatchId());
        }

        $process = new Process(['node', 'custom_assets/node/download-demo.js', $match->getShareCode(), $match->getId()],
            $this->projectDir,
            null,
            null,
            360);
        $process->mustRun();
        while ($process->isRunning()) {
        }
        preg_match('/Game played at:\s(.*)/', $process->getOutput(), $matches);
        if (!empty($matches)) {
            $timestamp = (int)trim($matches[1]);
            $date = new \DateTimeImmutable();
            $matchTime = $date->setTimestamp($timestamp);
            $match->setMatchTime($matchTime);
        }
        $sharecode = $this->sharecodeDecoder->decode($match->getShareCode());
        $match->setMatchId($sharecode['matchId']);
        $match->setOutcomeId($sharecode['outcomeId']);
        if (is_file($this->matchesDir.$match->getId().'.dem') && filesize(
                $this->matchesDir.$match->getId().'.dem'
            ) > 0) {
            $match->setDownloaded(true);
            $match->setCorrupt(false);
        } else {
            $match->setCorrupt(true);
            $this->entityManager->persist($match);
            $this->entityManager->flush();

            return Command::FAILURE;
        }
        $match->setTokenId($sharecode['tokenId']);
        $this->entityManager->persist($match);
        $this->entityManager->flush();
        $this->logger->info("downloaded MatchId:".$match->getId());
        if (is_file($this->matchesDir.$match->getId().'.dem')) {
            /*$analyzeddemo = new AnalyzeDemo($match->getId());
            $this->bus->dispatch(
                (new Envelope($analyzeddemo))
                    ->with(new DispatchAfterCurrentBusStamp())
            );*/
        }

        //$this->bus->dispatch(new AnalyzeDemo($match->getId()));
        return Command::SUCCESS;
    }

    /**
     * @param SaveDemo $message
     * @param OutputInterface|null $output
     * @return int
     */
    public function saveDemo(SaveDemo $message, ?OutputInterface $output = null): int
    {
        if ($message->getMatchId() === 'all') {
            $aMatch = $this->entityManager->getRepository(Matches::class)->findBy(
                ['downloaded' => true, 'analyzed' => true],
                ['updatedAt' => 'ASC']
            );
            /** @var Matches $oMatch */
            foreach ($aMatch as $oMatch) {
                $this->jsonImporter->run($oMatch->getId());
                $oMatch->setUpdatedAt(new \DateTime());
                $oMatch->setSaved(true);
                $output->writeln($oMatch->getId().' saved');
            }

            return Command::SUCCESS;
        }

        if (null === $message->getMatchId()) {
            if ($message->isForce()) {
                $aMatch = $this->entityManager->getRepository(Matches::class)->findBy(
                    ['downloaded' => true, 'analyzed' => true],
                    ['updatedAt' => 'ASC'],
                    1
                );
            } else {
                /** @var Matches[] $aMatch */
                $aMatch = $this->entityManager->getRepository(Matches::class)->findBy(
                    ['downloaded' => true, 'analyzed' => true, 'saved' => false],
                    ['updatedAt' => 'ASC'],
                    1
                );
            }
            if (empty($aMatch)) {
                return Command::SUCCESS;
            }
            $oMatch = $aMatch[0];
        } else {
            /** @var Matches $oMatch */
            $oMatch = $this->entityManager->getRepository(Matches::class)->find($message->getMatchId());
            if (!$oMatch->isAnalyzed()) {
                return Command::FAILURE;
            }
        }

        try {
            $this->jsonImporter->run($oMatch->getId());
            $oMatch->setUpdatedAt(new \DateTime());
            $oMatch->setSaved(true);
        } catch (DirectoryNotFoundException $e) {
            $oMatch->setAnalyzed(false);
        }

        $this->entityManager->persist($oMatch);
        $this->entityManager->flush();
        $this->logger->info("saved MatchId:".$oMatch->getId());

        return Command::SUCCESS;
    }

    public function searchDemo(): int
    {
        /** @var User $user */
        $user = $this->entityManager->getRepository(User::class)->findOneWithKnownCode();
        if ($user instanceof User) {
            $demorequest = new GetNextMatchSharingCode();
            $demorequest->setKnowncode($user->getKnownCode());
            $demorequest->setSteamid($user->getSteamId());
            $demorequest->setSteamidkey($user->getSteamKey());
            $response = $this->steam->run($demorequest);
            if (null !== $response["result"]) {
                $matchcode = $response["result"]["nextcode"];
                if ($matchcode == "n/a") {
                    $user->setLastdemosearch(new \DateTimeImmutable());
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();

                    return Command::SUCCESS;
                }
                if (!$match = $this->entityManager->getRepository(Matches::class)->findOneBy(
                    ['shareCode' => $matchcode]
                )) {
                    $match = new Matches();
                    $match->setShareCode($matchcode);
                    $this->entityManager->persist($match);
                    $this->entityManager->flush();
                    $user->setLastDemoFound(new \DateTimeImmutable());
                }
                $user->setKnownCode($matchcode);
                $user->setLastdemosearch(new \DateTimeImmutable());
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $this->logger->info("new Match with ID:".$match->getId());
                $this->bus->dispatch(new DownloadDemo($match->getId()));
            }
        }

        return COMMAND::SUCCESS;
    }

    public function downloadHltvDemo()
    {
        $resource = fopen($this->matchesDir.'84201.rar', 'w');
        $client = new Client(['cookies' => new FileCookieJar('cookies.txt')]);
        $stream = \GuzzleHttp\Psr7\Utils::streamFor($resource);
        $client->getConfig('handler')->push(CloudflareMiddleware::create());
        $request = $client->request('GET', 'https://www.hltv.org/download/demo/84201', [
            'allow_redirects' => [
                'max' => 10,        // allow at most 10 redirects.
                'strict' => true,      // use "strict" RFC compliant redirects.
                'referer' => true,      // add a Referer header
                'protocols' => ['https'], // only allow https URLs
                'track_redirects' => true,
            ],
        ]);
        dd($request);
    }

    /**
     * @param Matches $match
     */
    protected function saveMatch(Matches $match): void
    {
        $this->entityManager->persist($match);
        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}