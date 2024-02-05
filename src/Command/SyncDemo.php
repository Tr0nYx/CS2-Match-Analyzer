<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\RequestOptions;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

#[AsCommand(
    name: 'demo:sync',
    description: 'Sync Demo',
)]
class SyncDemo extends Command
{
    use LockableTrait;

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return Command::SUCCESS;
        }
        $this->getMatch();

        return Command::SUCCESS;
    }

    private function getMatch(): void
    {
        $headers = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36',
        ];
        $url = 'results?content=vod';
        $client = new Client([
            'base_uri' => 'https://www.hltv.org/',
            RequestOptions::HEADERS => $headers,
            'cookies' => true,
            'http_errors' => false,
        ]);
        $request = $client->request('get', $url);

        $crawler = new Crawler();
        $crawler->addHtmlContent($request->getBody()->getContents());
        $content = $crawler->filter('.results-all')->filter('a.a-reset');
        $nodeValues = $content->each(function (\Symfony\Component\DomCrawler\Crawler $node, $i) {
            preg_match('/\/matches\/(.*)/', $node->attr('href'), $match);
            if (sizeof($match) !== 0) {
                return $match[0];
            }
        });
        $crawler->clear();
        foreach ($nodeValues as $matchUrl) {
            $request = $client->request('get', $matchUrl);
            $crawler = new Crawler();
            $crawler->addHtmlContent($request->getBody()->getContents());
            $content = $crawler->filter('.streams')->filter('.stream-box')->first()->filter('a');
            if (strtolower($content->text()) == 'gotv demo') {
                $href = $content->attr('href');
                $id = explode('/', $href)[3];
                $resource = fopen('./custom_assets/matches/'.$id.'.rar', 'w');
                $stream = Utils::streamFor($resource);
                $client->request('get', $href, ['save_to' => $stream]);

            }
            dd();
        }
    }
}
