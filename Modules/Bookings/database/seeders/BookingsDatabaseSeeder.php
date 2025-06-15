<?php

namespace Modules\Bookings\Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Modules\Team\Models\Team;
use Illuminate\Database\Seeder;
use Modules\Bookings\Models\Booking;

class BookingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team = Team::first();
        $user = User::first();

        $start = Carbon::parse(now()->addDays(2)->format('Y-m-d') . ' 10:00:00');
        $end = $start->copy()->addHour();

        Booking::create([
            'user_id' => $user->id,
            'team_id' => $team->id,
            'start_time' => $start,
            'end_time' => $end,
        ]);
    }
}
