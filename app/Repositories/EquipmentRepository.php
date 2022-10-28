<?php

namespace App\Repositories;

use App\Models\Equipment;
use App\Interfaces\EquipmentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EquipmentRepository extends BaseRepository implements  EquipmentRepositoryInterface
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
    public function __construct( Equipment $model)
    {
        $this->model = $model;
    }
}
