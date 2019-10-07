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

    /**
     * @var int
     * @ORM\Column(name="pat_order", type="integer")
     */
    public $order;

    /**
     * @var bool
     * @ORM\Column(name="pat_visible", type="boolean")
     */
    public $visible;

    /**
     * @var bool
     * @ORM\Column(name="pat_selectable", type="boolean")
     */
    public $selectable;

    /**
     * @var bool
     * @ORM\Column(name="pat_18plus", type="boolean")
     */
    public $adultsOnly;

    /**
     * @var bool
     * @ORM\Column(name="pat_compo", type="boolean")
     */
    public $competition;

    /**
     * @var bool
     * @ORM\Column(name="pat_cosplay", type="boolean")
     */
    public $cosplay;

    /**
     * @var bool
     * @ORM\Column(name="pat_event", type="boolean")
     */
    public $event;

    /**
     * @var bool
     * @ORM\Column(name="pat_gameroom", type="boolean")
     */
    public $gameRoom;

    /**
     * @var bool
     * @ORM\Column(name="pat_video", type="boolean")
     */
    public $video;

    /**
     * @var string
     * @ORM\Column(name="pat_class", type="string")
     */
    public $cssClass;

    /**
     * @var string|null
     * @ORM\Column(name="pat_foreground_color", type="string")
     */
    public $cssForegroundColor;

    /**
     * @var string|null
     * @ORM\Column(name="pat_background_color", type="string")
     */
    public $cssBackgroundColor;

    /**
     * @var bool
     * @ORM\Column(name="pat_is_bold", type="boolean")
     */
    public $cssBold;

    /**
     * @var bool
     * @ORM\Column(name="pat_is_strike_through", type="boolean")
     */
    public $cssIsStrikeThrough;

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

    public function getOrder(): int
    {
        return $this->order;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function isSelectable(): bool
    {
        return $this->selectable;
    }

    public function isAdultsOnly(): bool
    {
        return $this->adultsOnly;
    }

    public function isCompetition(): bool
    {
        return $this->competition;
    }

    public function isCosplay(): bool
    {
        return $this->cosplay;
    }

    public function isEvent(): bool
    {
        return $this->event;
    }

    public function isGameRoom(): bool
    {
        return $this->gameRoom;
    }

    public function isVideo(): bool
    {
        return $this->video;
    }

    public function getCssClass(): string
    {
        return $this->cssClass;
    }

    public function getCssForegroundColor(): ?string
    {
        return $this->cssForegroundColor;
    }

    public function getCssBackgroundColor(): ?string
    {
        return $this->cssBackgroundColor;
    }

    public function isCssBold(): bool
    {
        return $this->cssBold;
    }

    public function isCssIsStrikeThrough(): bool
    {
        return $this->cssIsStrikeThrough;
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

    public function setOrder(int $order): ActivityType
    {
        $this->order = $order;
        return $this;
    }

    public function setVisible(bool $visible): ActivityType
    {
        $this->visible = $visible;
        return $this;
    }

    public function setSelectable(bool $selectable): ActivityType
    {
        $this->selectable = $selectable;
        return $this;
    }

    public function setAdultsOnly(bool $adultsOnly): ActivityType
    {
        $this->adultsOnly = $adultsOnly;
        return $this;
    }

    public function setCompetition(bool $competition): ActivityType
    {
        $this->competition = $competition;
        return $this;
    }

    public function setCosplay(bool $cosplay): ActivityType
    {
        $this->cosplay = $cosplay;
        return $this;
    }

    public function setEvent(bool $event): ActivityType
    {
        $this->event = $event;
        return $this;
    }

    public function setGameRoom(bool $gameRoom): ActivityType
    {
        $this->gameRoom = $gameRoom;
        return $this;
    }

    public function setVideo(bool $video): ActivityType
    {
        $this->video = $video;
        return $this;
    }

    public function setCssClass(string $cssClass): ActivityType
    {
        $this->cssClass = $cssClass;
        return $this;
    }

    public function setCssForegroundColor(?string $cssForegroundColor): ActivityType
    {
        $this->cssForegroundColor = $cssForegroundColor;
        return $this;
    }

    public function setCssBackgroundColor(?string $cssBackgroundColor): ActivityType
    {
        $this->cssBackgroundColor = $cssBackgroundColor;
        return $this;
    }

    public function setCssBold(bool $cssBold): ActivityType
    {
        $this->cssBold = $cssBold;
        return $this;
    }

    public function setCssIsStrikeThrough(bool $cssIsStrikeThrough): ActivityType
    {
        $this->cssIsStrikeThrough = $cssIsStrikeThrough;
        return $this;
    }

    //endregion
}
