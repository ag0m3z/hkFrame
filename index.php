<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 22/09/2017
 * Time: 11:00 PM
 */
namespace HockmaSales ;

use core\sesiones;
use core\views;
use core\core;

class App{

    public static function init(){

        include "core/core.php";
        include "core/sesiones.php";
        include "core/views.php";

        $vista = new views();
        $sesiones = new sesiones();

        if($sesiones->getExisteSesion()){

            $vista->call_view(
                array(
                    'index',
                    'frmHome'
                )
            );

        }else{

            $vista->call_view(
                array(
                    'login',
                    'FrmLogin'
                )
            );
        }
    }
}

App::init();