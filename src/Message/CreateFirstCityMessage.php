<?php

declare(strict_types=1);

namespace OpenTribes\Core\Message;

use OpenTribes\Core\View\CityView;

interface CreateFirstCityMessage
{
    public function cityCreated(): bool;

    public function activateCreated(): void;

    public function setCity(CityView $city): void;
    public function getUsername(): string;
}
