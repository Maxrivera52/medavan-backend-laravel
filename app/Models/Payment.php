<?php

namespace App\Models;

use App\Scopes\EnableScope;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idpayment
 * @property string $description
 * @property string $enable
 * @property string $created_at
 * @property string $updated_at
 */
class Payment extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idpayment';

    /**
     * @var array
     */
    protected $fillable = ['description', 'enable', 'created_at', 'updated_at'];

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
