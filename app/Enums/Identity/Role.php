<?php

declare(strict_types=1);

namespace App\Enums\Identity;

enum Role: string
{
    case Member = 'member';
    case Owner = 'owner';
    case Admin = 'admin';
}
