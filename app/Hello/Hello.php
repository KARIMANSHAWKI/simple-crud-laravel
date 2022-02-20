<?php

namespace App\Hello;

class Hello
{
    public function sayHello($name): string
    {
        return "Hello ".$name;
    }
}