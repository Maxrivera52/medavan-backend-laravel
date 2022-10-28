<?php

namespace App\Repositories;

use App\Models\Parrilla;
use App\Interfaces\ParrillaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ParrillaRepository extends BaseRepository implements  ParrillaRepositoryInterface
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
    public function __construct( Parrilla $model)
    {
        $this->model = $model;
    }

   /*  public function validarExistencia (){
        return $this->model
    } */
}
