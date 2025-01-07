<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\WorkspaceObserver;
use Carbon\CarbonInterface;
use Database\Factories\WorkspaceFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $user_id
 * @property CarbonInterface|null $created_at
 * @property CarbonInterface|null $updated_at
 * @property User $owner
 * @property Collection<Membership> $members
 */
#[ObservedBy(WorkspaceObserver::class)]
final class Workspace extends Model
{
    /** @use HasFactory<WorkspaceFactory> */
    use HasFactory;
    use HasUlids;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'user_id',
    ];

    /** @return BelongsTo<User,Workspace> */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /** @return HasMany<Membership,Workspace> */
    public function members(): HasMany
    {
        return $this->hasMany(
            related: Membership::class,
            foreignKey: 'workspace_id',
        );
    }
}
