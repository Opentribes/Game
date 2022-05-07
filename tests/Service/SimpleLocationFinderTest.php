<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\Service;

use OpenTribes\Core\Tests\Mock\Entity\MockCity;
use OpenTribes\Core\Entity\CityCollection;
use OpenTribes\Core\Service\SimpleLocationFinder;
use OpenTribes\Core\Tests\Mock\Repository\MockCityRepository;
use OpenTribes\Core\Utils\Location;
use PHPUnit\Framework\TestCase;

final class SimpleLocationFinderTest extends TestCase
{
    public function testLocationFound():void{
        $mockCityRepository = new MockCityRepository();
        $locationFinder = new SimpleLocationFinder($mockCityRepository,100);
        $this->assertNotNull($locationFinder->findUnusedLocation());
    }

    public function testNextLocationFound():void
    {
        $mockCityRepository = new MockCityRepository();
        $mockCity = new MockCity(new Location(0,0));
        $cityCollection = new CityCollection(...[$mockCity]);
        $mockCityRepository->setCities($cityCollection);
        $locationFinder = new SimpleLocationFinder($mockCityRepository,100);
        $expectedLocation = new Location(1,0);
        $this->assertEquals($expectedLocation,$locationFinder->findUnusedLocation());
    }
    public function testLastLocationFound():void
    {
        $mockCityRepository = new MockCityRepository();
        $mockCity1 = new MockCity(new Location(0,0));
        $mockCity2 = new MockCity(new Location(1,0));
        $cityCollection = new CityCollection(...[$mockCity1,$mockCity2]);

        $mockCityRepository->setCities($cityCollection);
        $locationFinder = new SimpleLocationFinder($mockCityRepository,100);
        $expectedLocation = new Location(2,0);
        $this->assertEquals($expectedLocation,$locationFinder->findUnusedLocation());
    }
    public function testBoundariesReached():void{
        $mockCityRepository = new MockCityRepository();
        $mockCity1 = new MockCity(new Location(0,0));
        $mockCity2 = new MockCity(new Location(1,0));
        $cityCollection = new CityCollection(...[$mockCity1,$mockCity2]);

        $mockCityRepository->setCities($cityCollection);
        $locationFinder = new SimpleLocationFinder($mockCityRepository,1);
        $expectedLocation = new Location(0,1);
        $this->assertEquals($expectedLocation,$locationFinder->findUnusedLocation());
    }
}
