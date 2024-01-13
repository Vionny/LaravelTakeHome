<?php

namespace Database\Factories;

use App\Models\Allocation;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $alloc_id=Allocation::all()->pluck('id')->toArray();
        $students=Student::all()->pluck('name')->toArray();
        return [
            'allocation_id'=>$this->faker->randomElement($alloc_id),
            'description'=>$this->faker->text('200'),
            'creator'=>$this->faker->randomElement($students),
            'reply_to'=>$this->faker->randomElement($students),
        ];
    }
}
