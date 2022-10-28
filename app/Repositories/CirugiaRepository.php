<?php

namespace App\Repositories;

use App\Models\Cirugia;
use App\Interfaces\CirugiaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CirugiaRepository extends BaseRepository implements CirugiaRepositoryInterface
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
    public function __construct(Cirugia $model)
    {
        $this->model = $model;
    }

    public function findbyIdSpecialty($id)
    {
        return $this->model->where('idspecialty', $id)->get();
    }
}
