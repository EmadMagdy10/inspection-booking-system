<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Team\Database\Seeders\TeamDatabaseSeeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;
use Modules\Tenant\Database\Seeders\TenantDatabaseSeeder;
use Modules\Bookings\Database\Seeders\BookingsDatabaseSeeder;
use Modules\Availability\Database\Seeders\AvailabilityDatabaseSeeder;
use Modules\User\Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(TenantDatabaseSeeder::class);
        $this->call(UserDatabaseSeeder::class);
        $this->call(TeamDatabaseSeeder::class);
        $this->call(AvailabilityDatabaseSeeder::class);
        $this->call(BookingsDatabaseSeeder::class);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
