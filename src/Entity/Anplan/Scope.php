<?php

namespace App\Entity\Anplan;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'jpop__visitor_rights')]
class Scope
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'id')]
    private int $id;

    #[ORM\Column(type: 'string', name: 'vir_right')]
    private string $scope;

    #[ORM\Column(type: 'smallint', name: 'vir_active')]
    private bool $active;

    public function getId(): int
    {
        return $this->id;
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}
