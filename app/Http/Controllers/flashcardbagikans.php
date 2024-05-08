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
use App\Models\flashcarddibagikan;



class flashcardbagikans extends BaseController
{
    public function createadmin(Request $req)
    {
        $flashcardpengguna = flashcardpengguna::find($req->id);
        $flashcardpengguna->akses_admin = 'iya';
        $flashcardpengguna->save();
        $data = [
            'status' => 'Success',
            'message' => 'Gambar berhasil di bagikan pada admin',
            'data' => ''
        ];
        return $data;
    }
    public function penggunaread($from, $to, $id)
    {
        $read1 =
            Pengguna::where('jenispengguna', '=', 'terapis')
            ->with('terapis:id,nama')
            ->orderBy('id', 'DESC')
            ->get();
        $read2 =
            Pengguna::where('jenispengguna', '=', 'orangtua')
            ->with('orangtua:id,nama')
            ->orderBy('id', 'DESC')
            ->get();

        $read1count = count($read1);
        for ($i = 0; $i < $read1count; $i++) {
            if ($read1[$i]['id'] == $id) {
                unset($read1[$i]);
            }
        }
        $read2count = count($read1);
        for ($i = 0; $i < $read2count; $i++) {
            if ($read2[$i]['id'] == $id) {
                unset($read2[$i]);
            }
        }

        $readfull = array_merge(json_decode($read1), json_decode($read2));

        $data = [
            'status' => 'Success',
            'message' => 'Data Berhasil Ditampilkan',
            'data' => array_slice($readfull, $from, $to)
        ];
        return $data;
    }
    public function penggunasearch($from, $to, $id, $search)
    {
        $replacingTitle = str_replace('-', ' ', $search);
        $replacing = str_replace('%20', ' ', $search);
        $read1 =
            Pengguna::where('jenispengguna', '=', 'terapis')
            ->with('terapis:id,nama')
            ->orderBy('id', 'DESC')
            ->get();
        $read2 =
            Pengguna::where('jenispengguna', '=', 'orangtua')
            ->with('orangtua:id,nama')
            ->orderBy('id', 'DESC')
            ->get();

        $read1count = count($read1);
        for ($i = 0; $i < $read1count; $i++) {
            if ($read1[$i]['id'] == $id) {
                unset($read1[$i]);
            }
        }
        $read2count = count($read1);
        for ($i = 0; $i < $read2count; $i++) {
            if ($read2[$i]['id'] == $id) {
                unset($read2[$i]);
            }
        }

        $readfull = array_merge(json_decode($read1), json_decode($read2));
        $i = 0;
        $j = 0;
        $filtered = [];
        foreach ($readfull as $item) {
            if (stripos($item->nama_user, $replacing) !== false) {
                if (stripos($item->terapis->nama, $replacing) !== false) {
                    $filtered[$i]['id'] = $item->id;
                    $filtered[$i]['nama_user'] = $item->nama_user;
                    $filtered[$i]['created_at'] = $item->created_at;
                    $filtered[$i]['updated_at'] = $item->updated_at;
                    $filtered[$i]['password'] = $item->password;
                    $filtered[$i]['app_id'] = $item->app_id;
                    $filtered[$i]['isactive'] = $item->isactive;
                    $filtered[$i]['jenispengguna'] = $item->jenispengguna;
                    $filtered[$i]['id_user'] = $item->id_user;
                    $filtered[$i]['deleted_at'] = $item->deleted_at;
                    $filtered[$i]['terapis'] = $item->terapis;
                } elseif (stripos($item->orangtua->nama, $replacing) !== false) {
                    $filtered[$i]['id'] = $item->id;
                    $filtered[$i]['nama_user'] = $item->nama_user;
                    $filtered[$i]['created_at'] = $item->created_at;
                    $filtered[$i]['updated_at'] = $item->updated_at;
                    $filtered[$i]['password'] = $item->password;
                    $filtered[$i]['app_id'] = $item->app_id;
                    $filtered[$i]['isactive'] = $item->isactive;
                    $filtered[$i]['jenispengguna'] = $item->jenispengguna;
                    $filtered[$i]['id_user'] = $item->id_user;
                    $filtered[$i]['deleted_at'] = $item->deleted_at;
                    $filtered[$i]['orangtua'] = $item->orangtua;
                }
            }
            $i++;
        }

        $data = [
            'status' => 'Success',
            'message' => 'Data Berhasil Ditampilkan',
            'data' => array_slice($filtered, $from, $to)
        ];
        return $data;
    }
    public function createuser(Request $req)
    {
        $flashcarddibagikan = new flashcarddibagikan;
        $flashcarddibagikan->id_flashcard_pengguna = $req->id_flashcard_pengguna;
        $flashcarddibagikan->id_user_penerima = $req->id_user_penerima;
        $flashcarddibagikan->id_user_pengirim = $req->id_user_pengirim;
        $flashcarddibagikan->user_acc = 'pending';
        $flashcarddibagikan->save();
        $data = [
            'status' => 'Success',
            'message' => 'Gambar berhasil di bagikan Pada pengguna',
            'data' => ''
        ];
        return $data;
    }
    public function penggunareaddraft($from, $to, $id)
    {
        $read = flashcarddibagikan::where([
            ['id_user_penerima', '=', $id],
            ['user_acc', '=', 'pending']
        ])
            ->with('flashcardpengguna:id,attachment,judul,deskripsi')
            ->with('penerima:id,nama_user,jenispengguna,id_user')
            ->with('pengirim:id,nama_user,jenispengguna,id_user')
            ->orderBy('id', 'DESC')
            ->skip($from)
            ->take($to)
            ->get();
        $i = 0;
        foreach ($read as $item) {
            if ($item->flashcardpengguna == null) {
                unset($read[$i]);
            } else {
                $item->attachment = 'https://admin-abe.anyusagita.com/UploadedFile/flashcardpengguna/' . $item->flashcardpengguna->attachment;
            }

            if ($item->penerima == null) {
                unset($read[$i]);
            } else {
                if ($item->penerima->jenispengguna == 'terapis') {
                    $pengguna = terapis::where('id', '=', $item->penerima->id_user)
                        ->first();
                    $item->id_penerima = $pengguna;
                }
                if ($item->penerima->jenispengguna == 'orangtua') {
                    $pengguna = orangtua::where('id', '=', $item->penerima->id_user)
                        ->first();
                    $item->id_penerima = $pengguna;
                }
            }

            if ($item->pengirim == null) {
                unset($read[$i]);
            } else {
                if ($item->pengirim->jenispengguna == 'terapis') {
                    $pengguna = terapis::where('id', '=', $item->pengirim->id_user)
                        ->first();
                    $item->id_pengirim = $pengguna;
                }
                if ($item->pengirim->jenispengguna == 'orangtua') {
                    $pengguna = orangtua::where('id', '=', $item->pengirim->id_user)
                        ->first();
                    $item->id_pengirim = $pengguna;
                }
            }

            $i++;
        }

        $data = [
            'status' => 'Success',
            'message' => 'Data Berhasil Ditampilkan',
            'data' => $read
        ];
        return $data;
    }
    public function penggunadraftacc($id)
    {
        $flashcarddibagikan = flashcarddibagikan::find($id);
        $flashcarddibagikan->user_acc = 'iya';
        $flashcarddibagikan->save();

        echo 'sukses';
    }
    public function penggunadelete($id)
    {
        $flashcarddibagikan = flashcarddibagikan::find($id);
        $flashcarddibagikan->delete();
        echo 'sukses';
    }

