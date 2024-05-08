<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\perkembangan;
use App\Models\Pengguna;
use App\Models\memilikiorangtua;

use App\Models\anak;
use App\Models\hubungan;
use App\Models\terapis;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Mockery\Expectation;

class perkembanganterapis extends BaseController
{
    public function anakread($from, $to)
    {
        $read = anak::orderBy('id', 'DESC')
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
    public function anaksearch($from, $to, $search)
    {
        $replacingTitle = str_replace('-', ' ', $search);
        $replacing = str_replace('%20', ' ', $search);
        $read = anak::where('nama', 'LIKE', $search . '%')
            ->orderBy('id', 'DESC')
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
    public function perkembanganread($id)
    {
        $user = User::where('id', '=', $id)->first();

        $terapis = terapis::where('nama_terapis', '=', $user->nama)->first();

        $read = perkembangan::where('id_terapis', $terapis->id)
            ->orderBy('id', 'DESC')
            ->with('terapis:id,nama')
            ->with('anak:id,nama')
            // ->skip($from)
            // ->take($to)
            ->get();
        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }

    public function perkembanganOneRead($id)
    {
        $read = perkembangan::where('id', $id)
            ->with('terapis:id,nama')
            ->with('anak:id,nama')
            ->first();
        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }

    public function changestatus(Request $req)
    {
        try {
            $read = perkembangan::where('id', $req->id);
            $read->status = "readed";
            $read->save();

            $data = [
                'status' => 'Success',
                'message' => 'Perkembangan berhasil di ubah',
                'data' => $read
            ];
        } catch (Expectation $e) {
            $data = [
                'status' => 'Error',
                'message' => 'Perkembangan gagal di ubah. ' . $e->getExceptionMessage(),
                'data' => ''
            ];
        }

        return $data;
    }

    public function perkembangancreate(Request $req)
    {
        if (isset($req->judul) && isset($req->deskripsi)) {
            $perkembangan = new perkembangan;
            $perkembangan->judul = $req->judul;
            $perkembangan->deskripsi = $req->deskripsi;
            $perkembangan->id_anak = $req->id_anak;
            $perkembangan->id_terapis = $req->id_terapis;
            $perkembangan->save();
            $data = [
                'status' => 'Success',
                'message' => 'Perkembangan berhasil ditambahkan',
                'data' => ''
            ];
        } else {
            $data = [
                'status' => 'Error',
                'message' => 'Harap Lengkapi form terlebih dahulu',
                'data' => ''
            ];
        }
        return $data;
    }
    public function perkembangandelete($id)
    {
        $perkembangan = perkembangan::find($id);
        $perkembangan->delete();
        echo 'sukses';
    }

    public function perkembanganupdate(Request $req)
    {
        if (isset($req->judul) && isset($req->deskripsi)) {
            $perkembangan = perkembangan::find($req->id);
            $perkembangan->judul = $req->judul;
            $perkembangan->deskripsi = $req->deskripsi;
            $perkembangan->id_anak = $req->id_anak;
            $perkembangan->id_terapis = $req->id_terapis;
            $perkembangan->save();
            $data = [
                'status' => 'Success',
                'message' => 'Perkembangan berhasil diperbaharui',
                'data' => ''
            ];
        } else {
            $data = [
                'status' => 'Error',
                'message' => 'Harap Lengkapi form terlebih dahulu',
                'data' => ''
            ];
        }
        return $data;
    }
}
