<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $fecha
 * @property int $sala
 * @property string $programacion
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 */
class Parrilla extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'parrilla';

    // protected $primaryKey = ['fecha', 'sala'];
    protected $primaryKey = 'fecha';
    public $incrementing = false;
    public $keyType = 'string';

    /**
     * @var array
     */
    protected $fillable = ['fecha','sala','programacion', 'enable', 'created_at', 'updated_at'];
}
