<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticDetailSpecialtys extends Model
{
    protected $table = 'diagnostics_detail_specialtys';

     
    /**
     * @var array
     */
    protected $fillable = ['id_diagnostic','id_specialty','created_at', 'updated_at'];

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diagnostic()
    {
        return $this->belongsTo('App\Models\Diagnostic', 'id_diagnostic', 'iddiagnostic');
    }
    public function specialty()
    {
        return $this->belongsTo('App\Models\Specialty', 'id_specialty', 'idspecialty');
    }
}
