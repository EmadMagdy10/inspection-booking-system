<?php

namespace Modules\Team\Models;

use App\Traits\BelongsToTenant;
use Modules\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Modules\Availability\Models\Availability;
use Modules\Team\Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Team\Database\Factories\TeamFactory;

class Team extends Model
{
    use HasFactory;
    use BelongsToTenant;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'tenant_id'
    ];

    protected static function newFactory(): TeamFactory
    {
        return TeamFactory::new();
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function availabilities(): HasMany
    {
        return $this->hasMany(Availability::class);
    }
}
