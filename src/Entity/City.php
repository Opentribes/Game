<?php

declare(strict_types=1);

namespace OpenTribes\Core\Entity;

use OpenTribes\Core\Utils\Collectible;
use OpenTribes\Core\Utils\Location;

interface City extends Collectible
{
    public function getLocation(): Location;

    public function setLocation(Location $location): void;

    public function getBuildings(): BuildingCollection;

    public function setBuildings(BuildingCollection $buildings): void;

    public function getUser(): User;

    public function setUser(User $user): void;
}
