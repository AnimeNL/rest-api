<?php

namespace App\Entity\Anplan;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(name="plan__locations")
 * @ApiResource(
 *     description="Describes a location at the event.",
 *     collectionOperations={
 *         "get",
 *     },
 *     itemOperations={
 *         "get",
 *     },
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 */
class Location
{
    //region Fields
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(name="plo_id", type="integer")
     * @Groups({"read"})
     */
    public int $id;

    /**
     * @ORM\Column(name="plo_year", type="integer")
     * @Groups({"read"})
     */
    public int $year;

    /**
     * @ORM\Column(name="plo_name", type="string")
     * @Groups({"read"})
     */
    public string $name;

    /**
     * @ORM\Column(name="plo_use_name", type="string", nullable=true)
     * @Groups({"read"})
     */
    public ?string $useName;

    /**
     * @ORM\Column(name="plo_sponsor", type="string", nullable=true)
     * @Groups({"read"})
     */
    public ?string $sponsor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Anplan\Floor")
     * @ORM\JoinColumn(name="plo_floor_id", referencedColumnName="pfl_id")
     */
    public ?Floor $floor;

    //endregion

    //region Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @Groups({"read"})
     */
    public function getArea(): ?string
    {
        return $this->floor?->getName();
    }

    /**
     * @Groups({"read"})
     */
    public function getFloorId(): ?int
    {
        return $this->floor?->getId();
    }

    //endregion

    //region Setters

    public function setName(string $name): Location
    {
        $this->name = $name;

        return $this;
    }

    //endregion
}
