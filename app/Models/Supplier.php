<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\EnableScope;

/**
 * @property int $idsupplier
 * @property int $iddocument_type
 * @property string $document_number
 * @property string $businessname
 * @property string $phone
 * @property string $email
 * @property string $representative_name
 * @property string $representative_phone
 * @property string $representative_email
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 * @property Documenttype $documenttype
 */
class Supplier extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idsupplier';

    /**
     * @var array
     */
    protected $fillable = ['iddocument_type', 'document_number', 'businessname', 'phone', 'email', 'representative_name', 'representative_phone', 'representative_email', 'enable', 'created_at', 'updated_at'];

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
