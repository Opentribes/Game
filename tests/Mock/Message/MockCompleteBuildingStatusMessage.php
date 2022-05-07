<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Message;

use OpenTribes\Core\Message\CompleteBuildingStatusMessage;

final class MockCompleteBuildingStatusMessage implements CompleteBuildingStatusMessage
{

    public function __construct(private int $completed = 0)
    {
    }

    public function getLocationX(): int
    {
        return 1;
    }

    public function getLocationY(): int
    {
        return 1;
    }

    public function getCompleted():int
    {
        return $this->completed;
    }

    public function incrementCompleted(): void
    {
        $this->completed++;
    }

}