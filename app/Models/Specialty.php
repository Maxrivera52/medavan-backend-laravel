<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\EnableScope;

/**
 * @property int $idspecialty
 * @property string $description
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 * @property Cirugium[] $cirugias
 * @property Doctor[] $doctors
 */
class Specialty extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'specialtys';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idspecialty';

    /**
     * @var array
     */
    protected $fillable = ['description', 'enable', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cirugias()
    {
        return $this->hasMany('App\Models\Cirugium', 'idspecialty', 'idspecialty');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor', 'idspecialty', 'idspecialty');
    }

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
