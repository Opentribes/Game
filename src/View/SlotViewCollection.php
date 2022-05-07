<?php

declare(strict_types=1);

namespace OpenTribes\Core\View;

use OpenTribes\Core\Utils\Collection;

final class SlotViewCollection extends Collection
{
    public function __construct(SlotView ...$building)
    {
        $this->collection = $building;
    }

    public function offsetGet(mixed $offset): SlotView
    {
        return parent::offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! ($value instanceof SlotView)) {
            throw new \InvalidArgumentException($value . ' is not instance of ' . SlotView::class);
        }
        parent::offsetSet($offset, $value);
    }

    public function current(): SlotView
    {
        return parent::current();
    }
}
