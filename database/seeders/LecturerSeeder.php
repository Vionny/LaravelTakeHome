<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counting = User::query()
            ->where('role','=','lecturer')
            ->select('id')
            ->count();
        Lecturer::factory($counting)->create();
    }
}
