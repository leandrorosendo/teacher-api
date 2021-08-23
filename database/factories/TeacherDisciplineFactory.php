<?php

namespace Database\Factories;

use App\Models\Discipline;
use App\Models\Teacher;
use App\Models\TeacherDiscipline;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherDisciplineFactory2 extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeacherDiscipline::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'discipline_id' => Discipline::factory(),
            'teacher_id' => Teacher::factory(),
        ];
    }
}
