<?php

declare(strict_types=1);

namespace OpenTribes\Core\UseCase;

use OpenTribes\Core\Message\CreateFirstCityMessage;
use OpenTribes\Core\Repository\CityRepository;
use OpenTribes\Core\Repository\UserRepository;
use OpenTribes\Core\Service\LocationFinder;
use OpenTribes\Core\View\CityView;

final class CreateFirstCityUseCase
{
    public function __construct(
        private CityRepository $cityRepository,
        private UserRepository $userRepository,
        private LocationFinder $locationFinder
    ) {
    }

    public function process(CreateFirstCityMessage $message): void
    {
        $user = $this->userRepository->findByUsername($message->getUsername());
        if ($user->getCities()->count() > 0) {
            return;
        }
        $location = $this->locationFinder->findUnusedLocation();
        $city = $this->cityRepository->create($location);
        $city->setUser($user);
        $this->cityRepository->add($city);
        $message->setCity(CityView::fromEntity($city));
    }
}
