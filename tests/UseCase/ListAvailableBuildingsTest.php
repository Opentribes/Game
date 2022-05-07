<?php

declare(strict_types=1);

namespace OpenTribes\Core\Tests\UseCase;

use OpenTribes\Core\Tests\Mock\Entity\MockBuilding;
use OpenTribes\Core\Tests\Mock\Message\MockListAvailableBuildingsMessage;
use OpenTribes\Core\Tests\Mock\Repository\MockBuildingRepository;
use OpenTribes\Core\UseCase\ListAvailableBuildings;
use PHPUnit\Framework\TestCase;


final class ListAvailableBuildingsTest extends TestCase
{
    public function testNoBuildingsAreAvailable(): void
    {
        $mockBuildingRepository = new MockBuildingRepository();
        $message = new MockListAvailableBuildingsMessage();
        $useCase = new ListAvailableBuildings($mockBuildingRepository);
        $useCase->execute($message);
        $this->assertEmpty($message->getBuildings());
    }

    public function testAllBuildingsAreShown(): void
    {
        $mockBuildingRepository = new MockBuildingRepository([new MockBuilding('test',30),new MockBuilding('test2',30)]);
        $message = new MockListAvailableBuildingsMessage();
        $useCase = new ListAvailableBuildings($mockBuildingRepository);
        $useCase->execute($message);
        $this->assertSame(2, $message->getBuildings()->count());
    }
}
