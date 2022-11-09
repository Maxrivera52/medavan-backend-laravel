<?php

namespace App\Http\Controllers;

use App\Models\Cirugia;
use Illuminate\Http\Request;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\CirugiaCollection;
use App\Interfaces\CirugiaRepositoryInterface;

class CirugiaController extends Controller
{
    private $repository;

    public function __construct(
        CirugiaRepositoryInterface $repository
    ) {
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
        return  ResponseResource::Response($this->repository->update($id, $request->all()), $config);
    }

    public function listAll(Request $request)
    {
    return new  CirugiaCollection($this->repository->all(['*']/*, ['specialty']*/));
    }

    public function delete($id)
    {
        $enable = ["enable" => 0];
        $config = (object)array("id" => $id, "tipo" => 2);
        return  ResponseResource::Response($this->repository->update($id, $enable), $config);
    }

    public function findById($id)
    {
        if ($id != 0) {
            $data = array(
                "data" => [$this->repository->findById($id)],
                "count" => 1
            );
        } else {
            $data = array(
                "data" => [],
                "count" => 0
            );
        }
        return  $data;
    }
    public function findbyIdSpecialty($id)
    {
        $cirurgias = $this->repository->findbyId/*Specialty*/($id);

        if ($id != 0) {
            $data = array(
                "data" => $cirurgias,
                "count" => $cirurgias->count()
            );
        } else {
            $data = array(
                "data" => [],
                "count" => 0
            );
        }
        return $data;
    }
}
