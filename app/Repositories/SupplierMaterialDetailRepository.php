<?php

namespace App\Repositories;

use App\Models\SupplierMaterialDetail;
use App\Interfaces\SupplierMaterialDetailRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SupplierMaterialDetailRepository extends BaseRepository implements  SupplierMaterialDetailRepositoryInterface
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
    public function __construct( SupplierMaterialDetail $model)
    {
        $this->model = $model;
    }
}
