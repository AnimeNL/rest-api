<?php

namespace App\Entity\Anplan;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

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
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="pfl_id", type="integer")
     */
    public $id;

    /**
     * @var string|null
     * @ORM\Column(name="pfl_description", type="string", nullable=true)
     */
    public $description;

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

    //endregion

    //region Setters

    public function setDescription(?string $description): Floor
    {
        $this->description = $description;
        return $this;
    }

    //endregion
}
