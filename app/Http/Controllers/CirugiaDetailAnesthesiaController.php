<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralCollection;
use App\Http\Resources\ResponseResource;
use App\Http\Utils\Message;
use App\Interfaces\CirugiaDetailAnesthesiaRepositoryInterface;
use App\Models\CirugiaDetailAnesthesia;
use Illuminate\Http\Request;

class CirugiaDetailAnesthesiaController extends Controller
{
    private $repository;
    public function __construct(
        CirugiaDetailAnesthesiaRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function listAll(){
        return new GeneralCollection($this->repository->all(['*'],['cirugia','anesthesia']));
    }
    public function listByCirugia($id){
        //$detail = DB::table("diagnostics_detail_specialtys")->where("id_diagnostic",$id)->get();
        $detail = CirugiaDetailAnesthesia::with(['cirugia','anesthesia'])->where("id_cirugia",$id)->get();
        return new GeneralCollection($detail);
    }

    public function create(Request $request){
        error_log("CREATE");
        $req = CirugiaDetailAnesthesia::where('id_cirugia',$request->id_cirugia)->where('id_anesthesia',$request->id_anesthesia)->get();
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
