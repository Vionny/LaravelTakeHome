<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){

        $id = User::query()
            ->where('role','=','student')
            ->select('id')
            ->get();
        $user_id = $this->faker->unique()->randomElement($id);
//        dd($user_id->id);
        $email = User::query()
            ->where('id','=',$user_id->id)
            ->select('email')
            ->get();
        $emails=$this->faker->randomElement($email);
//        dd($emails);
        return [
            "user_id"=>$user_id,
            'email'=> $emails->email,
            "name"=>$this->faker->name(),
            "code"=>$this->faker->numberBetween('2000000000','3000000000')
        ];
    }
}
