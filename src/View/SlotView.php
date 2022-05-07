<?php

declare(strict_types=1);

namespace OpenTribes\Core\View;

use OpenTribes\Core\Utils\Collectible;

final class SlotView implements Collectible
{
    public ?BuildingView $building = null;
}
