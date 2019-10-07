<?php

namespace App\Entity\Anplan;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(name="plan__activities")
 * @ApiResource(
 *     description="Describes an event at the convention.",
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
class Activity
{
    //region Fields

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="pac_id", type="integer")
     * @Groups({"read"})
     */
    public $id;

    /**
     * @var string
     * @ORM\Column(name="pac_title", type="string")
     * @Groups({"read"})
     */
    public $title;

    /**
     * @var string|null
     * @ORM\Column(name="pac_sponsor", type="string", nullable=true)
     * @Groups({"read"})
     */
    public $sponsor;

    /**
     * @var string|null
     * @ORM\Column(name="pac_host", type="string", nullable=true)
     * @Groups({"read"})
     */
    public $host;

    /**
     * @var bool
     * @ORM\Column(name="pac_visible", type="boolean")
     * @Groups({"staff:read"})
     */
    public $visible;

    /**
     * @var string|null
     * @ORM\Column(name="pac_reason_invisible", type="string", nullable=true)
     * @Groups({"staff:read"})
     */
    public $reasonInvisible;

    /**
     * @var bool
     * @ORM\Column(name="pac_spell_checked", type="boolean")
     * @Groups({"staff:read"})
     */
    public $spellChecked;

    /**
     * @var int|null
     * @ORM\Column(name="pac_max_visitors", type="boolean")
     * @Groups({"read"})
     */
    public $maxVisitors;

    /**
     * @var float|null
     * @ORM\Column(name="pac_price", type="decimal", scale=2, precision=20)
     * @Groups({"read"})
     */
    public $price;

    /**
     * @var string|null
     * @ORM\Column(name="pac_rules", type="text", nullable=true)
     * @Groups({"read"})
     */
    public $rules;

    /**
     * @var string|null
     * @ORM\Column(name="pac_description", type="text", nullable=true)
     * @Groups({"read"})
     */
    public $description;

    /**
     * @var string|null
     * @ORM\Column(name="pac_print_description", type="text", nullable=true)
     * @Groups({"read"})
     */
    public $printDescription;

    /**
     * @var string|null
     * @ORM\Column(name="pac_web_description", type="text", nullable=true)
     * @Groups({"read"})
     */
    public $webDescription;

    /**
     * @var string|null
     * @ORM\Column(name="pac_social_description", type="text", nullable=true)
     * @Groups({"read"})
     */
    public $socialDescription;

    /**
     * @var string|null
     * @ORM\Column(name="pac_url", type="string", nullable=true)
     * @Groups({"read"})
     */
    public $url;

    /**
     * @var string|null
     * @ORM\Column(name="pac_prizes", type="text", nullable=true)
     * @Groups({"read"})
     */
    public $prizes;

    /**
     * @var string|null
     * @ORM\Column(name="pac_tech_info", type="text", nullable=true)
     * @Groups({"staff:read", "tech-crew:read"})
     */
    public $techInfo;

    /**
     * @var string|null
     * @ORM\Column(name="pac_logistics_info", type="text", nullable=true)
     * @Groups({"staff:read", "gopher:read"})
     */
    public $logisticsInfo;

    /**
     * @var string|null
     * @ORM\Column(name="pac_finance_info", type="text", nullable=true)
     * @Groups({"staff:read"})
     */
    public $financeInfo;

    /**
     * @var string|null
     * @ORM\Column(name="pac_tickets_info", type="text", nullable=true)
     * @Groups({"read"})
     */
    public $ticketsInfo;

    //endregion

    //region Associations

    /**
     * @var ActivityType
     * @ORM\ManyToOne(targetEntity="App\Entity\Anplan\ActivityType")
     * @ORM\JoinColumn(name="pac_type_id", referencedColumnName="pat_id")
     */
    public $activityType;

    //endregion

    //region Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSponsor(): ?string
    {
        return $this->sponsor;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function getActivityType(): ActivityType
    {
        return $this->activityType;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function getReasonInvisible(): ?string
    {
        return $this->reasonInvisible;
    }

    public function isSpellChecked(): bool
    {
        return $this->spellChecked;
    }

    public function getMaxVisitors(): ?int
    {
        return $this->maxVisitors;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getRules(): ?string
    {
        return $this->rules;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrintDescription(): ?string
    {
        return $this->printDescription;
    }

    public function getWebDescription(): ?string
    {
        return $this->webDescription;
    }

    public function getSocialDescription(): ?string
    {
        return $this->socialDescription;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getPrizes(): ?string
    {
        return $this->prizes;
    }

    public function getTechInfo(): ?string
    {
        return $this->techInfo;
    }

    public function getLogisticsInfo(): ?string
    {
        return $this->logisticsInfo;
    }

    public function getFinanceInfo(): ?string
    {
        return $this->financeInfo;
    }

    public function getTicketsInfo(): ?string
    {
        return $this->ticketsInfo;
    }

    //endregion

    //region Setters

    public function setTitle(string $title): Activity
    {
        $this->title = $title;
        return $this;
    }

    public function setActivityType(ActivityType $activityType): Activity
    {
        $this->activityType = $activityType;
        return $this;
    }

    public function setSponsor(?string $sponsor): Activity
    {
        $this->sponsor = $sponsor;
        return $this;
    }

    public function setHost(?string $host): Activity
    {
        $this->host = $host;
        return $this;
    }

    public function setVisible(bool $visible): Activity
    {
        $this->visible = $visible;
        return $this;
    }

    public function setReasonInvisible(?string $reasonInvisible): Activity
    {
        $this->reasonInvisible = $reasonInvisible;
        return $this;
    }

    public function setSpellChecked(bool $spellChecked): Activity
    {
        $this->spellChecked = $spellChecked;
        return $this;
    }

    public function setMaxVisitors(?int $maxVisitors): Activity
    {
        $this->maxVisitors = $maxVisitors;
        return $this;
    }

    public function setPrice(?float $price): Activity
    {
        $this->price = $price;
        return $this;
    }

    public function setRules(?string $rules): Activity
    {
        $this->rules = $rules;
        return $this;
    }

    public function setDescription(?string $description): Activity
    {
        $this->description = $description;
        return $this;
    }

    public function setPrintDescription(?string $printDescription): Activity
    {
        $this->printDescription = $printDescription;
        return $this;
    }

    public function setWebDescription(?string $webDescription): Activity
    {
        $this->webDescription = $webDescription;
        return $this;
    }

    public function setSocialDescription(?string $socialDescription): Activity
    {
        $this->socialDescription = $socialDescription;
        return $this;
    }

    public function setUrl(?string $url): Activity
    {
        $this->url = $url;
        return $this;
    }

    public function setPrizes(?string $prizes): Activity
    {
        $this->prizes = $prizes;
        return $this;
    }

    public function setTechInfo(?string $techInfo): Activity
    {
        $this->techInfo = $techInfo;
        return $this;
    }

    public function setLogisticsInfo(?string $logisticsInfo): Activity
    {
        $this->logisticsInfo = $logisticsInfo;
        return $this;
    }

    public function setFinanceInfo(?string $financeInfo): Activity
    {
        $this->financeInfo = $financeInfo;
        return $this;
    }

    public function setTicketsInfo(?string $ticketsInfo): Activity
    {
        $this->ticketsInfo = $ticketsInfo;
        return $this;
    }

    //endregion
}
