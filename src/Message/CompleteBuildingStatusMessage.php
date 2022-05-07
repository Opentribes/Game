<?php

declare(strict_types=1);

namespace OpenTribes\Core\Message;

interface CompleteBuildingStatusMessage
{
    public function incrementCompleted(): void;
    public function getCompleted(): int;
    public function getLocationY(): int;
    public function getLocationX(): int;
}
