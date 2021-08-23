<?php

namespace App\Repository;

use App\Models\TeacherDiscipline;
use Illuminate\Database\Eloquent\Collection;

class TeacherDisciplineRepository
{
  /**
   * Saves a TeacherDiscipline
   *
   * @param $TeacherDiscipline
   */
  public function save($request)
  {
    $teacherDiscipline = new TeacherDiscipline();
    $teacherDiscipline->teacher_id = $request['teacher_id'];
    $teacherDiscipline->discipline_id = $request['discipline_id'];
    return $teacherDiscipline->save();
  }

  /**
   * Update a TeacherDiscipline.
   *
   * @param $id
   */
  public function update($request, $id)
  {
    $teacherDiscipline= TeacherDiscipline::find($id);
    $teacherDiscipline->teacher_id = $request['teacher_id'];
    $teacherDiscipline->discipline_id = $request['discipline_id'];
    return $teacherDiscipline->save();
  }

  /**
   * Destroy a TeacherDiscipline.
   *
   * @param $id
   */
  public function destroy($id)
  {
    $teacherDiscipline= TeacherDiscipline::find($id);
    return $teacherDiscipline->delete();
  }

  /**
   * get a TeacherDiscipline.
   *
   */
  public function getAll(): Collection
  {
    return TeacherDiscipline::with('teachers')->with('disciplines')->orderBy('id')->get();
  }
}
