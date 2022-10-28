<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $iddoctor
 * @property int $idcirugia
 * @property int $idanesthesia
 * @property int $idpatient
 * @property int $iddiagnostic
 * @property int $idsource
 * @property int $idmaterial
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $duration
 * @property string $calendar
 * @property string $resourceId
 * @property string $hospital_days
 * @property string $observations
 * @property int $enable
 * @property string $created_at
 * @property string $updated_at
 * @property Anesthesia $anesthesia
 * @property Cirugium $cirugium
 * @property Diagnostic $diagnostic
 * @property Doctor $doctor
 * @property Material $material
 * @property Patient $patient
 * @property Source $source
 */
class MedicalEvent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medical_event';

    /**
     * @var array
     */
    protected $fillable = [
        'iddoctor', 'idequipment', 'idcirugia', 'idanesthesia', 'idpatient', 'iddiagnostic',
        'idsource', 'idmaterial', 'title', 'start', 'duration', 'end', 'calendar', 'resourceId',
        'hospital_days', 'observations', 'enable', 'created_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anesthesia()
    {
        return $this->belongsTo('App\Models\Anesthesia', 'idanesthesia', 'idanesthesia');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cirugium()
    {
        return $this->belongsTo('App\Models\Cirugia', 'idcirugia', 'idcirugia');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diagnostic()
    {
        return $this->belongsTo('App\Models\Diagnostic', 'iddiagnostic', 'iddiagnostic');
    }

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
    public function material()
    {
        return $this->belongsTo('App\Models\Material', 'idmaterial', 'idmaterial');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'idpatient', 'idpatient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source()
    {
        return $this->belongsTo('App\Models\Source', 'idsource', 'idsource');
    }
}
