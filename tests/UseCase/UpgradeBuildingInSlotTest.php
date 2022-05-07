<?php

declare(strict_types=1);

namespace OpenTribes\Core\Tests\UseCase;

use OpenTribes\Core\Tests\Mock\Entity\MockCity;
use OpenTribes\Core\Entity\CityCollection;
use OpenTribes\Core\Enum\BuildStatus;
use OpenTribes\Core\Factory\BuildingFactory;
use OpenTribes\Core\Tests\Mock\Entity\MockBuilding;
use OpenTribes\Core\Tests\Mock\Message\MockUpgradeBuildingInSlotMessage;
use OpenTribes\Core\Tests\Mock\Repository\MockBuildingRepository;
use OpenTribes\Core\Tests\Mock\Repository\MockCityRepository;
use OpenTribes\Core\UseCase\UpgradeBuildingInSlot;
use OpenTribes\Core\Utils\Location;
use PHPUnit\Framework\TestCase;

final class UpgradeBuildingInSlotTest extends TestCase
{

    public function testCanUpgradeBuildingOnSlot(): void
    {
        $lumberjack = new MockBuilding('lumberjack',30);
        $lumberjack->setSlot('1');

        $buildingFactory = new BuildingFactory();
        $buildingRepository = new MockBuildingRepository([$lumberjack]);
        $message = new MockUpgradeBuildingInSlotMessage();
        $cityRepository = new MockCityRepository();
        $useCase = new UpgradeBuildingInSlot($buildingRepository,$cityRepository,$buildingFactory);
        $useCase->execute($message);
        $this->assertNotEmpty($message->getBuilding());
        $this->assertSame(BuildStatus::UPGRADING, $message->getBuilding()->status);
    }

    public function testCanBuildNewBuildingOnSlot(): void
    {

        $buildingRepository = new MockBuildingRepository();
        $cityRepository = new MockCityRepository();
        $cityRepository->setCities(new CityCollection(...[
            new MockCity(new Location(1,1))
        ]));
        $buildingFactory = new BuildingFactory();
        $message = new MockUpgradeBuildingInSlotMessage('lumberjack');
        $useCase = new UpgradeBuildingInSlot($buildingRepository,$cityRepository,$buildingFactory);
        $useCase->execute($message);

        $this->assertNotEmpty($message->getBuilding());
        $this->assertSame(BuildStatus::UPGRADING, $message->getBuilding()->status);
    }
    public function testMaximumLevelReached(): void
    {
        $lumberjack = new MockBuilding('lumberjack',30);
        $lumberjack->setSlot('1');
        $lumberjack->setLevel(30);

        $cityRepository = new MockCityRepository();
        $buildingFactory = new BuildingFactory();
        $buildingRepository = new MockBuildingRepository([$lumberjack]);
        $message = new MockUpgradeBuildingInSlotMessage();

        $useCase = new UpgradeBuildingInSlot($buildingRepository,$cityRepository,$buildingFactory);
        $useCase->execute($message);
        $this->assertNotEmpty($message->getBuilding());
        $this->assertSame(BuildStatus::default, $message->getBuilding()->status);
    }

    public function testCanStoreUpgradedBuilding(): void
    {
        $buildingRepository = new MockBuildingRepository();
        $factory = new BuildingFactory();

        $cityRepository = new MockCityRepository();
        $cityRepository->setCities(new CityCollection(...[
            new MockCity(new Location(1,1))
        ]));
        $message = new MockUpgradeBuildingInSlotMessage('lumberjack');
        $useCase = new UpgradeBuildingInSlot($buildingRepository,$cityRepository,$factory);
        $useCase->execute($message);
        $this->assertNotEmpty($buildingRepository->findAllAtLocation(1,1)->fromSlot('1'));
    }
}
