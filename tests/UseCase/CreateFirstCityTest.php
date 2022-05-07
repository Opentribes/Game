<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\UseCase;

use OpenTribes\Core\Entity\CityCollection;
use OpenTribes\Core\Exception\FailedToAddCity;
use OpenTribes\Core\Repository\CityRepository;
use OpenTribes\Core\Repository\UserRepository;
use OpenTribes\Core\Service\LocationFinder;
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
    private function getUseCase(
        ?CityRepository $cityRepository =null,
        ?UserRepository $userRepository = null,
        ?LocationFinder $locationFinder = null
    ):CreateFirstCityUseCase{
        if(!$cityRepository){
            $cityRepository = new MockCityRepository();
        }
        if(!$locationFinder){
            $locationFinder = new MockLocationFinder(new Location(10,10));
        }
        if(!$userRepository){
            $userRepository = new MockUserRepository();
        }

        return new CreateFirstCityUseCase($cityRepository,$userRepository,$locationFinder);
    }
    public function testFailedToCreateCity():void
    {
        $this->expectException(FailedToAddCity::class);
        $useCase = $this->getUseCase();
        $message = new MockCreateFirstCityMessage();
        $useCase->process($message);
        $this->assertNull($message->city);
    }
    
    public function testUserHasCities(): void
    {
        $cityCollection = new CityCollection(...[new MockCity(new Location(1,2))]);
        $mockUser = new MockUser($cityCollection);
        $userRepository = new MockUserRepository($mockUser);
        $useCase = $this->getUseCase(userRepository:$userRepository);
        $message = new MockCreateFirstCityMessage();
        $useCase->process($message);
        $this->assertNull($message->city);
    }

    public function testCityCreated():void
    {
        $cityRepository = new MockCityRepository(0,true);
        $useCase = $this->getUseCase($cityRepository);
        $message = new MockCreateFirstCityMessage();
        $useCase->process($message);
        $this->assertNotNull($message->city);
    }
    public function testCityCreatedAtLocation():void{
        $cityRepository = new MockCityRepository(0,true);
        $useCase = $this->getUseCase($cityRepository);
        $message = new MockCreateFirstCityMessage();
        $useCase->process($message);
        $expectedLocation = new Location(10,10);
        $this->assertNotNull($message->city);
        $this->assertEquals($expectedLocation,$message->city->location);
    }
    public function testCityCreatedOnDifferentLocation():void{
        $cityRepository = new MockCityRepository(0,true);
        $expectedLocation = new Location(20,10);
        $locationFinder = new MockLocationFinder($expectedLocation);
        $useCase = $this->getUseCase($cityRepository,locationFinder:$locationFinder);
        $message = new MockCreateFirstCityMessage();
        $useCase->process($message);
        $this->assertNotNull($message->city);
        $this->assertEquals($expectedLocation,$message->city->location);
    }
}
