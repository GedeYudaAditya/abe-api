<?php

namespace App\Http\Controllers;

use App\Models\auth;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\pengumuman;


class pengumumans extends BaseController
{
    public function read($from, $to)
    {
        $read = pengumuman::orderBy('id', 'DESC')->skip($from)->take($to)->get();

        $readcount = count($read);
        for ($i = 0; $i < $readcount; $i++) {
            //            $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/pengumuman/'.$read[$i]['attachment'];
            $read[$i]['attachment'] = 'https://admin-abe.anyusagita.com/UploadedFile/pengumuman/' . $read[$i]['attachment'];
        }
        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }
    public function search($from, $to, $search)
    {
        $replacingTitle = str_replace('-', ' ', $search);
        $replacing = str_replace('%20', ' ', $search);
        $read = pengumuman::where('judul', 'LIKE', $replacing . '%')
            ->orWhere('deskripsi', 'LIKE', $replacing . '%')
            ->skip($from)
            ->take($to)
            ->get();
        $readcount = count($read);
        for ($i = 0; $i < $readcount; $i++) {
            //            $read[$i]['attachment'] = 'http://abe.intiru.com/UploadedFile/pengumuman/'.$read[$i]['attachment'];
            $read[$i]['attachment'] = 'https://admin-abe.anyusagita.com/UploadedFile/pengumuman/' . $read[$i]['attachment'];
        }
        $data = [
            'status' => 'Success',
            'message' => 'Data Dapat Di Akses',
            'data' => $read
        ];
        return $data;
    }
}
