<?php

declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Entity;

use OpenTribes\Core\Entity\Building;
use OpenTribes\Core\Entity\BuildingCollection;
use OpenTribes\Core\Entity\City;
use OpenTribes\Core\Entity\User;
use OpenTribes\Core\Utils\Location;

final class MockCity implements City
 {
     private int $locationX;
     private int $locationY;

     private BuildingCollection $buildings;
     private User $user;

     public function __construct(private Location $location)
     {
         $this->locationY = $this->location->getY();
         $this->locationX = $this->location->getX();
         $this->buildings = new BuildingCollection();
     }

     public function getLocation(): Location
     {
         return new Location($this->locationX, $this->locationY);
     }

     public function setLocation(Location $location): void
     {
         $this->location = $location;
         $this->locationY = $this->location->getY();
         $this->locationX = $this->location->getX();
     }

     public function getBuildings(): BuildingCollection
     {
         return $this->buildings;
     }

     public function setBuildings(BuildingCollection $buildings): void
     {
         /** @var Building $building */
         foreach ($buildings as $building) {
             $building->setCity($this);
         }
         $this->buildings = $buildings;
     }

     public function getUser(): User
     {
         return $this->user;
     }

     public function setUser(User $user): void
     {
         $this->user = $user;
     }
 }
