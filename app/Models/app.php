<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class app extends Model
{
    protected $table = 'app';
    protected $fillable = ['id','token','userID','id_user']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';

}
