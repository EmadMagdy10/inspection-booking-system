<?php

namespace Modules\Availability\Database\Seeders;

use Modules\Team\Models\Team;
use Illuminate\Database\Seeder;
use Modules\Availability\Models\Availability;

class AvailabilityDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();

        foreach ($teams as $team) {
            foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day) {
                Availability::create([
                    'team_id' => $team->id,
                    'day_of_week' => $day,
                    'start_time' => '09:00:00',
                    'end_time' => '17:00:00',
                ]);
            }
        }
    }
}
