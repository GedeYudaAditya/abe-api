<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Pengguna;
use App\Models\app;
use Illuminate\Support\Facades\DB;



class apps extends BaseController
{
    public function insert($id,$appid,$token)
    {
        $validation = app::where([
            ['id_user','=',$id],
        ])->count();
        if ($validation > 0){
            $app = app::where('id_user','=',$id)->first();
            $app->token = $token;
            $app->id_user = $id;
            $app->userID = $appid;
            $app->save();
        }else if ($validation == 0){
            $app = new app;
            $app->token = $token;
            $app->id_user = $id;
            $app->userID = $appid;
            $app->save();
        }
        return $validation;
    }
}
