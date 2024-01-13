<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LecturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = User::query()
            ->where('role','=','lecturer')
            ->select('id')
            ->get();
        $user_id = $this->faker->unique()->randomElement($id);
        $email = User::query()
            ->where('id','=',$user_id->id)
            ->select('email')
            ->get();
        $emails=$this->faker->randomElement($email);
        return [
            "user_id"=>$user_id,
            "code"=>$this->faker->unique()->bothify('D###'),
            "email"=>$emails->email,
            "name"=>$this->faker->name(),
        ];
    }
}
