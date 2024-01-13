<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Lecturer;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class AllocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sub_id = Subject::all()->pluck('id')->toArray();
        $class_id = Classroom::all()->pluck('id')->toArray();
        $lec_id = Lecturer::all()->pluck('id')->toArray();
        return [
            "subject_id"=>$this->faker->unique(true)->randomElement($sub_id),
            "classroom_id"=>$this->faker->unique(true)->randomElement($class_id),
            "lecturer_id"=>$this->faker->unique(true)->randomElement($lec_id),
            "semester"=>$this->faker->numberBetween('1','8')
        ];
    }
}