    public function penggunareadterkirim($from, $to, $id)
    {
        $read = flashcarddibagikan::where('id_user_pengirim', '=', $id)
            ->with('flashcardpengguna:id,attachment,judul,deskripsi')
            ->with('penerima:id,nama_user,jenispengguna,id_user')
            ->with('pengirim:id,nama_user,jenispengguna,id_user')
            ->orderBy('id', 'DESC')
            ->skip($from)
            ->take($to)
            ->get();
        $i = 0;
        foreach ($read as $item) {
            if ($item->flashcardpengguna == null) {
                unset($read[$i]);
            } else {
                $item->attachment = 'https://admin-abe.anyusagita.com/UploadedFile/flashcardpengguna/' . $item->flashcardpengguna->attachment;
            }

            if ($item->penerima == null) {
                unset($read[$i]);
            } else {
                if ($item->penerima->jenispengguna == 'terapis') {
                    $pengguna = terapis::where('id', '=', $item->penerima->id_user)
                        ->first();
                    $item->id_penerima = $pengguna;
                }
                if ($item->penerima->jenispengguna == 'orangtua') {
                    $pengguna = orangtua::where('id', '=', $item->penerima->id_user)
                        ->first();
                    $item->id_penerima = $pengguna;
                }
            }

            if ($item->pengirim == null) {
                unset($read[$i]);
            } else {
                if ($item->pengirim->jenispengguna == 'terapis') {
                    $pengguna = terapis::where('id', '=', $item->pengirim->id_user)
                        ->first();
                    $item->id_pengirim = $pengguna;
                }
                if ($item->pengirim->jenispengguna == 'orangtua') {
                    $pengguna = orangtua::where('id', '=', $item->pengirim->id_user)
                        ->first();
                    $item->id_pengirim = $pengguna;
                }
            }

            $i++;
        }
        $data = [
            'status' => 'Success',
            'message' => 'Data Berhasil Ditampilkan',
            'data' => $read
        ];
        return $data;
    }
    public function penggunareadkiriman($from, $to, $id)
    {
        $read = flashcarddibagikan::
            //        where('id_user_penerima','=',$id)
            where([
                ['id_user_penerima', '=', $id],
                ['user_acc', '=', 'iya']
            ])
            ->with('flashcardpengguna:id,attachment,judul,deskripsi')
            ->with('penerima:id,nama_user,jenispengguna,id_user')
            ->with('pengirim:id,nama_user,jenispengguna,id_user')
            ->orderBy('id', 'DESC')
            ->skip($from)
            ->take($to)
            ->get();
        $i = 0;
        foreach ($read as $item) {
            if ($item->flashcardpengguna == null) {
                unset($read[$i]);
            } else {
                $item->attachment = 'https://admin-abe.anyusagita.com/UploadedFile/flashcardpengguna/' . $item->flashcardpengguna->attachment;
            }

            if ($item->penerima == null) {
                unset($read[$i]);
            } else {
                if ($item->penerima->jenispengguna == 'terapis') {
                    $pengguna = terapis::where('id', '=', $item->penerima->id_user)
                        ->first();
                    $item->id_penerima = $pengguna;
                }
                if ($item->penerima->jenispengguna == 'orangtua') {
                    $pengguna = orangtua::where('id', '=', $item->penerima->id_user)
                        ->first();
                    $item->id_penerima = $pengguna;
                }
            }

            if ($item->pengirim == null) {
                unset($read[$i]);
            } else {
                if ($item->pengirim->jenispengguna == 'terapis') {
                    $pengguna = terapis::where('id', '=', $item->pengirim->id_user)
                        ->first();
                    $item->id_pengirim = $pengguna;
                }
                if ($item->pengirim->jenispengguna == 'orangtua') {
                    $pengguna = orangtua::where('id', '=', $item->pengirim->id_user)
                        ->first();
                    $item->id_pengirim = $pengguna;
                }
            }
            $i++;
        }
        $data = [
            'status' => 'Success',
            'message' => 'Data Berhasil Ditampilkan',
            'data' => $read
        ];
        return $data;
    }
}
