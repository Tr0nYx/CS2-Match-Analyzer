<?php


namespace App\Entity;


use App\Entity\Traits\IdTrait;
use App\Entity\Traits\UserStatTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity]
#[Gedmo\Loggable()]
#[ORM\Cache('NONSTRICT_READ_WRITE')]
class UserStatHistory
{
    use IdTrait;
    use UserStatTrait;
    use TimestampableEntity;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $matchTime;

    public function getMatchTime(): \DateTimeImmutable
    {
        return $this->matchTime;
    }

    public function setMatchTime(\DateTimeImmutable $matchTime): void
    {
        $this->matchTime = $matchTime;
    }
}