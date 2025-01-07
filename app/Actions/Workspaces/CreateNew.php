<?php

declare(strict_types=1);

namespace App\Actions\Workspaces;

use App\Models\Workspace;
use Illuminate\Database\DatabaseManager;
use Throwable;

final readonly class CreateNew
{
    public function __construct(
        private DatabaseManager $database,
    ) {}

    /** @throws Throwable */
    public function handle(string $name, string $user): Workspace
    {
        return $this->database->transaction(
            callback: fn() => Workspace::query()->create(
                attributes: [
                    'name' => $name,
                    'user_id' => $user,
                ],
            ),
            attempts: 3,
        );
    }
}
