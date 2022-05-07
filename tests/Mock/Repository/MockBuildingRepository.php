<?php

declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Repository;

use OpenTribes\Core\Entity\Building;
use OpenTribes\Core\Entity\BuildingCollection;
use OpenTribes\Core\Repository\BuildingRepository;


final class MockBuildingRepository implements BuildingRepository
{
    public function __construct(private array $collection = [],private bool $userCanBuildAtLocation = true)
    {
    }

    public function findAllAtLocation(int $locationX, int $locationY): BuildingCollection
    {
        return new BuildingCollection(...$this->collection);
    }

    public function findAvailable(): BuildingCollection
    {
        return new BuildingCollection(...$this->collection);
    }

    public function userCanBuildAtLocation(int $locationX, int $locationY, string $username): bool
    {
       return $this->userCanBuildAtLocation;
    }

    public function add(Building $building):void
    {
       $this->collection[]=$building;
    }


}