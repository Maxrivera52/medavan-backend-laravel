<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use Illuminate\Http\Request;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\DiagnosticCollection;
use App\Interfaces\DiagnosticRepositoryInterface;
use App\Http\Utils\Message;

class DiagnosticController extends Controller
{
    private $repository;

    public function __construct(
        DiagnosticRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }


    public function create(Request $request)
    {
        $config = (object)array("tipo" => 0);
        $validacion = $this->repository->findByName($request->description);
        if (count($validacion) > 0) {
            return array(
                'message' => Message::REGISTRO_EXISTENTE
            );
        } else {
            return  ResponseResource::Response($this->repository->create($request->all('')), $config);
        }
    }

    public function update($id, Request $request)
    {
        $config = (object)array("id" => $id, "tipo" => 1);
        return  ResponseResource::Response($this->repository->update($id, $request->all()), $config);
    }

    public function listAll(Request $request)
    {
        return new  DiagnosticCollection($this->repository->all(['*'], ['specialty']));
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
    public function findbyIdSpecialty($id)
    {
        $diagnosticos = $this->repository->findbyIdSpecialty($id);

        if ($id != 0) {
            $data = array(
                "data" => $diagnosticos,
                "count" => $diagnosticos->count()
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
