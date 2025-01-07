<?php

declare(strict_types=1);

use App\Enums\Identity\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('memberships', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('role')->default(Role::Member);

            $table
                ->foreignUlid('user_id')
                ->index()
                ->constrained('users')
                ->cascadeOnDelete();

            $table
                ->foreignUlid('workspace_id')
                ->index()
                ->constrained('workspaces')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
