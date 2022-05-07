<?php

declare(strict_types=1);

namespace OpenTribes\Core\UseCase;

use OpenTribes\Core\Enum\BuildStatus;
use OpenTribes\Core\Exception\InvalidDowngrade;
use OpenTribes\Core\Message\DowngradeBuildingInSlotMessage;
use OpenTribes\Core\Repository\BuildingRepository;
use OpenTribes\Core\View\BuildingView;

final class DowngradeBuildingInSlot
{
    public function __construct(private BuildingRepository $buildingRepository)
    {
    }

    public function execute(DowngradeBuildingInSlotMessage $message): void
    {
        $buildings = $this->buildingRepository->findAllAtLocation(
            $message->getLocationX(),
            $message->getLocationY(),
        );
        $buildingAtSlot = $buildings->fromSlot($message->getSlot());
        if (! $buildingAtSlot) {
            throw new InvalidDowngrade();
        }
        $buildingAtSlot->setStatus(BuildStatus::DOWNGRADING);
        $message->setBuilding(BuildingView::fromEntity($buildingAtSlot));
        $this->buildingRepository->add($buildingAtSlot);
    }
}
