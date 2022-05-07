<?php

namespace OpenTribes\Core\Tests\UseCase;


use OpenTribes\Core\Tests\Mock\Entity\MockBuilding;
use OpenTribes\Core\Tests\Mock\Message\MockDisplayBuildingSlotsMessage;
use OpenTribes\Core\Tests\Mock\Repository\MockBuildingRepository;
use OpenTribes\Core\UseCase\DisplayBuildingSlots;
use OpenTribes\Core\View\BuildingView;
use OpenTribes\Core\View\SlotView;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenTribes\Core\UseCase\DisplayBuildingSlots
 */
final class DisplayBuildingSlotsTest extends TestCase
{

    public function testCanViewSlots(): void
    {
        $buildingRepository = new MockBuildingRepository();

        $message = new MockDisplayBuildingSlotsMessage();

        $useCase = new DisplayBuildingSlots($buildingRepository);
        $useCase->execute($message);

        $this->assertNotEmpty($message->getSlots());
        $this->assertCount(5, $message->getSlots());
    }

    public function testCanViewSlotsWithBuilding(): void
    {
        $building = new MockBuilding("Test",30);
        $building->setSlot(1);
        $buildingRepository = new MockBuildingRepository([$building]);

        $message = new MockDisplayBuildingSlotsMessage();

        $useCase = new DisplayBuildingSlots($buildingRepository);
        $useCase->execute($message);
        /** @var SlotView $firstSlot */
        $firstSlot = $message->getSlots()->first();

        $this->assertInstanceOf(BuildingView::class,$firstSlot->building);
    }

    public function testPlayDoNotOwnCity(): void
    {
        $building = new MockBuilding("Test",30);
        $building->setSlot(0);
        $buildingRepository = new MockBuildingRepository([$building],false);

        $message = new MockDisplayBuildingSlotsMessage(2);

        $useCase = new DisplayBuildingSlots($buildingRepository);
        $useCase->execute($message);

        $this->assertTrue($message->showOnlyCityData());
    }

}
