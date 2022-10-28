<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\EnableScope;
/**
 * @property int $idoperator
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $cellphone
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 */
class Operator extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idoperator';

    /**
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'cellphone', 'enable', 'created_at', 'updated_at'];

    protected static function booted()
    {
        static::addGlobalScope(new EnableScope);
    }
}
