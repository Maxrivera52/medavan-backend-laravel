<?php

namespace App\Repositories;

use App\Models\Operator;
use App\Interfaces\OperatorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OperatorRepository extends BaseRepository implements  OperatorRepositoryInterface
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
    public function __construct( Operator $model)
    {
        $this->model = $model;
    }
}
