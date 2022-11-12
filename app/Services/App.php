<?php

namespace App\Services;
use SimpleXMLElement;

class App
{
    public static function start(){
        self::db();
        self::dbFilePath();
    }

    public static function dbFilePath(){
        $config = include 'config/db.php';

        return $config;
    }

    public static function db(){
        if(file_exists(self::dbFilePath()['users'])){
            $xml = simplexml_load_file(self::dbFilePath()['users']);
        } else{
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><users/>');;
        }

        return $xml;
    }

}