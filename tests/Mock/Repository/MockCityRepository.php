<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Repository;

use OpenTribes\Core\Entity\City;
use OpenTribes\Core\Entity\CityCollection;
use OpenTribes\Core\Exception\FailedToAddCity;
use OpenTribes\Core\Exception\InvalidLocation;
use OpenTribes\Core\Repository\CityRepository;
use OpenTribes\Core\Tests\Mock\Entity\MockCity;
use OpenTribes\Core\Utils\Location;
use OpenTribes\Core\Utils\Viewport;

final class MockCityRepository implements CityRepository
{
    private CityCollection $cities;
    public function __construct(private int $cityCount = 0,private bool $added = false)
    {
        $this->cities = new CityCollection();
    }

    /**
     * @param CityCollection $cities
     */
    public function setCities(CityCollection $cities): void
    {
        $this->cities = $cities;
    }

    public function add(City $city): void
    {
         if($this->added){
             return;

         }
        throw new FailedToAddCity();
    }

    public function countByUsername(string $username): int
    {
        return  $this->cityCount;
    }

    public function countAtLocation(Location $location): int
    {

        $cities = $this->cities->filter(function (City $city) use($location){
            $cityLocation = $city->getLocation();
           return $cityLocation->getX() === $location->getX() &&
               $cityLocation->getY() === $location->getY();
        });

        return count($cities);
    }

    public function findAtLocation(Location $location): City
    {
        $cities = $this->cities->filter(function (City $city) use($location){
            $cityLocation = $city->getLocation();
            return $cityLocation->getX() === $location->getX() &&
                $cityLocation->getY() === $location->getY();
        });

        $city = current($cities);
        if($city === false){
            throw new InvalidLocation(sprintf("The Location X:%d/Y:%d is invalid",$location->getX(),$location->getY()));
        }
        return $city;
    }

    public function create(Location $location): City
    {
      return new MockCity($location);
    }

    public function findByViewport(Viewport $viewport): CityCollection
    {
        return  $this->cities;
    }


}