<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Message;

use OpenTribes\Core\Message\DowngradeBuildingInSlotMessage;
use OpenTribes\Core\View\BuildingView;

final class MockDowngradeBuildingInSlot implements DowngradeBuildingInSlotMessage
{
    private BuildingView $buildingView;


    public function getLocationX(): int
    {
        return 1;
    }

    public function getLocationY(): int
    {
        return 1;
    }

    public function getSlot(): string
    {
        return '1';
    }

    public function setBuilding(BuildingView $buildingView):void
    {
        $this->buildingView = $buildingView;
    }


    public function getBuilding(): BuildingView
    {
        return $this->buildingView;
    }


}