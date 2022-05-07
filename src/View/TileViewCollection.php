<?php

declare(strict_types=1);

namespace OpenTribes\Core\View;

use OpenTribes\Core\Utils\Collection;

final class TileViewCollection extends Collection
{
    public function __construct(TileView ...$building)
    {
        $this->collection = $building;
    }

    public function offsetGet(mixed $offset): TileView
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! ($value instanceof TileView)) {
            throw new \InvalidArgumentException($value . ' is not instance of ' . TileView::class);
        }
        parent::offsetSet($offset, $value);
    }

    public function current(): TileView
    {
        return parent::current();
    }
}
