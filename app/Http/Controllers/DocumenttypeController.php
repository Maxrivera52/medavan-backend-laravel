<?php

namespace App\Http\Controllers;

use App\Models\Documenttype;
use Illuminate\Http\Request;


use App\Http\Resources\ResponseResource;
use App\Http\Resources\DocumenttypeCollection;
use App\Interfaces\DocumenttypeRepositoryInterface;

class DocumenttypeController extends Controller
{
    private $repository;

    public function __construct(
        DocumenttypeRepositoryInterface $repository
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
        return new  DocumenttypeCollection($this->repository->all());
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
