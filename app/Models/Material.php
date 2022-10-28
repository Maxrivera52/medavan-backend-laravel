<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\EnableScope;

/**
 * @property int $idmaterial
 * @property string $name_material
 * @property string $description
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 */
class Material extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idmaterial';

    /**
     * @var array
     */
    protected $fillable = ['name_material', 'description', 'enable', 'created_at', 'updated_at'];

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
