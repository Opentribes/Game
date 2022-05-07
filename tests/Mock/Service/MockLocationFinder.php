<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Service;

use OpenTribes\Core\Service\LocationFinder;
use OpenTribes\Core\Utils\Location;

final class MockLocationFinder implements LocationFinder
{
    public function __construct(private Location $location)
    {
    }
    public function findUnusedLocation(): Location
    {
        return $this->location;
    }
}