<?php

declare(strict_types=1);

namespace OpenTribes\Core\Repository;

use OpenTribes\Core\Entity\City;
use OpenTribes\Core\Entity\CityCollection;
use OpenTribes\Core\Utils\Location;
use OpenTribes\Core\Utils\Viewport;

interface CityRepository
{
    public function countByUsername(string $username): int;

    public function add(City $city): void;
    public function create(Location $location): City;
    public function countAtLocation(Location $location): int;
    public function findAtLocation(Location $location): City;
    public function findByViewport(Viewport $viewport): CityCollection;
}
