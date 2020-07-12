<?php

namespace App\Entity\Anplan;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ORM\Entity()
 * @ORM\Table(name="plan__timeslots")
 * @ApiResource(
 *     description="Describes an timeslot at the convention.",
 *     collectionOperations={
 *         "get",
 *     },
 *     itemOperations={
 *         "get",
 *     },
 *     normalizationContext={"groups"={"read", "events.read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ApiFilter(DateFilter::class, properties={"dateStartsAt", "dateEndsAt"})
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={"activity.id", "activity.year", "location.id", "activity.visible", "activity.activityType.id"}
 * )
 */
class Timeslot
{
    //region Fields
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(name="pts_id", type="integer")
     * @Groups({"read"})
     */
    public int $id;

    /**
     * @ORM\Column(name="pts_starts_at", type="datetime")
     * @Groups({"read"})
     */
    public DateTimeInterface $dateStartsAt;

    /**
     * @ORM\Column(name="pts_ends_at", type="datetime")
     * @Groups({"read"})
     */
    public DateTimeInterface $dateEndsAt;

    //endregion
    //region Associations
    /**
     * @var Activity
     * @ORM\ManyToOne(targetEntity="App\Entity\Anplan\Activity", inversedBy="timeslots")
     * @ORM\JoinColumn(name="pts_activity_id", referencedColumnName="pac_id")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"read"})
     */
    public ?Activity $activity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Anplan\Location")
     * @ORM\JoinColumn(name="pts_location_id", referencedColumnName="plo_id")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"read"})
     */
    public ?Location $location;

    //endregion

    //region Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateStartsAt(): DateTimeInterface
    {
        return $this->dateStartsAt;
    }

    public function getDateEndsAt(): DateTimeInterface
    {
        return $this->dateEndsAt;
    }

    public function getActivity(): Activity
    {
        return $this->activity;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    //endregion

    //region Setters

    public function setDateStartsAt(DateTime $dateStartsAt): Timeslot
    {
        $this->dateStartsAt = $dateStartsAt;
        return $this;
    }

    public function setDateEndsAt(DateTime $dateEndsAt): Timeslot
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

    //endregion
}
