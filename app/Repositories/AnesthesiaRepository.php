<?php

namespace App\Repositories;

use App\Models\Anesthesia;
use App\Interfaces\AnesthesiaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AnesthesiaRepository extends BaseRepository implements AnesthesiaRepositoryInterface
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
    public function __construct(Anesthesia $model)
    {
        $this->model = $model;
    }
}
