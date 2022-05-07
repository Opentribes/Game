<?php

declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Entity;

use OpenTribes\Core\Entity\Building;
use OpenTribes\Core\Entity\City;

use OpenTribes\Core\Enum\BuildStatus;

final class MockBuilding implements Building
{

    private string $slot = '';
    private int $level = 0;

    private City $city;
    private BuildStatus $status;


    public function __construct(private string $name, private int $maximumLevel)
    {
        $this->status = BuildStatus::default;
    }

    public function setSlot(string $slot): void
    {
        $this->slot = $slot;
    }

    public function getSlot(): string
    {
        return $this->slot;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function upgrade(): void
    {
        $this->level++;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function downgrade(): void
    {
        $this->level--;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getStatus(): BuildStatus
    {
        return $this->status;
    }

    public function setStatus(BuildStatus $status): void
    {
        $this->status = $status;
    }

    public function getMaximumLevel(): int
    {
        return $this->maximumLevel;
    }


    public function getCity(): City
    {
        return $this->city;
    }

    public function setCity(City $city): void
    {
        $this->city = $city;
    }
}
