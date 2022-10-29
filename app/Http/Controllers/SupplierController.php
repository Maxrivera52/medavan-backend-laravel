<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

use App\Http\Resources\ResponseResource;
use App\Http\Resources\SupplierCollection;
use App\Interfaces\SupplierMaterialDetailRepositoryInterface;
use App\Interfaces\SupplierRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    private $repository;

    public function __construct(
        SupplierRepositoryInterface $repository,
        SupplierMaterialDetailRepositoryInterface $supplierMaterialDetailRepository
        ){
        $this->repository = $repository;
        $this->supplierMaterialDetailRepository = $supplierMaterialDetailRepository;
    }

    public function create(Request $request)
    {
        $config = (object)array("tipo" => 0);
        error_log(json_encode($request->listMaterials));
        $reqCop = json_encode($request->listMaterials);
        //delete property
        unset($request->listMaterials);

        $model = $this->repository->create($request->all(''));
        //get id
        $id = $model->idsupplier;
        //convert to obj
        $reqCop = json_decode($reqCop);
        //save into supplier met detail
        $listsuppmatdet = [];
        foreach($reqCop as $key=>$it){
            $listsuppmatdet[] = array("idsupplier"=>$id,"idmaterial"=>$it->idMaterial) ;
        }
        error_log(">>>>>>".json_encode($listsuppmatdet));

        //save
        $this->createMatDet($listsuppmatdet);

        return  ResponseResource::Response($model, $config);
    }

    public function createMatDet($listsuppmatdet)
    {
        //$model = null;
        //ever its a list
        foreach ($listsuppmatdet as $key => $it) {
            error_log("-------------------------".json_encode($it));
            //add to create
            //$model = array("idsupplier"=>$it->idsupplier,"idmaterial"=>$it->idmaterial);
            $model  = $this->supplierMaterialDetailRepository->create($it);

            error_log("a=#=".json_encode($model));
        }
        //return json_encode(array("id"=>0,Message::EXITO_REGISTRO,"code"=>1));
    }

    public function update($id, Request $request)
    {
        $config = (object)array("id" => $id, "tipo" => 1);
        //SupplierMaterialDetailController->deleteByIdProv($id);
        //$this->supplierMaterialDetailRepository->deleteByIdProv($id);
        error_log(json_encode($request));
        DB::table("supplier_material_details")->where("idsupplier",$id)->delete();
        return  ResponseResource::Response($this->repository->update($id, $request->all()), $config);
    }

    public function listAll(Request $request)
    {
        return new  SupplierCollection($this->repository->all(['*'],['documenttype']));
    }

    public function delete($id)
    {
        $enable = ["enable" => 0];
        $config = (object)array("id" => $id, "tipo" => 2);
        return  ResponseResource::Response($this->repository->update($id, $enable), $config);
    }

    public function findById($id)
    {
        $config = (object)array("id" => $id, "tipo" => 4);
        return  ResponseResource::Response($this->repository->findById($id), $config);
    }

    
}
