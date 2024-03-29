<?php

namespace App\Services;

use App\Entity\Skin;
use App\Entity\User;
use App\Entity\UserSkin;
use App\Repository\SkinRepository;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

readonly class SteamSkinService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private Client $client,
        private SkinRepository $skinRepository
    ) {
    }

    public function getSkinPrice(): void
    {
        $skin = $this->skinRepository->findOneBy([], ['lastPriceCheck' => 'ASC']);
        if (str_contains($skin->getMarketHashName(), 'Graffiti') && !str_contains(
            $skin->getMarketHashName(),
            'Sealed'
        )) {
            $skin->setLastPriceCheck(new \DateTimeImmutable());
            $this->entityManager->persist($skin);
            $this->entityManager->flush();
            echo "unsealed graffiti";

            return;
        }
        $url = 'https://steamcommunity.com/market/priceoverview/?appid='.$skin->getAppid(
        ).'&market_hash_name='.$skin->getMarketHashName();
        $request = $this->client->get($url);
        $result = json_decode($request->getBody()->getContents());
        if ($request->getStatusCode() !== Response::HTTP_OK) {
            $skin->setLastPriceCheck(new \DateTimeImmutable());
            $this->entityManager->persist($skin);
            $this->entityManager->flush();

            return;
        }
        if (!$result->success) {
            $skin->setLowestPrice(0);
            $skin->setMedianPrice(0);
        } else {
            if (isset($result->lowest_price)) {
                $lowestPrice = substr($result->lowest_price, 1, strlen($result->lowest_price) - 1);
                $skin->setLowestPrice((float)$lowestPrice);
            }
            if (isset($result->median_price)) {
                $medianPrice = substr($result->median_price, 1, strlen($result->median_price) - 1);
                $skin->setMedianPrice((float)$medianPrice);
            }
        }
        $skin->setLastPriceCheck(new \DateTimeImmutable());
        $this->entityManager->persist($skin);
        $this->entityManager->flush();
    }

    /**
     * @param User $user
     * @return array
     * http://steamcommunity.com/profiles/<PROFILEID>/inventory/json/753/6
     */
    public function getInventory(User $user): array
    {
        $date = new \DateTime();
        $date->sub(new \DateInterval('P1D'));
        $url = 'https://steamcommunity.com/inventory/'.$user->getSteamId().'/730/2';
        if ($user->getLastInventoryUpdate() < $date) {
            $request = $this->client->get($url);
            if ($request->getStatusCode() === Response::HTTP_OK) {
                $inventory = json_decode($request->getBody()->getContents());
                if ($inventory !== null) {
                    $items = $inventory->descriptions;
                    $this->importSkins($user, $items);
                }
                $user->setLastInventoryUpdate(new \DateTimeImmutable());
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }
        }

        return $this->entityManager->getRepository(User::class)->getInventory($user);
    }

    /**
     * @param $user
     * @param $items
     * @return void
     */
    private function importSkins($user, $items): void
    {
        foreach ($items as $item) {
            if (!$skin = $this->skinRepository->findOneBy(
                ['classid' => $item->classid, 'instanceid' => $item->instanceid]
            )) {
                $skin = new Skin();
            }
            $skin->setAppid($item->appid);
            $skin->setClassid($item->classid);
            $skin->setInstanceid($item->instanceid);
            $skin->setName($item->name);
            $skin->setMarketName($item->market_name);
            $skin->setMarketHashName(urlencode($item->market_hash_name));
            $skin->setImage($item->icon_url);

            $this->entityManager->persist($skin);
            if (!$userskin = $this->entityManager->getRepository(UserSkin::class)->findOneUserAndSkin($user, $skin)) {
                $userskin = new UserSkin();
            }
            $userskin->setUser($user);
            $userskin->setSkin($skin);
            if (isset($item->actions[0]->link)) {
                $userskin->setMarketLink($item->actions[0]->link);
            }
            $this->entityManager->persist($skin);
            $this->entityManager->persist($userskin);
            $this->entityManager->flush();

        }
    }
}
