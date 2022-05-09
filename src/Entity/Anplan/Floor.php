<?php

namespace App\Entity\Anplan;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(name="plan__floors")
 * @ApiResource(
 *     description="Describes a floor at the convention location.",
 *     collectionOperations={
 *         "get",
 *     },
 *     itemOperations={
 *         "get",
 *     }
 * )
 */
class Floor
{
    //region Fields
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(name="pfl_id", type="integer")
     */
    public int $id;

    /**
     * @ORM\Column(name="pfl_year", type="integer")
     */
    public int $year;

    /**
     * @ORM\Column(name="pfl_name", type="string")
     * @Groups({"read"})
     */
    public string $name;

    /**
     * @ORM\Column(name="pfl_description", type="string", nullable=true)
     */
    public ?string $description;

    /**
     * @ORM\Column(name="pfl_background_color", type="string", nullable=true)
     */
    public ?string $cssBackgroundColor;

    //endregion

    //region Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCssBackgroundColor(): ?string
    {
        return $this->cssBackgroundColor;
    }

    //endregion

    //region Setters

    public function setDescription(?string $description): Floor
    {
        $this->description = $description;
        return $this;
    }

    public function setYear(int $year): Floor
    {
        $this->year = $year;
        return $this;
    }

    public function setName(string $name): Floor
    {
        $this->name = $name;
        return $this;
    }

    public function setCssBackgroundColor(?string $cssBackgroundColor): Floor
    {
        $this->cssBackgroundColor = $cssBackgroundColor;
        return $this;
    }

    //endregion
}
