<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class hubungan extends Model
{

    protected $table = 'hubungan';

    protected $fillable = ['id','id_anak','id_orangtua']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';

    function orangtua() {
        return $this->belongsTo(orangtua::class, 'id_orangtua', 'id');
    }
    function anak() {
        return $this->belongsTo(anak::class, 'id_anak', 'id');
    }

}
