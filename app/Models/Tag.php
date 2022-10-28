<?php

namespace App\Models;

use App\Scopes\EnableScope;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idtag
 * @property string $name
 * @property string $color
 * @property string $visible
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 */
class Tag extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idtag';

    /**
     * @var array
     */
    protected $fillable = ['name', 'color', 'visible', 'enable', 'created_at', 'updated_at'];
    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
