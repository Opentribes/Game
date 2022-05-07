<?php

declare(strict_types=1);

namespace OpenTribes\Core\View;

use OpenTribes\Core\Entity\Building;
use OpenTribes\Core\Enum\BuildStatus;
use OpenTribes\Core\Utils\Collectible;

final class BuildingView implements Collectible
{
    public function __construct(
        public readonly string $name,
        public readonly int $level,
        public readonly BuildStatus $status
    ) {
    }

    public static function fromEntity(Building $building): self
    {
        return new self(
            $building->getName(),
            $building->getLevel(),
            $building->getStatus()
        );
    }
}
