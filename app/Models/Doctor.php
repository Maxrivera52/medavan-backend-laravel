<?php

namespace App\Models;

use App\Scopes\EnableScope;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $iddoctor
 * @property string $cmp
 * @property int $iddocument_type
 * @property string $document_number
 * @property string $birthday_day
 * @property string $birthday_mounth
 * @property string $first_lastname
 * @property string $second_lastname
 * @property string $name
 * @property string $email
 * @property string $cellphone
 * @property string $phone_contact
 * @property int $idspecialty
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 * @property DoctorPreference[] $doctorPreferences
 * @property MedicalEvent[] $medicalEvents
 */
class Doctor extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'iddoctor';

    /**
     * @var array
     */
    protected $fillable = ['cmp', 'iddocument_type', 'document_number', 'birthday_day', 'birthday_mounth', 'first_lastname', 'second_lastname', 'name', 'email', 'cellphone', 'phone_contact', 'idspecialty', 'enable', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctorPreferences()
    {
        return $this->hasMany('App\Models\DoctorPreference', 'iddoctor', 'iddoctor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicalEvents()
    {
        return $this->hasMany('App\Models\MedicalEvent', 'iddoctor', 'iddoctor');
    }
    public function specialty()
    {
        return $this->belongsTo('App\Models\Specialty', 'idspecialty', 'idspecialty');
    }

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

