<?php

declare(strict_types=1);

namespace OpenTribes\Core\Tests\UseCase;

use OpenTribes\Core\Entity\CityCollection;
use OpenTribes\Core\Exception\FailedToAddCity;
use OpenTribes\Core\Repository\CityRepository;
use OpenTribes\Core\Repository\UserRepository;
use OpenTribes\Core\Service\LocationFinder;
use OpenTribes\Core\Tests\Builder\CreateFirstCityUseCaseBuilder;
use OpenTribes\Core\Tests\Mock\Entity\MockCity;
use OpenTribes\Core\Tests\Mock\Entity\MockUser;
use OpenTribes\Core\Tests\Mock\Message\MockCreateFirstCityMessage;
use OpenTribes\Core\Tests\Mock\Repository\MockCityRepository;
use OpenTribes\Core\Tests\Mock\Repository\MockUserRepository;
use OpenTribes\Core\Tests\Mock\Service\MockLocationFinder;
use OpenTribes\Core\UseCase\CreateFirstCityUseCase;
use OpenTribes\Core\Utils\Location;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass CreateFirstCityUseCase
 */
final class CreateFirstCityTest extends TestCase
{
    private CreateFirstCityUseCaseBuilder $builder;

    public function setUp(): void
    {
        $this->builder = new CreateFirstCityUseCaseBuilder();
    }

    public function tearDown(): void
    {
        $this->builder->reset();
    }


    public function testFailedToCreateCity(): void
    {

        $this->expectException(FailedToAddCity::class);
        $useCase = $this->builder->getUseCase();

        $message = new MockCreateFirstCityMessage();
        $useCase->process($message);

        $this->assertNull($message->city);
    }

    public function testUserHasCities(): void
    {
        $builder = $this->builder->withMockUser();

        $useCase = $builder->getUseCase();

        $message = new MockCreateFirstCityMessage();
        $useCase->process($message);

        $this->assertNull($message->city);
    }

    public function testCityCreatedAtLocation(): void
    {
        $builder = $this->builder->withEmptyCityRepository();

        $useCase = $builder->getUseCase();

        $message = new MockCreateFirstCityMessage();
        $useCase->process($message);

        $expectedLocation = new Location(10, 10);
        $this->assertNotNull($message->city);
        $this->assertEquals($expectedLocation, $message->city->location);
    }

    public function testCityCreatedOnDifferentLocation(): void
    {
        $expectedLocation = new Location(20, 10);

        $builder = $this->builder->withSpecialLocation($expectedLocation);
        $builder = $builder->withEmptyCityRepository();


        $useCase = $builder->getUseCase();
        $message = new MockCreateFirstCityMessage();
        $useCase->process($message);

        $this->assertNotNull($message->city);
        $this->assertEquals($expectedLocation, $message->city->location);
    }
}
