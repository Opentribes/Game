<?php

declare(strict_types=1);

namespace OpenTribes\Core\Message;

use OpenTribes\Core\View\BuildingView;
use OpenTribes\Core\View\BuildingViewCollection;

interface ListAvailableBuildingsMessage
{
    public function getBuildings(): BuildingViewCollection;

    public function addBuilding(BuildingView $buildingView): void;
}
