<?php

declare(strict_types=1);

namespace App\Jobs\Onboarding;

use App\Actions\Workspaces\CreateNew;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

final class CreateDefaultWorkspace implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly string $user,
    ) {}

    /** @throws Throwable */
    public function handle(CreateNew $action): void
    {
        $action->handle(
            name: 'default',
            user: $this->user,
        );
    }
}
