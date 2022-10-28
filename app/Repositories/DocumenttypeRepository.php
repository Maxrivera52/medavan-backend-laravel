<?php

namespace App\Repositories;

use App\Models\Documenttype;
use App\Interfaces\DocumenttypeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DocumenttypeRepository extends BaseRepository implements  DocumenttypeRepositoryInterface
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
    public function __construct( Documenttype $model)
    {
        $this->model = $model;
    }
}
