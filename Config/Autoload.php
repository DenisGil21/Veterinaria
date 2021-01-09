<?php namespace Config;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Autoload {

    public static function run() {
        spl_autoload_register(function($class) {
            $ruta = "../" . str_replace("\\", "/", $class) . ".php";            
            include_once $ruta;
        });
    }

}

?>
