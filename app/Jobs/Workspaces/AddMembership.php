<?php

declare(strict_types=1);

namespace App\Jobs\Workspaces;

use App\Actions\Memberships\CreateNew;
use App\Enums\Identity\Role;
use App\Models\Workspace;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Throwable;

final class AddMembership implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly Workspace $workspace,
        public readonly Role $role = Role::Member,
    ) {}

    /** @throws Throwable */
    public function handle(CreateNew $action): void
    {
        $action->handle(
            role: $this->role,
            user: $this->workspace->user_id,
            workspace: $this->workspace->id,
        );
    }
}
