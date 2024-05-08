<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\perkembangan;
use App\Models\Pengguna;
use App\Models\anak;
use App\Models\orangtua;
use App\Models\hubungan;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class perkembanganorangtua extends BaseController
{
    public function anakread($from,$to,$idortu)
    {
        $read = hubungan::where('id_orangtua','=',$idortu)
            ->orderBy('id', 'DESC')
            ->with('anak')
            ->with('orangtua:id,nama')
            ->skip($from)
            ->take($to)
            ->get();
        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }

    public function perkembanganread($from,$to,$id)
    {
        $read = perkembangan::where('id_anak','=',$id)
            ->orderBy('id', 'DESC')
            ->with('terapis:id,nama')
            ->with('anak:id,nama')
            ->skip($from)
            ->take($to)
            ->get();
        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }
}
