<?php

namespace App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

use Illuminate\Database\Eloquent\Model;

class AdminLogger extends logger
{

    public static function create() 
    {	
    $obj = new AdminLogger('adm');
    $obj->pushHandler(new StreamHandler('./my_app.log', Logger::INFO));
    $obj->pushHandler(new FirePHPHandler());

    return $obj;

    }
}
