<?php

namespace App\Repositories;

use App\Models\Rol;
use App\Interfaces\RolRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RolRepository extends BaseRepository implements RolRepositoryInterface
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
    public function __construct(Rol $model)
    {
        $this->model = $model;
    }
}
