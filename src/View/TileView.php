<?php

declare(strict_types=1);

namespace OpenTribes\Core\View;

use OpenTribes\Core\Entity\Tile;
use OpenTribes\Core\Utils\Location;

final class TileView implements \JsonSerializable
{
    public function __construct(public readonly string $id,public readonly string $data,public readonly Location $location)
    {
    }
    public static function createFromEntity(Tile $tile): self
    {
        return new self($tile->getId(),$tile->getData(),$tile->getLocation());
    }

    function jsonSerialize():mixed
    {
        return [
            'id'=>$this->id,
            'data'=>$this->data,
            'location'=>[
                'x'=>$this->location->getX(),
                'y'=>$this->location->getY(),
            ]
        ];
    }

}
