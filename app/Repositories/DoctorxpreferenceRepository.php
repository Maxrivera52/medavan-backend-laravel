<?php

namespace App\Repositories;

use App\Models\Doctorxpreference;
use App\Interfaces\DoctorxpreferenceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DoctorxpreferenceRepository extends BaseRepository implements  DoctorxpreferenceRepositoryInterface
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
    public function __construct( Doctorxpreference $model)
    {
        $this->model = $model;
    }
}
