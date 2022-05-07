<?php

declare(strict_types=1);

namespace OpenTribes\Core\Repository;

use OpenTribes\Core\Entity\TileCollection;
use OpenTribes\Core\Utils\Viewport;

interface MapTileRepository
{
    public function findByViewport(Viewport $viewport): TileCollection;
}
