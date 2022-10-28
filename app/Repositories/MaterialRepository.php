<?php

namespace App\Repositories;

use App\Models\Material;
use App\Interfaces\MaterialRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MaterialRepository extends BaseRepository implements  MaterialRepositoryInterface
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
    public function __construct( Material $model)
    {
        $this->model = $model;
    }
}
