<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierMaterialDetail extends Model
{
    //use HasFactory;
    protected $table = 'supplier_material_details';

     
    /**
     * @var array
     */
    protected $fillable = ['idsupplier','idmaterial','created_at', 'updated_at'];

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'idsupplier', 'idsupplier');
    }
    public function material()
    {
        return $this->belongsTo('App\Models\Material', 'idmaterial', 'idmaterial');
    }

}
