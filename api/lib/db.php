<?php

namespace Api\Lib;

class DB{
    public static function start(){
        $pdo=new PDO('mysql:host=localhost;dbname=storypub','root','linuxlinux');
    }
}