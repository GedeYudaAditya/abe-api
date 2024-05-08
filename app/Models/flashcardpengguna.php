<?php

namespace App\Models;

use App\jenisflashcard;
use App\pengguna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class flashcardpengguna extends Model
{
    use SoftDeletes;
    protected $table = 'flashcard_pengguna';

    protected $fillable = ['id','judul','deskripsi','akses_admin','id_user']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

}
