<?php

declare(strict_types=1);

namespace OpenTribes\Core\Enum;

enum BuildStatus: string
{
    case UPGRADING = 'upgrading';
    case DOWNGRADING = 'downgrading';
    case default = 'default';
}
