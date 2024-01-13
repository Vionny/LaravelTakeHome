<?php

namespace Database\Seeders;

use App\Models\Allocation;
use App\Models\AllocationDetail;
use Illuminate\Database\Seeder;

class AllocationDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counting = Allocation::query()
            ->count();
        AllocationDetail::factory($counting)->create();
    }
}
