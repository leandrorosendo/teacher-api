<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $a = rand(1,360);
        $legalAge = date("Y-m-d", strtotime(date("Y-m-d") . "-19 years - ".$a ." days"));
        return [
            'name' => $this->faker->name,
            'cpf' => $this->faker->unique()->numerify('###########'),
            'email' => $this->faker->unique()->safeEmail,
            'birth' =>  date( $legalAge ),
        ];
    }
}
