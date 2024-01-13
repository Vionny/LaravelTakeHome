<?php

namespace Database\Seeders;

use App\Models\Allocation;
use Illuminate\Database\Seeder;

class AllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Allocation::factory('20')->create();
    }
}
