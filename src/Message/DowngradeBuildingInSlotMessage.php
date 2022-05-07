<?php

declare(strict_types=1);

namespace OpenTribes\Core\Message;

use OpenTribes\Core\View\BuildingView;

interface DowngradeBuildingInSlotMessage
{
    public function getBuilding(): BuildingView;

    public function getLocationY(): int;

    public function getLocationX(): int;

    public function getSlot(): string;

    public function setBuilding(BuildingView $building): void;
}
