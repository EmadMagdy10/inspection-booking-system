<?php

namespace Modules\Availability\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Modules\Team\Models\Team;
use Modules\Bookings\Models\Booking;

class TimeSlotService
{
    public function generateSlots($teamId, $from, $to)
    {
        $team = Team::with('availabilities')->findOrFail($teamId);

        $fromDate = Carbon::parse($from)->startOfDay();
        $toDate = Carbon::parse($to)->endOfDay();

        $slots = [];

        // كل يوم بين التاريخين
        foreach (CarbonPeriod::create($fromDate, $toDate) as $date) {
            $day = strtolower($date->format('l'));

            $availabilities = $team->availabilities->where('day_of_week', $day);

            foreach ($availabilities as $availability) {
                $start = Carbon::parse($date->format('Y-m-d') . ' ' . $availability->start_time);
                $end = Carbon::parse($date->format('Y-m-d') . ' ' . $availability->end_time);

                // قسم الوقت إلى فترات ساعة
                while ($start->copy()->addHour() <= $end) {
                    $slotStart = $start->copy();
                    $slotEnd = $start->copy()->addHour();

                    // هل فيه booking يغطي هذا الوقت؟
                    $isBooked = Booking::where('team_id', $teamId)
                        ->where(function ($query) use ($slotStart, $slotEnd) {
                            $query->whereBetween('start_time', [$slotStart, $slotEnd->subMinute()])
                                ->orWhereBetween('end_time', [$slotStart->addMinute(), $slotEnd])
                                ->orWhere(function ($q) use ($slotStart, $slotEnd) {
                                    $q->where('start_time', '<=', $slotStart)
                                        ->where('end_time', '>=', $slotEnd);
                                });
                        })->exists();

                    if (!$isBooked) {
                        $slots[] = [
                            'start_time' => $slotStart->toDateTimeString(),
                            'end_time' => $slotEnd->toDateTimeString(),
                        ];
                    }

                    $start->addHour();
                }
            }
        }

        return $slots;
    }
}
