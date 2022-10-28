<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\EnableScope;

/**
 * @property int $iddocumenttype
 * @property string $description
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 * @property Doctor[] $doctors
 * @property Patient[] $patients
 * @property Supplier[] $suppliers
 */
class Documenttype extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'documenttype';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'iddocumenttype';

    /**
     * @var array
     */
    protected $fillable = ['description', 'enable', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor', 'iddocument_type', 'iddocumenttype');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patients()
    {
        return $this->hasMany('App\Models\Patient', 'iddocument_type', 'iddocumenttype');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function suppliers()
    {
        return $this->hasMany('App\Models\Supplier', 'iddocument_type', 'iddocumenttype');
    }

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
