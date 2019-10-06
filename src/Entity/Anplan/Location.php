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
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="plo_id", type="integer")
     */
    public $id;

    /**
     * @var int
     * @ORM\Column(name="plo_year", type="integer")
     */
    public $year;

    /**
     * @var string
     * @ORM\Column(name="plo_name", type="string")
     */
    public $name;

    /**
     * @var string|null
     * @ORM\Column(name="plo_use_name", type="string", nullable=true)
     */
    public $useName;

    /**
     * @var string|null
     * @ORM\Column(name="plo_sponsor", type="string", nullable=true)
     */
    public $sponsor;

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
