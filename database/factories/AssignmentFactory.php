<?php

namespace Database\Factories;

use App\Models\Allocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $alloc_id=Allocation::all()->pluck('id')->toArray();
        return [
            'allocation_id'=>$this->faker->randomElement($alloc_id),
            'title'=>$this->faker->name(),
            'starts_at'=>$this->faker->dateTimeThisMonth(),
            'ends_at'=>$this->faker->dateTimeAD(),
        ];
    }
}
