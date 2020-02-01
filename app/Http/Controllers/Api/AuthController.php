<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

class AuthController extends ApiController
{
    public function testOauth(Request $request)
    {
        $user=Auth::user();
        return $this->sendResponse($user,'Usuarios Recuperados Correctamente');
    }

    public function test(Request $request)
    {
        return  $this->sendResponse([
            'user'=>'OK'
        ], 'Usuario Recuperado Exitosamente');
    }
    public function register (Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'confirmd_password'=>'required|same:password',
        ]);

        if($validator->fails())
        {
            return $this->sendError('Error de Validacion',$validator->errors(),422);
        }
        $input=$request->all();
        $input['password']=\bcrypt($request->get("password"));
        $user=User::create($input);
        $token=$user->createToken('MyApp')->accessToken;
        $data=[
            'token'=>$token,
            'user'=>$user
        ];
        return $this->sendResponse($data,'Usuario Creado Exitosamente');
    }
}
