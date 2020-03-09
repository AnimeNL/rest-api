<?php

namespace App\Entity\Anplan;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\Anplan\ActivityRepository;
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
 *     normalizationContext={"groups"={"read", "read-activity"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 */
class Activity
{
    //region Fields
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(name="pac_id", type="integer")
     * @Groups({"read"})
     */
    public int $id;

    /**
     * @ORM\Column(name="pac_title", type="string")
     * @Groups({"read"})
     */
    public string $title;

    /**
     * @ORM\Column(name="pac_sponsor", type="string", nullable=true)
     * @Groups({"read"})
     */
    public ?string $sponsor;

    /**
     * @ORM\Column(name="pac_host", type="string", nullable=true)
     * @Groups({"read"})
     */
    public ?string $host;

    /**
     * @ORM\Column(name="pac_visible", type="boolean")
     * @Groups({"staff:read"})
     */
    public bool $visible;

    /**
     * @ORM\Column(name="pac_reason_invisible", type="string", nullable=true)
     * @Groups({"staff:read"})
     */
    public ?string $reasonInvisible;

    /**
     * @ORM\Column(name="pac_spell_checked", type="boolean")
     * @Groups({"staff:read"})
     */
    public bool $spellChecked;

    /**
     * @ORM\Column(name="pac_max_visitors", type="boolean")
     * @Groups({"read"})
     */
    public ?int $maxVisitors;

    /**
     * @ORM\Column(name="pac_price", type="decimal", scale=2, precision=20)
     * @Groups({"read"})
     */
    public ?float $price;

    /**
     * @ORM\Column(name="pac_rules", type="text", nullable=true)
     * @Groups({"read"})
     */
    public ?string $rules;

    /**
     * @ORM\Column(name="pac_description", type="text", nullable=true)
     * @Groups({"read"})
     */
    public ?string $description;

    /**
     * @ORM\Column(name="pac_print_description", type="text", nullable=true)
     * @Groups({"read"})
     */
    public ?string $printDescription;

    /**
     * @ORM\Column(name="pac_web_description", type="text", nullable=true)
     * @Groups({"read"})
     */
    public ?string $webDescription;

    /**
     * @ORM\Column(name="pac_social_description", type="text", nullable=true)
     * @Groups({"read"})
     */
    public ?string $socialDescription;

    /**
     * @ORM\Column(name="pac_url", type="string", nullable=true)
     * @Groups({"read"})
     */
    public ?string $url;

    /**
     * @ORM\Column(name="pac_prizes", type="text", nullable=true)
     * @Groups({"read"})
     */
    public ?string $prizes;

    /**
     * @ORM\Column(name="pac_tech_info", type="text", nullable=true)
     * @Groups({"staff:read", "tech-crew:read"})
     */
    public ?string $techInfo;

    /**
     * @ORM\Column(name="pac_logistics_info", type="text", nullable=true)
     * @Groups({"staff:read", "gopher:read"})
     */
    public ?string $logisticsInfo;

    /**
     * @ORM\Column(name="pac_finance_info", type="text", nullable=true)
     * @Groups({"staff:read"})
     */
    public ?string $financeInfo;

    /**
     * @ORM\Column(name="pac_tickets_info", type="text", nullable=true)
     * @Groups({"staff:read"})
     */
    public ?string $ticketsInfo;

    /**
     * @ORM\Column(name="pac_large_image", type="blob", nullable=true)
     */
    public $largeImage;

    /**
     * @ORM\Column(name="pac_small_image", type="blob", nullable=true)
     */
    public $smallImage;

    //endregion
    //region Associations
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Anplan\ActivityType")
     * @ORM\JoinColumn(name="pac_type_id", referencedColumnName="pat_id")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"read"})
     */
    public ?ActivityType $activityType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Anplan\Timeslot", mappedBy="activity")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"read-activity"})
     */
    public $timeslots;

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

    public function getLargeImage()
    {
        return $this->largeImage;
    }

    public function getSmallImage()
    {
        return $this->smallImage;
    }

    public function getTimeslots()
    {
        return $this->timeslots;
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

    /**
     * @param resource|null $largeImage
     * @return Activity
     */
    public function setLargeImage($largeImage): Activity
    {
        $this->largeImage = $largeImage;
        return $this;
    }

    /**
     * @param resource|null $smallImage
     * @return Activity
     */
    public function setSmallImage($smallImage): Activity
    {
        $this->smallImage = $smallImage;
        return $this;
    }

    //endregion
}
