<?php
//load config
require_once 'config/config.php';
 //require libraries
 
//auto load core

spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
});