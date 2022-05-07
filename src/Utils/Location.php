<?php

declare(strict_types=1);

namespace OpenTribes\Core\Utils;

final class Location
{
    public function __construct(private int $x = 0, private int $y = 0)
    {
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }
}
