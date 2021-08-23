<?php

namespace App\Services;

use App\Models\TeacherDiscipline;
use App\Repository\TeacherDisciplineRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class TeacherDisciplineService
{
  private $repository;
  private $msg1 = "Link not found.";

  /**
   * TeacherDisciplineRepository constructor. 
   *
   * @param TeacherDisciplineRepository $repository
   */
  public function __construct(TeacherDisciplineRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Saves a TeacherDiscipline
   *
   * @param $TeacherDiscipline
   */
  public function save($request)
  {
    return $this->repository->save($request);
  }

  /**
   * Update a TeacherDiscipline.
   *
   * @param $id
   */
  public function update($request, $id)
  {

    # checks if the teacher discipline that will be update actually exists in the database 
    if (!$this->existsTeacherDiscipline($id)) {
      return  response()->json(["erro" => ['0' => $this->msg1]], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    return $this->repository->update($request, $id);
  }

  /**
   * Destroy a TeacherDiscipline.
   *
   * @param $id
   */
  public function destroy($id)
  {

    # checks if the teacher discipline that will be destroy actually exists in the database
    if (!$this->existsTeacherDiscipline($id)) {
      return  response()->json(["erro" => ['0' => $this->msg1]], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    return $this->repository->destroy($id);
  }

  /**
   * get a TeacherDiscipline.
   *
   */
  public function getAll(): Collection
  {
    return $this->repository->getAll();
  }

  /**
   * checks if the discipline teacher exists
   *
   * @param $id
   */
  private function existsTeacherDiscipline($id)
  {
    $teacherDiscipline = TeacherDiscipline::find($id);
    return is_null($teacherDiscipline) ? false : true;
  }
}
