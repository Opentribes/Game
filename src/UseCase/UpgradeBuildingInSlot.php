<?php

declare(strict_types=1);

namespace OpenTribes\Core\UseCase;

use OpenTribes\Core\Enum\BuildStatus;
use OpenTribes\Core\Factory\BuildingFactory;
use OpenTribes\Core\Message\UpgradeBuildingInSlotMessage;
use OpenTribes\Core\Repository\BuildingRepository;
use OpenTribes\Core\Repository\CityRepository;
use OpenTribes\Core\Tests\Mock\Entity\MockBuilding;
use OpenTribes\Core\Utils\Location;
use OpenTribes\Core\View\BuildingView;

final class UpgradeBuildingInSlot
{
    public function __construct(
        private BuildingRepository $buildingRepository,
        private CityRepository $cityRepository,
        private BuildingFactory $buildingFactory
    ) {
    }

    public function execute(UpgradeBuildingInSlotMessage $message): void
    {
        $buildings = $this->buildingRepository->findAllAtLocation(
            $message->getLocationX(),
            $message->getLocationY()
        );

        $buildingInSlot = $buildings->fromSlot($message->getSlot());
        if (! $buildingInSlot) {
            $buildingInSlot = $this->createBuilding($message);
        }

        $nextLevel = $buildingInSlot->getLevel() + 1;
        if ($nextLevel < $buildingInSlot->getMaximumLevel()) {
            $buildingInSlot->setStatus(BuildStatus::UPGRADING);
        }

        $buildingView = BuildingView::fromEntity($buildingInSlot);
        $message->setBuilding($buildingView);
        $this->buildingRepository->add($buildingInSlot);
    }

    private function createBuilding(
        UpgradeBuildingInSlotMessage $message
    ): MockBuilding {
        $city = $this->cityRepository->findAtLocation(new Location($message->getLocationX(), $message->getLocationY()));

        $buildingInSlot = $this->buildingFactory->create(
            $message->getBuildingName()
        );
        $buildingInSlot->setSlot($message->getSlot());
        $buildingInSlot->setCity($city);

        return $buildingInSlot;
    }
}
