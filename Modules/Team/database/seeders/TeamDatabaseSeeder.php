<?php

namespace Modules\Team\Database\Seeders;

use Modules\Team\Models\Team;
use Illuminate\Database\Seeder;
use Modules\Tenant\Models\Tenant;

class TeamDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::first();

        Team::factory()->count(2)->create([
            'tenant_id' => $tenant->id,
        ]);
    }
}
