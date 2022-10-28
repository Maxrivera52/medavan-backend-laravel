<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\EnableScope;

/**
 * @property int $idrol
 * @property string $description
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 * @property User[] $users
 */
class Rol extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rol';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idrol';

    /**
     * @var array
     */
    protected $fillable = ['description', 'enable', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'idrol', 'idrol');
    }

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
