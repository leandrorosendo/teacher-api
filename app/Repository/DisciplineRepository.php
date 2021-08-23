<?php

namespace App\Repository;

use App\Models\Discipline;
use Illuminate\Database\Eloquent\Collection;

class DisciplineRepository
{

  /**
   * Saves a Discipline.
   *
   * @param $Discipline
   */
  public function save($request)
  {
    $discipline = new Discipline();
    $discipline->discipline = $request['discipline'];
    return $discipline->save();
  }

  /**
   * Update a Discipline.
   *
   * @param $id
   */
  public function update($request, $id)
  {
    $discipline = Discipline::find($id);
    $discipline->discipline = $request['discipline'];
    return $discipline->save();
  }

  /**
   * Destroy a Discipline.
   *
   * @param $id
   */
  public function destroy($id)
  {
    $discipline = Discipline::find($id);
    return $discipline->delete();
  }

  /**
   * get a Discipline.
   *
   */
  public function getAll(): Collection
  {
    return Discipline::all();
  }
}
