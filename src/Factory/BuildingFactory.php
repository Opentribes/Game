<?php

declare(strict_types=1);

namespace OpenTribes\Core\Factory;

use OpenTribes\Core\Tests\Mock\Entity\MockBuilding;

final class BuildingFactory
{
    public function create(string $buildingName): MockBuilding
    {
        return new MockBuilding($buildingName, 30);
    }
}
