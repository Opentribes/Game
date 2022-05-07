<?php

declare(strict_types=1);

namespace OpenTribes\Core\Entity;

use OpenTribes\Core\Enum\BuildStatus;
use OpenTribes\Core\Utils\Collectible;

interface Building extends Collectible
{
    public function setSlot(string $slot): void;

    public function getSlot(): string;

    public function getName(): string;

    public function upgrade(): void;

    public function getLevel(): int;

    public function downgrade(): void;

    public function setLevel(int $level): void;

    public function getStatus(): BuildStatus;

    public function setStatus(BuildStatus $status): void;

    public function getMaximumLevel(): int;

    public function getCity(): City;

    public function setCity(City $city): void;
}
