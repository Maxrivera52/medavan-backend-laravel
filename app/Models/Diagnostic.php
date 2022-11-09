<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\EnableScope;

/**
 * @property int $iddiagnostic
 * @property int $idspecialty
 * @property string $description
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 * @property Specialty $specialty
 */
class Diagnostic extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'diagnostics';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'iddiagnostic';

    /**
     * @var array
     */
    protected $fillable = ['description', 'enable', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /*
    public function specialty()
    {
        return $this->belongsTo('App\Models\Specialty', 'idspecialty', 'idspecialty');
    }
*/
    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
