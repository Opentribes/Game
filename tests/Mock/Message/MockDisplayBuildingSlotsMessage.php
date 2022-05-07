<?php

namespace OpenTribes\Core\Tests\Mock\Message;


use OpenTribes\Core\Message\DisplayBuildingSlotsMessage;
use OpenTribes\Core\View\SlotView;
use OpenTribes\Core\View\SlotViewCollection;

class MockDisplayBuildingSlotsMessage implements DisplayBuildingSlotsMessage
{
    private SlotViewCollection $slotViews;
    private bool $shoOnlyCityData = false;

    public function __construct(
        private int $locationX = 0,
        private int $locationY = 0,
        private string $username = 'Test'
    ) {
        $this->slotViews = new SlotViewCollection();
    }

    public function getSlots(): SlotViewCollection
    {
        return $this->slotViews;
    }

    /**
     * @return int
     */
    public function getLocationX(): int
    {
        return $this->locationX;
    }

    /**
     * @return int
     */
    public function getLocationY(): int
    {
        return $this->locationY;
    }

    public function addSlot(SlotView $slotView): void
    {
        $this->slotViews[] = $slotView;
    }

    public function showOnlyCityData(): bool
    {
        return $this->shoOnlyCityData;
    }

    public function getUserName(): string
    {
        return $this->username;
    }

    public function enableCityDataOnly(): void
    {
        $this->shoOnlyCityData = true;
    }

}