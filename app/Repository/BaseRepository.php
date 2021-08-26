<?php

namespace App\Repository;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository 
{
    /**      
     * @var Model      
     */
    protected $model;

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param $request
     * @return bool
     */
    public function save($request): bool
    {
        $model =  $this->model->newInstance();
        foreach ($request as $key => $value) {
            $model->setAttribute($key, $value);
        }
        return $model->save();
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    public function update($request, $id): bool
    {
        $model = $this->model::find($id);
        foreach ($request as $key => $value) {
            if (array_key_exists($key, $model->getAttributes())) {
                $model->setAttribute($key, $value);
            }
        }
        return $model->save();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model::all();
    }

    /**
     * @return bool
     */
    public function destroy($id): bool
    {
        $model = $this->model::find($id);
        return $model->delete();
    }
}
