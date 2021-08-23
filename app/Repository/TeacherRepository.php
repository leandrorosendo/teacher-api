<?php

namespace App\Repository;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Collection;

class TeacherRepository
{

  /**
   * Saves a Teacher.
   *
   * @param $Teacher
   */
  public function save($request)
  {
    $teacher = new Teacher();
    $teacher->name = $request['name'];
    $teacher->cpf = $request['cpf'];
    $teacher->email = $request['email'];
    $teacher->birth = $request['birth'];
    return $teacher->save();
  }

  /**
   * Update a Teacher.
   *
   * @param $id
   */
  public function update($request, $id)
  {
    $teacher = Teacher::find($id);
    $teacher->name = $request['name'];
    $teacher->cpf = $request['cpf'];
    $teacher->email = $request['email'];
    $teacher->birth = $request['birth'];
    return $teacher->save();
  }

  /**
   * Destroy a Teacher.
   *
   * @param $id
   */
  public function destroy($id)
  {
    $teacher = Teacher::find($id);
    return $teacher->delete();
  }

  /**
   * get a Teacher.
   *
   */
  public function getAll(): Collection
  {
    return Teacher::all();
  }
}
