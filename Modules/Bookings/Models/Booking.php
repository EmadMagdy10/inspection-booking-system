<?php

namespace Modules\Bookings\Models;

use App\Models\User;
use Modules\Team\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Bookings\Database\Factories\BookingFactory;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'team_id',
        'start_time',
        'end_time'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
    // protected static function newFactory(): BookingFactory
    // {
    //     // return BookingFactory::new();
    // }
}
