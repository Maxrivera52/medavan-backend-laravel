<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Interfaces\DoctorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DoctorRepository extends BaseRepository implements DoctorRepositoryInterface
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
    public function __construct(Doctor $model)
    {
        $this->model = $model;
    }
}
