<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jenispengguna;
use App\Models\Pengguna;
use App\Models\auth;
use App\Models\notifikasi;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;


class notifikasis extends BaseController
{
    public function read($id)
    {
        // $read = notifikasi::where('id_user', '=', $id)
        //     ->orderBy('id', 'DESC')
        //     // ->skip($from)
        //     // ->take($to)
        //     ->get();

        $read = DB::table('notifikasi')
            ->join('pengguna', 'notifikasi.id_user', '=', 'pengguna.id')
            ->select('notifikasi.*', 'pengguna.nama')
            ->where('notifikasi.id_user', '=', $id)
            ->orderBy('notifikasi.id', 'DESC')
            ->get();

        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }
}
