<?php

declare(strict_types=1);

namespace OpenTribes\Core\UseCase;

use OpenTribes\Core\Message\ViewMapMessage;
use OpenTribes\Core\Repository\CityRepository;
use OpenTribes\Core\Repository\MapTileRepository;
use OpenTribes\Core\View\CityView;
use OpenTribes\Core\View\CityViewCollection;
use OpenTribes\Core\View\MapView;
use OpenTribes\Core\View\TileView;
use OpenTribes\Core\View\TileViewCollection;

final class ViewMapUseCase
{
    public function __construct(private MapTileRepository $mapTilesRepository, private CityRepository $cityRepository)
    {
    }

    public function process(ViewMapMessage $message): void
    {
        $tiles = $this->mapTilesRepository->findByViewport($message->getViewport());
        $backgroundLayer = new TileViewCollection();
        foreach ($tiles as $tile) {
            $backgroundLayer[] = TileView::createFromEntity($tile);
        }

        $cityLayer = new CityViewCollection();
        $cities = $this->cityRepository->findByViewport($message->getViewport());
        foreach ($cities as $city) {
            $cityLayer[] = CityView::fromEntity($city);
        }

        $map = new MapView($backgroundLayer, $cityLayer);

        $message->setMap($map);
    }
}
