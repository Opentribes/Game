<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Message;

use OpenTribes\Core\Message\CreateFirstCityMessage;
use OpenTribes\Core\View\CityView;

final class MockCreateFirstCityMessage implements CreateFirstCityMessage
{
    private bool $created = false;
    public ?CityView $city = null;
    public function activateCreated(): void
    {
        $this->created = true;
    }


    public function cityCreated():bool
    {
        return $this->created;
    }

    public function setCity(CityView $city):void
    {
         $this->city = $city;
    }

    public function getUsername(): string
    {
        return 'testUser';
    }


}