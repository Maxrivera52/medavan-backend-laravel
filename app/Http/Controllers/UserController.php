<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\UserCollection;
use App\Interfaces\UserRepositoryInterface;
use App\Jobs\SendPasswordJob;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Controller;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    private $repository;

    public function __construct(
        UserRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function update($id, Request $request)
    {
        $config = (object)array("id" => $id, "tipo" => 1);
        return  ResponseResource::Response($this->repository->update($id, $request->all()), $config);
    }

    public function listAll(Request $request)
    {
        return new  UserCollection($this->repository->all([
            'id',
            'email',
            'first_name',
            'last_name',
            'avatar',
            'idrol',
            'enable',
            'created_at',
            'updated_at'
        ],['rol']));
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

    public function create(Request $request)
    {

        $bytes = openssl_random_pseudo_bytes(4);
        $pass = bin2hex($bytes);


        //Request is valid, create new user
        $user = User::create([
            'email'     => $request->email,
            'password'  => bcrypt($pass),
            'first_name'   => $request->first_name,
            'last_name'   => $request->last_name,
            'avatar'   => $request->avatar,
            'idrol' => $request->idrol
        ]);
        $datamail = array("email" => $request->email, "password" => $pass ,"name"=>$request->first_name);

        // if ($user) {
        //     SendPasswordJob::dispatch($datamail);
        // }


        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_CREATED);
    }

}
