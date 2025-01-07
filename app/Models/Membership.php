<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Identity\Role;
use Carbon\CarbonInterface;
use Database\Factories\MembershipFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property Role $role
 * @property string $user_id
 * @property string $workspace_id
 * @property CarbonInterface|null $created_at
 * @property CarbonInterface|null $updated_at
 * @property User $user
 * @property Workspace $workspace
 */
final class Membership extends Model
{
    /** @use HasFactory<MembershipFactory> */
    use HasFactory;
    use HasUlids;

    /** @var list<string> */
    protected $fillable = [
        'role',
        'user_id',
        'workspace_id',
    ];

    /** @return BelongsTo<User,Membership> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /** @return BelongsTo<Workspace,Membership> */
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(
            related: Workspace::class,
            foreignKey: 'workspace_id',
        );
    }

    /** @return array<string,class-string> */
    protected function casts(): array
    {
        return [
            'role' => Role::class,
        ];
    }
}
