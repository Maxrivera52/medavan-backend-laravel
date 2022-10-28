<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\EnableScope;
/**
 * @property int $idpreference
 * @property string $description
 * @property string $value
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 * @property DoctorPreference[] $doctorPreferences
 */
class Preference extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idpreference';

    /**
     * @var array
     */
    protected $fillable = ['description', 'value', 'enable', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctorPreferences()
    {
        return $this->hasMany('App\Models\DoctorPreference', 'idspecialty', 'idpreference');
    }

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
