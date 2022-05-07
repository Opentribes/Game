<?php

declare(strict_types=1);

namespace OpenTribes\Core\Repository;

use OpenTribes\Core\Entity\Building;
use OpenTribes\Core\Entity\BuildingCollection;

interface BuildingRepository
{
    public function findAllAtLocation(
        int $locationX,
        int $locationY
    ): BuildingCollection;

    public function findAvailable(): BuildingCollection;

    public function userCanBuildAtLocation(
        int $locationX,
        int $locationY,
        string $username
    ): bool;

    public function add(Building $building): void;
}
