<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserData;

class UserDataController extends ApiController
{
    public function getUsers(){
        $data=[];
        $user=UserData::all();
        $data['users']=$user;

        return $this->sendResponse($data,'Usuarios Recuperados Correctamente');
    }
}
