<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralCollection;
use App\Http\Resources\ResponseResource;
use App\Http\Utils\Message;
use App\Interfaces\CirugiaDetailEquipmentRepositoryInterface;
use App\Models\CirugiaDetailEquipment;
use Illuminate\Http\Request;

class CirugiaDetailEquipmentController extends Controller
{
    private $repository;
    public function __construct(
        CirugiaDetailEquipmentRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function listAll(){
        return new GeneralCollection($this->repository->all(['*'],['cirugia','equipment']));
    }
    public function listByCirugia($id){
        //$detail = DB::table("diagnostics_detail_specialtys")->where("id_diagnostic",$id)->get();
        $detail = CirugiaDetailEquipment::with(['cirugia','equipment'])->where("id_cirugia",$id)->get();
        return new GeneralCollection($detail);
    }

    public function create(Request $request){
        error_log("CREATE");
        $req = CirugiaDetailEquipment::where('id_cirugia',$request->id_cirugia)->where('id_equipment',$request->id_equipment)->get();
        if(count($req)==0){
            $model = $this->repository->create($request->all());
        }
        return json_encode(array("id"=>0,Message::EXITO_REGISTRO,"code"=>1));
    }
    public function update($id,Request $request){
        //$model = $this->repository->update($request->id,$request->all());
        $model = $this->repository->update($id,$request->all());
        return ResponseResource::JsonMessageResponse(1,Message::EXITO_ACTUALIZAR,1);
    }
    public function delete($id){
        $result = $this->repository->deleteById($id);
        return ResponseResource::JsonMessageResponse(1,Message::EXITO_ELIMINAR,1);
    }
}
