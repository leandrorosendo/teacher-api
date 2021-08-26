<?php

namespace App\Repository;

use App\Models\Discipline;

class DisciplineRepository extends BaseRepository
{
  protected $model;

  /**      
   * BaseRepository constructor.      
   *      
   * @param Model $model      
   */
  public function __construct(Discipline $model)
  {
    $this->model = $model;
  }
}
