<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\EnableScope;

/**
 * @property int $idpatient
 * @property int $iddocument_type
 * @property string $document_number
 * @property string $first_name
 * @property string $last_name
 * @property string $age
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 * @property Documenttype $documenttype
 */
class Patient extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idpatient';

    /**
     * @var array
     */
    protected $fillable = ['iddocument_type', 'document_number', 'first_name', 'last_name', 'age', 'enable', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documenttype()
    {
        return $this->belongsTo('App\Models\Documenttype', 'iddocument_type', 'iddocumenttype');
    }

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
