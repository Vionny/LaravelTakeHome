<?php

namespace Database\Factories;

use App\Models\Allocation;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class AllocationDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $alloc_id=Allocation::all()->pluck('id')->toArray();
        $stu_id=Student::all()->pluck('id')->toArray();
        return [
            "allocation_id"=>$this->faker->unique(true)->randomElement($alloc_id),
            "student_id"=>$this->faker->unique(true)->randomElement($stu_id)
        ];
    }
}
