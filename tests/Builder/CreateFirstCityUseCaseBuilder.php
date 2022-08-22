<?php

declare(strict_types=1);

namespace OpenTribes\Core\Tests\Builder;

use OpenTribes\Core\Entity\CityCollection;
use OpenTribes\Core\Tests\Mock\Entity\MockCity;
use OpenTribes\Core\Tests\Mock\Entity\MockUser;
use OpenTribes\Core\Tests\Mock\Repository\MockCityRepository;
use OpenTribes\Core\Tests\Mock\Repository\MockUserRepository;
use OpenTribes\Core\Tests\Mock\Service\MockLocationFinder;
use OpenTribes\Core\UseCase\CreateFirstCityUseCase;
use OpenTribes\Core\Utils\Location;


final class CreateFirstCityUseCaseBuilder
{
    private MockCityRepository $cityRepository;
    private MockLocationFinder $locationFinder;
    private MockUserRepository $userRepository;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->cityRepository = new MockCityRepository();

        $this->locationFinder = new MockLocationFinder(new Location(10, 10));

        $this->userRepository = new MockUserRepository();
    }

    public function getUseCase(): CreateFirstCityUseCase
    {
        return new CreateFirstCityUseCase($this->cityRepository, $this->userRepository, $this->locationFinder);
    }

    public function withMockUser(): self
    {
        $cityCollection = new CityCollection(...[new MockCity(new Location(1, 2))]);
        $mockUser = new MockUser($cityCollection);
        $this->userRepository = new MockUserRepository($mockUser);
        return $this;
    }

    public function withEmptyCityRepository(): self
    {
        $this->cityRepository = new MockCityRepository(0, true);
        return $this;
    }

    public function withSpecialLocation(Location $specialLocation): self
    {
        $this->locationFinder = new MockLocationFinder($specialLocation);
        return $this;
    }
}