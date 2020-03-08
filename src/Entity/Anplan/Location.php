<?php

namespace App\Entity\Anplan;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

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
 *     }
 * )
 */
class Location
{
    //region Fields
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(name="plo_id", type="integer")
     */
    public int $id;

    /**
     * @ORM\Column(name="plo_year", type="integer")
     */
    public int $year;

    /**
     * @ORM\Column(name="plo_name", type="string")
     */
    public string $name;

    /**
     * @ORM\Column(name="plo_use_name", type="string", nullable=true)
     */
    public ?string $useName;

    /**
     * @ORM\Column(name="plo_sponsor", type="string", nullable=true)
     */
    public ?string $sponsor;

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

    //endregion

    //region Setters

    public function setName(string $name): Location
    {
        $this->name = $name;
        return $this;
    }

    //endregion
}
