<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counting = User::query()
            ->where('role','=','student')
            ->select('id')
            ->count();
        Student::factory($counting)->create();
    }
}
