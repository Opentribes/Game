<?php
declare(strict_types=1);

namespace OpenTribes\Core\Tests\Mock\Repository;

use OpenTribes\Core\Entity\User;
use OpenTribes\Core\Repository\UserRepository;
use OpenTribes\Core\Tests\Mock\Entity\MockUser;

final class MockUserRepository implements UserRepository
{
    public function __construct(private MockUser $user = new MockUser()){

    }
    public function findByUsername(string $username): User
    {
        return $this->user;
    }


}