<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Pengguna;
use App\Models\jenispengguna;
use App\Models\orangtua;
use App\Models\terapis;
use App\Models\auth;

class Login extends BaseController
{
    public function index()
    {
        return "Selamat Datang di API ABE";
    }
    public function profile($id)
    {
        $pengguna = Pengguna::where('id','=',$id)->first();

        if ($pengguna->jenispengguna == 'terapis'){
            $data_user = terapis::where('id','=',$pengguna->id_user)->first();
        }else if ($pengguna->jenispengguna == 'orangtua'){
            $data_user = orangtua::where('id','=',$pengguna->id_user)->first();
        }else{
            $data_user = 'id tidak sesuai';
        }

        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $data_user
        ];
        return $data;
    }
    public function proseslogin(Request $req){
        $username = $req->username;
        $password = md5($req->password);

        $validation = Pengguna::where('nama_user',$username)
            ->where('password', $password)
            ->count();

        if ($validation == 1){
            $getuser = Pengguna::where('nama_user',$username)
                ->where('password', $password)
                ->first();
            if ($getuser->isactive == 'iya'){
                $pengguna = Pengguna::where('nama_user',$username)
                    ->where('password', $password)
                    ->first();
                $pengguna->save();

                $data = [
                    'status' => 'Success',
                    'message' => 'Berhasil untuk login',
                    'data' => $pengguna
                ];
                return $data;
            }else{
                $data = [
                    'status' => 'Error',
                    'message' => 'Akun Anda Sedang di nonaktifkan',
                    'data' => ''
                ];
                return $data;
            }
        }else{
            $data = [
                'status' => 'Error',
                'message' => 'Nama Atau Password Salah',
                'data' => ''
            ];
            return $data;
        }
    }
}
