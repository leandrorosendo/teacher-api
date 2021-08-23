<?php

namespace App\Services;

use App\Models\Discipline;
use App\Models\TeacherDiscipline;
use App\Repository\DisciplineRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class DisciplineService
{
  private $repository;
  private $msg1 = "Discipline not found.";
  private $msg2 = "It is not possible to remove the Discipline without first deleting the course teacher link.";

  /**
   * DisciplineService constructor. 
   *
   * @param DisciplineRepository $repository
   */
  public function __construct(DisciplineRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Saves a Discipline.
   *
   * @param $Discipline
   */
  public function save($request)
  {
    return $this->repository->save($request);
  }

  /**
   * Update a Discipline.
   *
   * @param $id
   */
  public function update($request, $id)
  {

    # checks if the discipline that will be changed actually exists in the database 
    if (!$this->existsDiscipline($id)) {
      return  response()->json(["erro" => ['0' => $this->msg1 ]], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    return $this->repository->update($request, $id);
  }

  /**
   * Destroy a Discipline.
   *
   * @param $id
   */
  public function destroy($id)
  {

    # checks if the discipline that will be destroy actually exists in the database 
    if (!$this->existsDiscipline($id)) {
      return  response()->json(["erro" => ['0' => $this->msg1 ]], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    # check if there is a professor linked to the discipline
    if (!$this->teacherExistsDiscipline($id)) {
      return  response()->json(["erro" => ['0' => $this->msg2  ]], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    return $this->repository->destroy($id);
  }

  /**
   * get a Discipline.
   *
   */
  public function getAll(): Collection
  {
    return $this->repository->getAll();
  }


  /**
   * checks if the discipline exists
   *
   * @param $id
   */
  private function existsDiscipline($id)
  {
    $discipline = Discipline::find($id);
    return is_null($discipline) ? false : true;
  }

  /**
   * check if there is a teacher linked to be deleted 
   *
   * @param $id
   */
  private function teacherExistsDiscipline($id)
  {
    $teacherDiscipline = TeacherDiscipline::where('discipline_id', $id)->first();
    return !is_null($teacherDiscipline) ? false : true;
  }
}
