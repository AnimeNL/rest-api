<?php

namespace App\Entity\Anplan;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="plan__activity_types")
 * @ApiResource(
 *     description="Describes the type of an event at the convention.",
 *     collectionOperations={
 *         "get",
 *     },
 *     itemOperations={
 *         "get",
 *     }
 * )
 */
class ActivityType
{
    //region Fields

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="pat_id", type="integer")
     */
    public $id;

    /**
     * @var string
     * @ORM\Column(name="pat_description", type="string")
     */
    public $description;

    /**
     * @var string
     * @ORM\Column(name="pat_long_description", type="text")
     */
    public $longDescription;

    //endregion

    //region Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLongDescription(): string
    {
        return $this->longDescription;
    }

    //endregion

    //region Setters

    public function setDescription(string $description): ActivityType
    {
        $this->description = $description;
        return $this;
    }

    public function setLongDescription(string $longDescription): ActivityType
    {
        $this->longDescription = $longDescription;
        return $this;
    }

    //endregion
}
