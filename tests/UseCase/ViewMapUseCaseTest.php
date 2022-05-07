<?php

declare(strict_types=1);

namespace OpenTribes\Core\Tests\UseCase;

use OpenTribes\Core\Entity\CityCollection;
use OpenTribes\Core\Tests\Mock\Entity\MockCity;
use OpenTribes\Core\Tests\Mock\Message\MockViewMapMessage;
use OpenTribes\Core\Tests\Mock\Repository\MockCityRepository;
use OpenTribes\Core\Tests\Mock\Repository\MockMapTileRepository;
use OpenTribes\Core\UseCase\ViewMapUseCase;
use OpenTribes\Core\Utils\Location;
use OpenTribes\Core\Utils\Viewport;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \OpenTribes\Core\UseCase\ViewMapUseCase
 */
final class ViewMapUseCaseTest extends TestCase
{
    private function getUseCase(
        $tilesRepository = new MockMapTileRepository(),
        $cityRepository = new MockCityRepository()
    ): ViewMapUseCase {
        return new ViewMapUseCase($tilesRepository, $cityRepository);
    }

    public function testCanShowMap(): void
    {
        $useCase = $this->getUseCase();
        $message = new MockViewMapMessage();
        $useCase->process($message);
        $this->assertNotNull($message->map);
    }

    public function testCanFindTilesInViewPort(): void
    {
        $useCase = $this->getUseCase();
        $message = new MockViewMapMessage();

        $useCase->process($message);

        $expectedArray = [
            '0-0',
            '0-1',
            '0-2',
            '1-0',
            '1-1',
            '1-2',
            '2-0',
            '2-1',
            '2-2',
        ];

        $tiles = $message->map->backgroundLayer;
        $actualArray = [];
        foreach ($tiles as $tile) {
            $actualArray[] = $tile->location->getY() . '-' . $tile->location->getX();
        }
        $this->assertSame($expectedArray, $actualArray);
    }

    public function testCanMoveViewPort(): void
    {
        $tilesRepository = new MockMapTileRepository(10, 10);
        $viewPort = new Viewport(new Location(2, 2), 3, 3);
        $message = new MockViewMapMessage($viewPort);

        $useCase = $this->getUseCase($tilesRepository);
        $useCase->process($message);

        $expectedArray = [
            '1-1',
            '1-2',
            '1-3',
            '2-1',
            '2-2',
            '2-3',
            '3-1',
            '3-2',
            '3-3'
        ];

        $tiles = $message->map->backgroundLayer;
        $actualArray = [];
        foreach ($tiles as $tile) {
            $actualArray[] = $tile->location->getY() . '-' . $tile->location->getX();
        }
        $this->assertSame($expectedArray, $actualArray);
    }

    public function testCanFindCitiesInViewport(): void
    {
        $cityRepository = new MockCityRepository();
        $cityRepository->setCities(new CityCollection(new MockCity(new Location(1, 1))));
        $useCase = $this->getUseCase(cityRepository: $cityRepository);
        $message = new MockViewMapMessage();
        $useCase->process($message);

        $useCase->process($message);
        $this->assertSame(1, $message->map->cityViewCollection->count());
    }
}