<?php

namespace App\Repositories;

use App\Models\Specialty;
use App\Interfaces\SpecialtyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SpecialtyRepository extends BaseRepository implements  SpecialtyRepositoryInterface
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
    public function __construct( Specialty $model)
    {
        $this->model = $model;
    }
}
