<?php

namespace App\Repositories;

use App\Models\Sede;
use App\Interfaces\SedeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SedeRepository extends BaseRepository implements  SedeRepositoryInterface
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
    public function __construct( Sede $model)
    {
        $this->model = $model;
    }
}
