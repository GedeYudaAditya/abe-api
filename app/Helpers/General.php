<?php

namespace App\Helpers;

class General
{
    public static function web_path($path= ''){
        $local_web2 = base_path() .'/public/'.$path;

        return $local_web2;
    }
}
