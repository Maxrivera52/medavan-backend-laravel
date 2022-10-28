<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\EnableScope;

/**
 * @property int $idspecialty
 * @property int $iddoctor
 * @property string $created_at
 * @property string $updated_at
 * @property int $enable
 * @property Doctor $doctor
 * @property Preference $preference
 */
class Doctorxpreference extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'doctor_preference';

    /**
     * @var array
     */
    protected $fillable = ['idspecialty', 'iddoctor', 'created_at', 'updated_at', 'enable'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'iddoctor', 'iddoctor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function preference()
    {
        return $this->belongsTo('App\Models\Preference', 'idspecialty', 'idspecialty');
    }

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
