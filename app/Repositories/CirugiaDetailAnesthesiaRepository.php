<?php

namespace App\Repositories;

use App\Interfaces\CirugiaDetailAnesthesiaRepositoryInterface;
use App\Models\CirugiaDetailAnesthesia;

class CirugiaDetailAnesthesiaRepository extends BaseRepository implements  CirugiaDetailAnesthesiaRepositoryInterface
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
    public function __construct( CirugiaDetailAnesthesia $model)
    {
        $this->model = $model;
    }
}
