<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\Teacher;
use App\Models\TeacherDiscipline;
use Database\Factories\DisciplineFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherDisciplinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $t = Teacher::all();
        foreach($t  as  $teste ){
            DB::table('teacher_disciplines')->insert([
                'teacher_id' => $teste->id ,
                'discipline_id' => $teste->id,
            ]);
        }
    }
}
