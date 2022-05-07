<?php

declare(strict_types=1);

namespace OpenTribes\Core\View;

use OpenTribes\Core\Utils\Collection;

final class BuildingViewCollection extends Collection
{
    public function __construct(BuildingView ...$building)
    {
        $this->collection = $building;
    }

    public function offsetGet(mixed $offset): BuildingView
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! ($value instanceof BuildingView)) {
            throw new \InvalidArgumentException($value . ' is not instance of ' . BuildingView::class);
        }
        parent::offsetSet($offset, $value);
    }

    public function current(): BuildingView
    {
        return parent::current();
    }
}
