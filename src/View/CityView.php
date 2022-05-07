<?php

declare(strict_types=1);

namespace OpenTribes\Core\View;

use OpenTribes\Core\Entity\City;
use OpenTribes\Core\Utils\Location;

final class CityView
{
    public function __construct(public readonly Location $location)
    {
    }

    public static function fromEntity(City $city): self
    {
        return new self($city->getLocation());
    }
}
