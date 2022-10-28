<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Interfaces\PatientsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PatientsRepository extends BaseRepository implements PatientsRepositoryInterface
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
    public function __construct(Patient $model)
    {
        $this->model = $model;
    }
}
