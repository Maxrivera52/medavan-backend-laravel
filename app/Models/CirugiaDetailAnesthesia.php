<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CirugiaDetailAnesthesia extends Model
{
    //use HasFactory;
    protected $table = 'cirugia_detail_anesthesia';

     
    /**
     * @var array
     */
    protected $fillable = ['id_cirugia','id_anesthesia','created_at', 'updated_at'];

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cirugia()
    {
        return $this->belongsTo('App\Models\Cirugia', 'id_cirugia', 'idcirugia');
    }
    public function anesthesia()
    {
        return $this->belongsTo('App\Models\Anesthesia', 'id_anesthesia', 'idanesthesia');
    }

    /*
    public function specialty()
    {
        return $this->belongsTo('App\Models\Specialty', 'id_specialty', 'idspecialty');
    }
    */
}
