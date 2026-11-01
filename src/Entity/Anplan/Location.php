<?php

namespace App\Entity\Anplan;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    description: 'Describes a location at the event.',
    operations: [new GetCollection(), new Get()],
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
)]
#[ORM\Entity]
#[ORM\Table(name: 'plan__locations')]
class Location
{
    // region Fields
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'plo_id', type: 'integer')]
    #[Groups(['read'])]
    public int $id;

    #[ORM\Column(name: 'plo_year', type: 'integer')]
    #[Groups(['read'])]
    public int $year;

    #[ORM\Column(name: 'plo_name', type: 'string')]
    #[Groups(['read'])]
    public string $name;

    #[ORM\Column(name: 'plo_use_name', type: 'string', nullable: true)]
    #[Groups(['read'])]
    public ?string $useName;

    #[ORM\Column(name: 'plo_sponsor', type: 'string', nullable: true)]
    #[Groups(['read'])]
    public ?string $sponsor;

    #[ORM\ManyToOne(targetEntity: Floor::class)]
    #[ORM\JoinColumn(name: 'plo_floor_id', referencedColumnName: 'pfl_id')]
    public ?Floor $floor;

    #[ORM\Column(name: 'plo_order', type: 'integer')]
    #[Groups(['read'])]
    public int $order;

    // endregion

    // region Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    #[Groups(['read'])]
    public function getArea(): ?string
    {
        return $this->floor?->getName();
    }

    #[Groups(['read'])]
    public function getFloorId(): ?int
    {
        return $this->floor?->getId();
    }

    #[Groups(['read'])]
    public function getOrder(): int
    {
        return $this->order;
    }

    // endregion

    // region Setters

    public function setName(string $name): Location
    {
        $this->name = $name;

        return $this;
    }

    // endregion
}
