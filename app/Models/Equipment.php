<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\EnableScope;
/**
 * @property int $idequipment
 * @property string $name
 * @property string $description
 * @property int $enable
 * @property string $updated_at
 * @property string $created_at
 */
class Equipment extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idequipment';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'quantity', 'enable', 'updated_at', 'created_at'];

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
