<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\feedback;

class feedbacks extends Controller
{
    public function create(Request $req)
    {
        $judul = $req->judul;
        $deskripsi = $req->deskripsi;
        $id_user = $req->id_user;
        $versi = $req->versi;

        if (isset($judul) || isset($deskripsi)){
            $feedback = new feedback;
            $feedback->judul = $judul;
            $feedback->deskripsi = $deskripsi;
            $feedback->id_user = $id_user;
            $feedback->versi_aplikasi = $versi;
            $feedback->save();
            $data = [
                'status' => 'Success',
                'message' => 'Pesan Telah Disampaikan kepada pengembang aplikasi',
                'data' => ''
            ];
            return $data;
        }else{
            $data = [
                'status' => 'Error',
                'message' => 'Harap Lengkapi kolom judul dan deskripsi untuk mengajukan keluhan',
                'data' => ''
            ];
            return $data;
        }
    }
}
