<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\perkembangan;
use App\Models\Pengguna;
use App\Models\memilikiorangtua;
use App\Models\jenisflashcard;
use App\Models\flashcardpengguna;
use App\Models\flashcard;
use App\Models\flashcarddibagikan;

use App\Models\anak;
use App\Models\hubungan;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class persamaan extends BaseController
{
    public function flashcardtype()
    {
        $read = jenisflashcard::orderBy('id', 'DESC')->get();
        $readcount = count($read);
        for ($i = 0; $i < $readcount; $i++) {
            $read[$i]['attachment'] = 'https://admin-abe.anyusagita.com/UploadedFile/jenisflashcard/' . $read[$i]['attachment'];
        }
        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }
    public function flashcard($id)
    {
        $read = flashcard::where('id_jenis', '=', $id)
            ->orderBy('id', 'DESC')
            ->get();
        $readcount = count($read);
        for ($i = 0; $i < $readcount; $i++) {
            $read[$i]['attachment'] = 'https://admin-abe.anyusagita.com/UploadedFile/flashcard/' . $read[$i]['attachment'];
        }
        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }
    public function flashcardshared($id)
    {
        $read = flashcarddibagikan::where([
            ['id_user_penerima', '=', $id],
            ['user_acc', '=', 'iya']
        ])
            ->with('flashcardpengguna:id,attachment,judul,deskripsi')
            ->with('penerima:id,nama_user,jenispengguna,id_user')
            ->with('pengirim:id,nama_user,jenispengguna,id_user')
            ->orderBy('id', 'DESC')
            ->get();
        $i = 0;
        foreach ($read as $item) {
            if ($item->flashcardpengguna == null) {
                unset($read[$i]);
            } else {
                $item->attachment = 'https://admin-abe.anyusagita.com/UploadedFile/flashcardpengguna/' . $item->flashcardpengguna->attachment;
                $item->judul = $item->flashcardpengguna->judul;
            }

            $i++;
        }

        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }
    public function myflashcard($id)
    {
        $read = flashcardpengguna::where('id_user', '=', $id)
            ->orderBy('id', 'DESC')
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
}
