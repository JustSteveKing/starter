<?php

declare(strict_types=1);

namespace App\Observers;

use App\Jobs\Workspaces\AddMembership;
use App\Models\Workspace;
use Illuminate\Contracts\Bus\Dispatcher;
use Throwable;

final readonly class WorkspaceObserver
{
    public function __construct(
        private Dispatcher $bus,
    ) {}

    /** @throws Throwable */
    public function created(Workspace $workspace): void
    {
        $this->bus->dispatch(
            command: new AddMembership(
                workspace: $workspace,
            ),
        );
    }
}
