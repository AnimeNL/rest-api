<?php

namespace App\Entity\Anplan;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
 *     },
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 */
class ActivityType
{
    //region Fields
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(name="pat_id", type="integer")
     * @Groups({"read"})
     */
    public int $id;

    /**
     * @ORM\Column(name="pat_description", type="string")
     * @Groups({"read"})
     */
    public string $description;

    /**
     * @ORM\Column(name="pat_long_description", type="text")
     * @Groups({"read"})
     */
    public string $longDescription;

    /**
     * @ORM\Column(name="pat_order", type="integer")
     * @Groups({"read"})
     */
    public int $order;

    /**
     * @ORM\Column(name="pat_visible", type="boolean")
     * @Groups({"read"})
     */
    public bool $visible;

    /**
     * @ORM\Column(name="pat_selectable", type="boolean")
     * @Groups({"read"})
     */
    public bool $selectable;

    /**
     * @ORM\Column(name="pat_18plus", type="boolean")
     * @Groups({"read"})
     */
    public bool $adultsOnly;

    /**
     * @ORM\Column(name="pat_compo", type="boolean")
     * @Groups({"read"})
     */
    public bool $competition;

    /**
     * @ORM\Column(name="pat_cosplay", type="boolean")
     * @Groups({"read"})
     */
    public bool $cosplay;

    /**
     * @ORM\Column(name="pat_event", type="boolean")
     * @Groups({"read"})
     */
    public bool $event;

    /**
     * @ORM\Column(name="pat_gameroom", type="boolean")
     * @Groups({"read"})
     */
    public bool $gameRoom;

    /**
     * @ORM\Column(name="pat_video", type="boolean")
     * @Groups({"read"})
     */
    public bool $video;

    /**
     * @ORM\Column(name="pat_class", type="string")
     * @Groups({"read"})
     */
    public string $cssClass;

    /**
     * @ORM\Column(name="pat_foreground_color", type="string")
     * @Groups({"read"})
     */
    public ?string $cssForegroundColor;

    /**
     * @ORM\Column(name="pat_background_color", type="string")
     * @Groups({"read"})
     */
    public string $cssBackgroundColor;

    /**
     * @ORM\Column(name="pat_is_bold", type="boolean")
     * @Groups({"read"})
     */
    public bool $cssBold;

    /**
     * @ORM\Column(name="pat_is_strike_through", type="boolean")
     * @Groups({"read"})
     */
    public bool $cssIsStrikeThrough;

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
