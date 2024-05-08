<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class flashcarddibagikan extends Model
{
    use SoftDeletes;
    protected $table = 'flashcard_dibagikan';

    protected $fillable = ['id','id_flashcard_pengguna','id_user_pengirim','id_user_penerima','user_acc']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    function flashcardpengguna() {
        return $this->belongsTo(flashcardpengguna::class, 'id_flashcard_pengguna', 'id');
    }
    function pengirim() {
        return $this->belongsTo(pengguna::class, 'id_user_pengirim', 'id');
    }
    function penerima() {
        return $this->belongsTo(pengguna::class, 'id_user_penerima', 'id');
    }

}
