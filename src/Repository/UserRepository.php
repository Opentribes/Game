<?php

declare(strict_types=1);

namespace OpenTribes\Core\Repository;

use OpenTribes\Core\Entity\User;

interface UserRepository
{
    public function findByUsername(string $username): User;
}
