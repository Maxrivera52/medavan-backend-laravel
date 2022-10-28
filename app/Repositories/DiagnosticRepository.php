<?php

namespace App\Repositories;

use App\Models\Diagnostic;
use App\Interfaces\DiagnosticRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DiagnosticRepository extends BaseRepository implements DiagnosticRepositoryInterface
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
    public function __construct(Diagnostic $model)
    {
        $this->model = $model;
    }

    public function findByName($description)
    {
        return $this->model
            ->where('description', $description)
            ->get();
    }

    public function findbyIdSpecialty($id)
    {
        return $this->model->where('idspecialty', $id)->get();
    }
}
