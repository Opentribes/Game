<?php

declare(strict_types=1);

namespace OpenTribes\Core\Message;

use OpenTribes\Core\View\BuildingView;

interface UpgradeBuildingInSlotMessage
{
    public function getLocationX(): int;

    public function getLocationY(): int;

    public function getSlot(): string;

    public function setBuilding(BuildingView $buildingView): void;

    public function getBuildingName(): string;
}
