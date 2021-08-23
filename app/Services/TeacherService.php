<?php

namespace App\Services;

use App\Models\Teacher;
use App\Models\TeacherDiscipline;
use App\Repository\TeacherRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class TeacherService
{
  private $repository;
  private $msg1 = "Teacher not found.";
  private $msg2 = "It is not possible to remove the teacher without first deleting the link with the course.";

  /**
   * TeacherRepository constructor. 
   *
   * @param TeacherRepository $repository
   */
  public function __construct(TeacherRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Saves a Teacher.
   *
   * @param $Teacher
   */
  public function save($request)
  {
    return $this->repository->save($request);
  }

  /**
   * Update a Teacher.
   *
   * @param $id
   */
  public function update($request, $id)
  {
    $teacher = Teacher::find($id);

    if (is_null($teacher)) {
      return  response()->json(["erro"  => ['0' => $this->msg1]], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    return  $this->repository->update($request, $id);
  }

  /**
   * Destroy a Teacher.
   *
   * @param $id
   */
  public function destroy($id)
  {

    # checks if the teacher that will be destroy actually exists in the database 
    if (!$this->existsTeacher($id)) {
      return  response()->json(["erro" => ['0' => $this->msg1]], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    # check if there is a teacher linked to the discipline
    if (!$this->teacherExistsDiscipline($id)) {
      return  response()->json(["erro" => ['0' => $this->msg2]], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    return $this->repository->destroy($id);
  }

  /**
   * get a Teacher.
   *
   */
  public function getAll(): Collection
  {
    return $this->repository->getAll();
  }

  /**
   * checks if the teacher exists
   *
   * @param $id
   */
  private function existsTeacher($id)
  {
    $teacher = Teacher::find($id);
    return is_null($teacher) ? false : true;
  }

  /**
   * check if there is a teacher linked to be deleted 
   *
   * @param $id
   */
  private function teacherExistsDiscipline($id)
  {
    $teacherDiscipline = TeacherDiscipline::where('teacher_id', $id)->first();
    return !is_null($teacherDiscipline) ? false : true;
  }
}
