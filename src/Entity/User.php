<?php

declare(strict_types=1);

namespace OpenTribes\Core\Entity;

use OpenTribes\Core\Utils\Collectible;

interface User extends Collectible
{
    public function getCities(): CityCollection;
    public function getUsername(): string;
}
