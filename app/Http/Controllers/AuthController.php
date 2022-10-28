<?php

namespace App\Http\Controllers;


use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use App\Http\Requests\{
    RegisterRequest,
    AuthenticateRequest
};
use App\Jobs\SendPasswordJob;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
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

        if ($user) {
            SendPasswordJob::dispatch($datamail);
        }


        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_CREATED);
    }


    public function authenticate(AuthenticateRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No autorizado',
                ], 401);
            }
        } catch (JWTException $e) {
            return $credentials;
            return response()->json(['success' => false, 'message' => 'Could not create token.'], 500);
        }

        //Token created, return with success response and jwt token
        if ($token) {
            DB::table('users')->where('id', JWTAuth::user()->id)->update(['accesstoken' => $token]);
        }
        return response()->json([
            'success' => true,
            'id'   => JWTAuth::user()->id,
            'accesstoken'   => $token,
            'firstName'    => JWTAuth::user()->first_name,
            'email'   => JWTAuth::user()->email,
            'idrol'   => JWTAuth::user()->idrol
        ]);
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('accesstoken'), [
            'accesstoken' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => 'Error de logout'], 200);
            // return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated, do logout
        try {
            JWTAuth::invalidate($request->accesstoken);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'accesstoken' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->accesstoken);

        return response()->json(['user' => $user]);
    }
}
