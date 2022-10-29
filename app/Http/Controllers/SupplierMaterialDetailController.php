<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupplierMaterialDetailCollection;
use App\Http\Utils\Message;
use App\Interfaces\MaterialRepositoryInterface;
use App\Interfaces\SupplierMaterialDetailRepositoryInterface;
use App\Interfaces\SupplierRepositoryInterface;
use App\Models\SupplierMaterialDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierMaterialDetailController extends Controller
{
    public function __construct(
        SupplierMaterialDetailRepositoryInterface $repository,
        SupplierRepositoryInterface $supplierRepository,
        MaterialRepositoryInterface $materialRepository
    )
    {
        $this->repository = $repository;
        $this->materialRepository = $materialRepository;
        $this->supplierRepository = $supplierRepository;
    }
    

    public function listAll(){
        //error_log("listall");
        return new SupplierMaterialDetailCollection($this->repository->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $model = null;
        //ever its a list
        foreach ($request as $key => $it) {
            //add to create
            $model = array("idsupplier"=>$it->idsupplier,"idmaterial"=>$it->idmaterial);
            $this->repository->create($model);
        }
        return json_encode(array("id"=>0,Message::EXITO_REGISTRO,"code"=>1));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierMaterialDetail  $supplierMaterialDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierMaterialDetail $supplierMaterialDetail)
    {
        //
    }



    //DELETE BY IDPROV
    public function deleteByIdProv($id){
        $deleted = DB::table("supplier_material_detail")->where("idsupplier",$id)->delete();
        return $deleted;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierMaterialDetail  $supplierMaterialDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierMaterialDetail $supplierMaterialDetail)
    {
        //
    }
}
