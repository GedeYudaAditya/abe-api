<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\Pengguna;
use App\Models\orangtua;
use App\Models\terapis;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\flashcard;
use App\Models\flashcardpengguna;
use function PHPUnit\Framework\isEmpty;
use App\Helpers\General;


class flashcardpenggunas extends BaseController
{
    public function read($from, $to, $id)
    {
        $read = flashcardpengguna::where('id_user', '=', $id)
            ->orderBy('id', 'DESC')
            ->skip($from)
            ->take($to)
            ->get();
        $readcount = count($read);
        for ($i = 0; $i < $readcount; $i++) {
            $read[$i]['attachment'] = 'https://admin-abe.anyusagita.com/UploadedFile/flashcardpengguna/' . $read[$i]['attachment'];
            //            $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/jenisflashcard/'.$read[$i]['attachment'];
        }
        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }
    public function create(Request $req)
    {
        if (isset($req->judul) && isset($req->deskripsi) && isset($req->file)) {
            $flashcardpengguna = new flashcardpengguna;
            $flashcardpengguna->judul = $req->judul;
            $flashcardpengguna->deskripsi = $req->deskripsi;
            $flashcardpengguna->id_user = $req->id_user;
            $flashcardpengguna->akses_admin = 'tidak';
            $gambar = $req->file('file');
            $gambar->move(General::web_path('UploadedFile/flashcardpengguna/'), time() . '_' . $gambar->getClientOriginalName());
            $flashcardpengguna->attachment = time() . '_' . $gambar->getClientOriginalName();
            $flashcardpengguna->save();
            $data = [
                'status' => 'Success',
                'message' => 'Gambar berhasil ditambahkan',
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
    public function update(Request $req)
    {
        if (isset($req->judul) && isset($req->deskripsi)) {
            $flashcardpengguna = flashcardpengguna::find($req->id);
            $flashcardpengguna->judul = $req->judul;
            $flashcardpengguna->deskripsi = $req->deskripsi;
            $flashcardpengguna->id_user = $req->id_user;
            if (isset($req->file)) {
                $gambar = $req->file('file');
                if (isset($gambar)) {
                    unlink(General::web_path('UploadedFile/flashcardpengguna/' . $flashcardpengguna->attachment));
                    $gambar->move(General::web_path('UploadedFile/flashcardpengguna/'), time() . '_' . $gambar->getClientOriginalName());
                    $flashcardpengguna->attachment = time() . '_' . $gambar->getClientOriginalName();
                }
            }
            $flashcardpengguna->save();
            $data = [
                'status' => 'Success',
                'message' => 'Gambar dapat diperbaharui',
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
    public function delete($id)
    {
        $flashcardpengguna = flashcardpengguna::find($id);
        unlink(General::web_path('UploadedFile/flashcardpengguna/' . $flashcardpengguna->attachment));
        $flashcardpengguna->delete();
        echo 'sukses';
    }
}
