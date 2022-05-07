<?php

declare(strict_types=1);

namespace OpenTribes\Core\Utils;

use Closure;

abstract class Collection implements \Countable, \ArrayAccess, \Iterator
{
    /**
     * @param array<Collectible> $collection
     */
    protected array $collection = [];
    private int $position = 0;

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->collection[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->collection[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->collection[] = $value;

            return;
        }
        $this->collection[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->collection[$offset]);
    }

    public function current(): mixed
    {
        return $this->collection[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->collection[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function count(): int
    {
        return count($this->collection);
    }

    public function first(): mixed
    {
        $collection = $this->collection;
        return array_shift($collection);
    }

    public function last(): mixed
    {
        $collection = $this->collection;
        return array_pop($collection);
    }

    /**
     * @return array<Collectible>
     */
    public function filter(Closure $function): array
    {
        return array_filter($this->collection, $function);
    }

    public function getElements(): array
    {
        return $this->collection;
    }
}
