<?php

namespace App\Repositories;

use App\Models\MedicalEvent;
use App\Interfaces\MedicalEventRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MedicalEventRepository extends BaseRepository implements  MedicalEventRepositoryInterface
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
    public function __construct( MedicalEvent $model)
    {
        $this->model = $model;
    }
}
