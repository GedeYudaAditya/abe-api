<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class terapis extends Model
{
    use SoftDeletes;
    protected $table = 'terapis';

    protected $fillable = ['id','nama','alamat','telp']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];


}
