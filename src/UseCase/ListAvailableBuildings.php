<?php

declare(strict_types=1);

namespace OpenTribes\Core\UseCase;

use OpenTribes\Core\Message\ListAvailableBuildingsMessage;
use OpenTribes\Core\Repository\BuildingRepository;
use OpenTribes\Core\View\BuildingView;

final class ListAvailableBuildings
{
    public function __construct(private BuildingRepository $buildingRepository)
    {
    }

    public function execute(ListAvailableBuildingsMessage $message): void
    {
        $buildingCollection = $this->buildingRepository->findAvailable();

        foreach ($buildingCollection as $building) {
            $message->addBuilding(BuildingView::fromEntity($building));
        }
    }
}
