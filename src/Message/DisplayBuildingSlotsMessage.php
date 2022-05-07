<?php

declare(strict_types=1);

namespace OpenTribes\Core\Message;

use OpenTribes\Core\View\SlotView;
use OpenTribes\Core\View\SlotViewCollection;

interface DisplayBuildingSlotsMessage
{
    public function getSlots(): SlotViewCollection;

    public function addSlot(SlotView $slotView): void;

    public function getLocationX(): int;

    public function getLocationY(): int;

    public function getUserName(): string;

    public function enableCityDataOnly(): void;
}
