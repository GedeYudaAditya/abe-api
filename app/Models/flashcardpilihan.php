<?php

namespace App\Models;

use App\jenisflashcard;
use App\pengguna;
use Illuminate\Database\Eloquent\Model;


class flashcardpilihan extends Model
{
    protected $table = 'flashcard_pilihan';

    protected $fillable = ['id','judul','link_flashcard','id_user']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';

}
