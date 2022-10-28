<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\EnableScope;

/**
 * @property int $idsource
 * @property string $description
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 */
class Source extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idsource';

    /**
     * @var array
     */
    protected $fillable = ['description', 'enable', 'created_at', 'updated_at'];

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
