<?php

namespace App\Entity\Anplan;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
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
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ApiFilter(DateFilter::class, properties={"dateStartsAt", "dateEndsAt"})
 * @ApiFilter(SearchFilter::class, properties={"activity.id", "activity.year", "location.id", "activity.visible"})
 */
class Timeslot
{
    //region Fields

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="pts_id", type="integer")
     * @Groups({"read"})
     */
    public $id;

    /**
     * @var DateTime
     * @ORM\Column(name="pts_starts_at", type="datetime")
     * @Groups({"read"})
     */
    public $dateStartsAt;

    /**
     * @var DateTime
     * @ORM\Column(name="pts_ends_at", type="datetime")
     * @Groups({"read"})
     */
    public $dateEndsAt;

    //endregion

    //region Associations

    /**
     * @var Activity
     * @ORM\ManyToOne(targetEntity="App\Entity\Anplan\Activity", inversedBy="timeslots")
     * @ORM\JoinColumn(name="pts_activity_id", referencedColumnName="pac_id")
     * @ApiSubresource()
     * @Groups({"read"})
     */
    public $activity;

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="App\Entity\Anplan\Location")
     * @ORM\JoinColumn(name="pts_location_id", referencedColumnName="plo_id")
     * @ApiSubresource()
     * @Groups({"read"})
     */
    public $location;

    //endregion

    //region Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateStartsAt(): DateTime
    {
        return $this->dateStartsAt;
    }

    public function getDateEndsAt(): DateTime
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
