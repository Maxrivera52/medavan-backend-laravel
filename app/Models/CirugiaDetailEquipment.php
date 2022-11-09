<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CirugiaDetailEquipment extends Model
{
   // use HasFactory;
   protected $table = 'cirugia_detail_equipment';

     
    /**
     * @var array
     */
    protected $fillable = ['id_cirugia','id_equipment','created_at', 'updated_at'];

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cirugia()
    {
        return $this->belongsTo('App\Models\Cirugia', 'id_cirugia', 'idcirugia');
    }
    public function equipment()
    {
        return $this->belongsTo('App\Models\Equipment', 'id_equipment', 'idequipment');
    }
}
