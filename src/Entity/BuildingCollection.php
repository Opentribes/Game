<?php

declare(strict_types=1);

namespace OpenTribes\Core\Entity;

use OpenTribes\Core\Utils\Collection;

final class BuildingCollection extends Collection
{
    public function __construct(Building ...$building)
    {
        $this->collection = $building;
    }
    public function offsetGet(mixed $offset): Building
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! ($value instanceof Building)) {
            throw new \InvalidArgumentException($value . ' is not instance of ' . Building::class);
        }
        parent::offsetSet($offset, $value);
    }

    public function current(): Building
    {
        return parent::current();
    }

    public function fromSlot(string $slotNumber): ?Building
    {
        /** @var array<Building> $result */
        $result = $this->filter(
            static function (Building $building) use ($slotNumber) {
                return $building->getSlot() === $slotNumber;
            }
        );

        return array_shift($result);
    }
}
