<?php

declare(strict_types=1);

namespace OpenTribes\Core\Message;

use OpenTribes\Core\Utils\Viewport;
use OpenTribes\Core\View\MapView;

interface ViewMapMessage
{
    public function getViewport(): Viewport;
    public function setMap(MapView $map): void;
}
