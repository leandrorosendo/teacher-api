<?php

namespace App\Repository;

use App\Models\Teacher;

class TeacherRepository extends BaseRepository
{
  protected $model;

  /**      
   * BaseRepository constructor.      
   *      
   * @param Model $model      
   */
  public function __construct(Teacher $model)
  {
    $this->model = $model;
  }
}
