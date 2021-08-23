<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TeacherSeeder::class,
            DisciplineSeeder::class,
            TeacherDisciplinesSeeder::class,
        ]);
    }
}
