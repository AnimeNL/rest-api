<?php

namespace App\Entity\Anplan;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\MaxDepth;

#[ApiResource(
    description: 'Describes an timeslot at the convention.',
    operations: [new GetCollection(), new Get()],
    normalizationContext: ['groups' => ['read', 'events.read'], 'enable_max_depth' => true],
    denormalizationContext: ['groups' => ['write']],
    forceEager: false,
)]
#[ApiFilter(DateFilter::class, properties: ['dateStartsAt', 'dateEndsAt'])]
#[ApiFilter(BooleanFilter::class, properties: ['activity.visible', 'activity.activityType.visible'])]
#[ApiFilter(NumericFilter::class, properties: [
    'activity.id',
    'activity.year',
    'location.id',
    'activity.activityType.id'
])]
#[ORM\Entity]
#[ORM\Table(name: 'plan__timeslots')]
class Timeslot
{
    // region Fields
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'pts_id', type: 'integer')]
    #[Groups(['read'])]
    public int $id;

    #[ORM\Column(name: 'pts_starts_at', type: 'datetime')]
    #[Groups(['read'])]
    public \DateTimeInterface $dateStartsAt;

    #[ORM\Column(name: 'pts_ends_at', type: 'datetime')]
    #[Groups(['read'])]
    public \DateTimeInterface $dateEndsAt;

    // endregion
    // region Associations
    #[ORM\ManyToOne(targetEntity: Activity::class, inversedBy: 'timeslots')]
    #[ORM\JoinColumn(name: 'pts_activity_id', referencedColumnName: 'pac_id')]
    #[Groups(['read'])]
    #[MaxDepth(1)]
    public ?Activity $activity;

    #[ORM\ManyToOne(targetEntity: Location::class)]
    #[ORM\JoinColumn(name: 'pts_location_id', referencedColumnName: 'plo_id')]
    #[Groups(['read'])]
    #[MaxDepth(1)]
    public ?Location $location;

    // endregion

    // region Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateStartsAt(): string
    {
        return $this->forceTimezone($this->dateStartsAt);
    }

    public function getDateEndsAt(): string
    {
        return $this->forceTimezone($this->dateEndsAt);
    }

    public function getActivity(): Activity
    {
        return $this->activity;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    // endregion

    // region Setters

    private function forceTimezone(\DateTimeInterface $date): string
    {
        $local = new \DateTimeZone('Europe/Amsterdam');
        $utc = new \DateTimeZone('GMT');

        $dateUtc = new \DateTime("@{$date->getTimestamp()}", $utc);
        $offset = $local->getOffset($dateUtc);

        $adjustedTimestamp = $date->getTimestamp() - $offset;

        $timezonedDate = \DateTime::createFromFormat('U', (string) $adjustedTimestamp, $utc);
        if (false === $timezonedDate) {
            throw new \Exception('Could not create DateTime from timestamp');
        }

        return $timezonedDate->setTimezone($local)->format(DATE_ATOM);
    }

    public function setDateStartsAt(\DateTime $dateStartsAt): Timeslot
    {
        $this->dateStartsAt = $dateStartsAt;

        return $this;
    }

    public function setDateEndsAt(\DateTime $dateEndsAt): Timeslot
    {
        $this->dateEndsAt = $dateEndsAt;

        return $this;
    }

    public function setActivity(Activity $activity): Timeslot
    {
        $this->activity = $activity;

        return $this;
    }

    public function setLocation(Location $location): Timeslot
    {
        $this->location = $location;

        return $this;
    }

    // endregion
}
