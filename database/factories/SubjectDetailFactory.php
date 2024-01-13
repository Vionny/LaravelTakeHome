<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subjects = Subject::all()->pluck('id');
        return [
            "subject_id"=>$this->faker->randomElement($subjects),
            "date"=>$this->faker->dateTimeThisCentury(),
            "note"=>$this->faker->text('100'),
            "shift"=>$this->faker->numberBetween('1','3')
        ];
    }
}
