<?php

namespace Modules\Bookings\Services;

use Modules\Bookings\Models\Booking;
use Carbon\Carbon;

class BookingService
{
    public function hasConflict($teamId, $start, $end): bool
    {
        return Booking::where('team_id', $teamId)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_time', [$start, $end->subSecond()])
                    ->orWhereBetween('end_time', [$start->addSecond(), $end])
                    ->orWhere(function ($q) use ($start, $end) {
                        $q->where('start_time', '<=', $start)
                            ->where('end_time', '>=', $end);
                    });
            })->exists();
    }

    public function createBooking($userId, $teamId, $start, $end)
    {
        return Booking::create([
            'user_id' => $userId,
            'team_id' => $teamId,
            'start_time' => $start,
            'end_time' => $end,
        ]);
    }
}
