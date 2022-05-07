<?php

declare(strict_types=1);

namespace OpenTribes\Core\View;

use OpenTribes\Core\Utils\Collection;

final class CityViewCollection extends Collection
{
    public function __construct(CityView ...$building)
    {
        $this->collection = $building;
    }

    public function offsetGet(mixed $offset): CityView
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! ($value instanceof CityView)) {
            throw new \InvalidArgumentException($value . ' is not instance of ' . CityView::class);
        }
        parent::offsetSet($offset, $value);
    }

    public function current(): CityView
    {
        return parent::current();
    }
}
