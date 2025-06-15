<?php

namespace Modules\Availability\Models;

use Modules\Team\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Availability\Database\Factories\AvailabilityFactory;

class Availability extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'team_id',
        'day_of_week',
        'start_time',
        'end_time'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    // protected static function newFactory(): AvailabilityFactory
    // {
    //     // return AvailabilityFactory::new();
    // }
}
