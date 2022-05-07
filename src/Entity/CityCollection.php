<?php

declare(strict_types=1);

namespace OpenTribes\Core\Entity;

use OpenTribes\Core\Utils\Collection;

final class CityCollection extends Collection
{
    public function __construct(City ...$city)
    {
        $this->collection = $city;
    }
    public function offsetGet(mixed $offset): City
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! ($value instanceof City)) {
            throw new \InvalidArgumentException($value . ' is not instance of ' . City::class);
        }
        parent::offsetSet($offset, $value);
    }

    public function current(): City
    {
        return parent::current();
    }
}
