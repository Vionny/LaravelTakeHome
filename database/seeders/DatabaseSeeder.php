<?php

namespace Database\Seeders;

use App\Models\Allocation;
use App\Models\Assignment;
use App\Models\Forum;
use App\Models\Student;
use App\Models\SubjectDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin'),
        ]);
        DB::table('users')->insert([
            'role'=>'student',
            'email'=>'student@gmail.com',
            'password'=>bcrypt('student'),
        ]);
        DB::table('users')->insert([
            'role'=>'lecturer',
            'email'=>'lecturer@gmail.com',
            'password'=>bcrypt('lecturer'),
        ]);

         $this->call([
             UserSeeder::class,
            SubjectSeeder::class,
             SubjectDetailSeeder::class,
             ClassroomSeeder::class,
             LecturerSeeder::class,
             AllocationSeeder::class,
             StudentSeeder::class,
             AssignmentSeeder::class,
             ForumSeeder::class,
             AllocationDetailSeeder::class
         ]);
    }
}
