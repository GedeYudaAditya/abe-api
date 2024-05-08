<?php

namespace App\Http\Controllers;

use App\Models\auth;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\jenisflashcard;


class jenisflashcards extends BaseController
{
    public function read()
    {
        $read = jenisflashcard::orderBy('id', 'DESC')->get();
        $readcount = count($read);
        for ($i = 0; $i < $readcount; $i++) {
            $read[$i]['attachment'] = 'https://admin-abe.anyusagita.com/UploadedFile/jenisflashcard/' . $read[$i]['attachment']; // api abe
            // $read[$i]['attachment'] = 'http://192.168.1.108:8505/UploadedFile/jenisflashcard/' . $read[$i]['attachment']; // wifi rumah
            // $read[$i]['attachment'] = 'http://10.10.29.165:8505/UploadedFile/jenisflashcard/' . $read[$i]['attachment']; // undiksha harmony
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
