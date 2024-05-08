<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\respon;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class respons extends BaseController
{
    public function readorturespon($id)
    {
        $read = respon::where('id_perkembangan','=',$id)
            ->orderBy('id', 'DESC')
            ->with('orangtua:id,nama')
            ->get();
        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }
    public function ortucreate(Request $req){
        if (isset($req->deskripsi)){
            $respon = new respon;
            $respon->id_perkembangan = $req->id_perkembangan;
            $respon->id_orangtua = $req->id_orangtua;
            $respon->deskripsi = $req->deskripsi;
            $respon->save();
            $data = [
                'status' => 'Success',
                'message' => 'Perkembangan berhasil ditambahkan',
                'data' => ''
            ];
        }else{
            $data = [
                'status' => 'Error',
                'message' => 'Harap Lengkapi form terlebih dahulu',
                'data' => ''
            ];
        }


        return $data;
    }
}
