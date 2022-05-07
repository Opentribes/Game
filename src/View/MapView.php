<?php

declare(strict_types=1);

namespace OpenTribes\Core\View;

final class MapView
{
    /** @var array<string,TileViewCollection> */
    public array $layers;

    public function __construct(public readonly TileViewCollection $backgroundLayer, public readonly CityViewCollection $cityViewCollection)
    {
        $this->layers['background'] = $this->backgroundLayer;
        $this->layers['cities'] = $this->cityViewCollection;
    }
}
