<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class respon extends Model
{
    protected $table = 'respon_perkembangan';

    protected $fillable = ['id','id_perkembangan','id_terapis','id_orang_tua','deskripsi']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    function orangtua() {
        return $this->belongsTo(orangtua::class, 'id_orangtua', 'id');
    }

}
