<?php

namespace App\Repositories;

use App\Models\Preference;
use App\Interfaces\PreferenceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PreferenceRepository extends BaseRepository implements  PreferenceRepositoryInterface
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
    public function __construct( Preference $model)
    {
        $this->model = $model;
    }
}
