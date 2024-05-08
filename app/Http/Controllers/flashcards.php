<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\Pengguna;
use App\Models\orangtua;
use App\Models\terapis;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\flashcard;


class flashcards extends BaseController
{
    public function read($id)
    {
        $read = flashcard::where('id_jenis', $id)
            ->orderBy('id', 'DESC')
            // ->skip($from)
            // ->take($to)
            ->get();
        $readcount = count($read);
        for ($i = 0; $i < $readcount; $i++) {
            $read[$i]['attachment'] = 'https://admin-abe.anyusagita.com/UploadedFile/flashcard/' . $read[$i]['attachment']; // wifi rumah
            // $read[$i]['attachment'] = 'http://192.168.1.108:8505/UploadedFile/flashcard/' . $read[$i]['attachment']; // wifi rumah
            // $read[$i]['attachment'] = 'http://10.10.29.165:8505/UploadedFile/flashcard/' . $read[$i]['attachment']; // Undiksha Harmony
            //            $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/flashcard/'.$read[$i]['attachment'];
        }
        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }

    public function readOne($id)
    {
        $read = flashcard::where('id', $id)
            ->first();
        // $read['attachment'] = 'http://10.10.29.165:8505/UploadedFile/flashcard/' . $read['attachment']; // Undiksha Harmony
        // $read['attachment'] = 'http://192.168.1.108:8505/UploadedFile/flashcard/' . $read['attachment']; // wifi rumah
        $read['attachment'] = 'https://admin-abe.anyusagita.com/UploadedFile/flashcard/' . $read['attachment']; // wifi rumah

        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }
}
