<?php

namespace App\Repository;

use App\Models\TeacherDiscipline;
use Illuminate\Database\Eloquent\Collection;

class TeacherDisciplineRepository extends BaseRepository
{
  protected $model;

  /**      
   * BaseRepository constructor.      
   *      
   * @param Model $model      
   */
  public function __construct(TeacherDiscipline $model)
  {
    $this->model = $model;
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
