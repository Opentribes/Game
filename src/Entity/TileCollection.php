<?php

declare(strict_types=1);

namespace OpenTribes\Core\Entity;

use OpenTribes\Core\Utils\Collection;

final class TileCollection extends Collection
{
    public function __construct(Tile ...$tiles)
    {
        $this->collection = $tiles;
    }

    public function offsetGet(mixed $offset): Tile
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! ($value instanceof Tile)) {
            throw new \InvalidArgumentException($value . ' is not instance of ' . Tile::class);
        }
        parent::offsetSet($offset, $value);
    }

    public function current(): Tile
    {
        return parent::current();
    }
}
