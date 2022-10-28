<?php

namespace App\Models;

use App\Scopes\EnableScope;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idsede
 * @property string $description
 * @property int $sala
 * @property string $color
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 */
class Sede extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sede';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idsede';

    /**
     * @var array
     */
    protected $fillable = ['description', 'sala', 'cuartos', 'cubiculos', 'color', 'enable', 'created_at', 'updated_at'];

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
