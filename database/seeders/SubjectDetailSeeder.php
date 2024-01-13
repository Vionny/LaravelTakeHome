<?php

namespace Database\Seeders;

use App\Models\SubjectDetail;
use Database\Factories\SubjectDetailFactory;
use Illuminate\Database\Seeder;

class SubjectDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubjectDetail::factory('10')->create();
    }
}
