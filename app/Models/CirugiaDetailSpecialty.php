<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CirugiaDetailSpecialty extends Model
{
    protected $table = 'cirugia_detail_specialty';

     
    /**
     * @var array
     */
    protected $fillable = ['id_cirugia','id_specialty','created_at', 'updated_at'];

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cirugia()
    {
        return $this->belongsTo('App\Models\Cirugia', 'id_cirugia', 'idcirugia');
    }
    public function specialty()
    {
        return $this->belongsTo('App\Models\Specialty', 'id_specialty', 'idspecialty');
    }
}
