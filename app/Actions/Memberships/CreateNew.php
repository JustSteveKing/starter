<?php

declare(strict_types=1);

namespace App\Actions\Memberships;

use App\Enums\Identity\Role;
use App\Models\Membership;
use Illuminate\Database\DatabaseManager;
use Throwable;

final readonly class CreateNew
{
    public function __construct(
        private DatabaseManager $database,
    ) {}

    /** @throws Throwable */
    public function handle(Role $role, string $user, string $workspace): void
    {
        $this->database->transaction(
            callback: fn() => Membership::query()->create(
                attributes: [
                    'role' => $role,
                    'user_id' => $user,
                    'workspace_id' => $workspace,
                ],
            ),
            attempts: 3,
        );
    }
}
