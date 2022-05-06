<?php

class Autoload
{
    public static function inclusionAuto($className)
    {

        require_once __DIR__ . '/' . $className . '.php';
        // echo  __DIR__ . '/' . $className . '.php<br>';

    }

}

spl_autoload_register(array('Autoload' , 'inclusionAuto'));