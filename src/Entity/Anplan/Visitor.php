<?php

namespace App\Entity\Anplan;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="jpop__visitors")
 */
class Visitor
{
    //region Fields
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(name="vis_id_visitor", type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(name="vis_email", type="string", nullable=true)
     */
    private ?string $email = null;

    /**
     * @ORM\Column(name="vis_first_name", type="string", nullable=true)
     */
    private ?string $firstName = null;

    /**
     * @ORM\Column(name="vis_middle_name", type="string", nullable=true)
     */
    private ?string $middleName = null;

    /**
     * @ORM\Column(name="vis_last_name", type="string", nullable=true)
     */
    private ?string $lastName = null;

    //endregion

    //region Getters

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getFullName(): ?string
    {
        return trim(preg_replace('/\s+/', ' ', "{$this->firstName} {$this->middleName} {$this->lastName}")) ?: null;
    }

    //endregion
}
