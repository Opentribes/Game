<?php

declare(strict_types=1);

namespace OpenTribes\Core\Service;

use OpenTribes\Core\Utils\Location;

interface LocationFinder
{
    public function findUnusedLocation(): Location;
}
