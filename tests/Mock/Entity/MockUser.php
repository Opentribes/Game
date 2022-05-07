<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Entity;

use OpenTribes\Core\Entity\CityCollection;
use OpenTribes\Core\Entity\User;

final class MockUser implements User
{
    public function __construct(private CityCollection $cityCollection = new CityCollection()){
    }
    public function getCities(): CityCollection
    {
        return  $this->cityCollection;
    }

    public function getUsername(): string
    {
       return '';
    }

}