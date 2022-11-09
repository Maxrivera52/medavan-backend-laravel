<?php

namespace App\Repositories;

use App\Models\DiagnosticDetailSpecialtys;
use App\Interfaces\DiagnosticDetailSpecialtysRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DiagnosticDetailSpecialtysRepository extends BaseRepository implements  DiagnosticDetailSpecialtysRepositoryInterface
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
    public function __construct( DiagnosticDetailSpecialtys $model)
    {
        $this->model = $model;
    }
}
