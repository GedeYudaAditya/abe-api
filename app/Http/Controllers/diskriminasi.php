<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\flashcardpilihan;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class diskriminasi extends BaseController
{
    public function read($id)
    {
        $read = flashcardpilihan::where('id_user','=',$id)->first();
        $data = [
            'status' => 'Success',
            'message' => 'Berhasil mendapatkan data',
            'data' => $read
        ];
        return $data;

    }

    public function insert(Request $req)
    {
        $find =  flashcardpilihan::where('id_user','=',$req->id_user)->count();
        if ($find == 0){
            $flashcardpilihan = new flashcardpilihan;
            $flashcardpilihan->judul = $req->judul;
            $flashcardpilihan->link_flashcard = $req->link_flashcard;
            $flashcardpilihan->id_user = $req->id_user;
            $flashcardpilihan->save();
            $data = [
                'status' => 'Success',
                'message' => 'Berhasil memilihkan flashcard',
                'data' => ''
            ];
        }else{
            $flashcardpilihan = flashcardpilihan::where('id_user','=',$req->id_user)->first();
            $flashcardpilihan->judul = $req->judul;
            $flashcardpilihan->link_flashcard = $req->link_flashcard;
            $flashcardpilihan->id_user = $req->id_user;
            $flashcardpilihan->save();
            $data = [
                'status' => 'Success',
                'message' => 'Berhasil memilihkan flashcard',
                'data' => ''
            ];
        }

        return $data;
    }
    public function delete($id){
        $flashcardpilihan = flashcardpilihan::find($id);
        $flashcardpilihan->delete();
        echo 'sukses';
    }
}
