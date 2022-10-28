<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\DoctorCollection;
use App\Interfaces\DoctorRepositoryInterface;

class DoctorController extends Controller
{
    private $repository;

    public function __construct(
        DoctorRepositoryInterface $repository
        ){
        $this->repository = $repository;
    }

    public function create(Request $request)
    {
        $config = (object)array("tipo" => 0);
        return  ResponseResource::Response($this->repository->create($request->all('')), $config);
    }

    public function update($id, Request $request)
    {
        $config = (object)array("id" => $id, "tipo" => 1);
        $result = ResponseResource::Response($this->repository->update($id, $request->all()), $config);
        //$result = ResponseResource::Response(DB::select(DB::raw("select * from patients")))
        //if($result==true)
        return $result;
    }



    public function listAll(Request $request)
    {
        return new  DoctorCollection($this->repository->all(['*'],['documenttype','specialty']));
    }

    public function delete($id)
    {
        $enable = ["enable" => 0];
        $config = (object)array("id" => $id, "tipo" => 2);
        return  ResponseResource::Response($this->repository->update($id, $enable), $config);
    }

    public function findById($id)
    {
        $data = array(
            "data"=>[$this->repository->findById($id)],
            "count"=>1
        );
        return $data;
    }
}
