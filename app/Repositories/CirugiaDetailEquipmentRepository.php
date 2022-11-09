<?php

namespace App\Repositories;

use App\Interfaces\CirugiaDetailEquipmentRepositoryInterface;
use App\Models\CirugiaDetailEquipment;

class CirugiaDetailEquipmentRepository extends BaseRepository implements  CirugiaDetailEquipmentRepositoryInterface
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
    public function __construct( CirugiaDetailEquipment $model)
    {
        $this->model = $model;
    }
}
