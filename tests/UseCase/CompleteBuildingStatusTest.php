<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\UseCase;

use OpenTribes\Core\Enum\BuildStatus;
use OpenTribes\Core\Tests\Mock\Entity\MockBuilding;
use OpenTribes\Core\Tests\Mock\Message\MockCompleteBuildingStatusMessage;
use OpenTribes\Core\Tests\Mock\Repository\MockBuildingRepository;
use OpenTribes\Core\UseCase\CompleteBuildingStatusUseCase;
use PHPUnit\Framework\TestCase;

final class CompleteBuildingStatusTest extends TestCase
{
    public function testNothingToComplete(): void{

        $mockBuildingRepository = new MockBuildingRepository();
        $useCase = new CompleteBuildingStatusUseCase($mockBuildingRepository);
        $message = new MockCompleteBuildingStatusMessage();
        $useCase->execute($message);
        $this->assertSame(0,$message->getCompleted());
    }
    public function testBuildingIsUpgraded(): void
    {
        $buildings = [];
        $building = new MockBuilding('test',2);
        $building->setStatus(BuildStatus::UPGRADING);
        $buildings[]=$building;

        $mockBuildingRepository = new MockBuildingRepository($buildings);
        $useCase = new CompleteBuildingStatusUseCase($mockBuildingRepository);
        $message = new MockCompleteBuildingStatusMessage();
        $useCase->execute($message);
        $this->assertSame(1,$message->getCompleted());
    }
    public function testBuildingIsDowngraded(): void{
        $buildings = [];
        $building = new MockBuilding('test',2);
        $building->setStatus(BuildStatus::DOWNGRADING);
        $buildings[]=$building;
        $mockBuildingRepository = new MockBuildingRepository($buildings);
        $useCase = new CompleteBuildingStatusUseCase($mockBuildingRepository);
        $message = new MockCompleteBuildingStatusMessage();
        $useCase->execute($message);
        $this->assertSame(1,$message->getCompleted());
    }
    public function testDefaultStatusIsSkipped(): void{
        $buildings = [];
        $building = new MockBuilding('test',2);
        $building->setStatus(BuildStatus::default);
        $buildings[]=$building;
        $mockBuildingRepository = new MockBuildingRepository($buildings);
        $useCase = new CompleteBuildingStatusUseCase($mockBuildingRepository);
        $message = new MockCompleteBuildingStatusMessage();
        $useCase->execute($message);
        $this->assertSame(0,$message->getCompleted());
    }
}

