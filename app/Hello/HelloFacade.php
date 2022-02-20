<?php

namespace App\Hello;

use Illuminate\Support\Facades\Facade;

class HelloFacade extends Facade
{
        protected static function getFacadeAccessor(){
            return 'greeting';
        }
}