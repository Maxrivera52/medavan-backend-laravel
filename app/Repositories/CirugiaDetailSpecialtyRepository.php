<?php

namespace App\Repositories;

use App\Interfaces\CirugiaDetailSpecialtyRepositoryInterface;
use App\Models\CirugiaDetailSpecialty;

class CirugiaDetailSpecialtyRepository extends BaseRepository implements  CirugiaDetailSpecialtyRepositoryInterface
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
    public function __construct( CirugiaDetailSpecialty $model)
    {
        $this->model = $model;
    }

//    
}
