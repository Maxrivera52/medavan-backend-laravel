<?php

namespace App\Repositories;

use App\Models\Source;
use App\Interfaces\SourceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SourceRepository extends BaseRepository implements  SourceRepositoryInterface
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
    public function __construct( Source $model)
    {
        $this->model = $model;
    }
}
