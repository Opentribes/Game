<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Entity;

use OpenTribes\Core\Entity\Tile;
use OpenTribes\Core\Utils\Location;

final class MockTile implements Tile
{
    private string $id = '';
    private string $data = '';
    public function __construct(private Location $location)
    {
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }


}