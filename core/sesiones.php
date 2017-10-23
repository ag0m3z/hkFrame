<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 22/09/2017
 * Time: 11:04 PM
 */
namespace core;
session_name(md5(core::APP_NAME()));
session_start();
session_id();

class sesiones
{
    public function set($nombre_array,$datos = array()){

        $_SESSION[$nombre_array] = $datos ;
    }

    public function get($nombre_array,$nombre) {

        if (isset ( $_SESSION [$nombre_array][$nombre] )) {

            return $_SESSION [$nombre_array][$nombre];

        } else {

            return false;

        }
    }

    static function borrar_variable($nombre_array,$nombre) {
        unset ($_SESSION [$nombre_array][$nombre] );
    }

    public function getExisteSesion(){

        if(array_key_exists('DataLogin',$_SESSION)){

            if(!isset($_SESSION['DataLogin']['idUsuario'])){
                $this->delete_sesion();
                return false;
            }else{
                return true;
            }

        }else{
            $this->delete_sesion();
            return false;
        }

    }

    public function delete_sesion() {

        session_unset ();
        session_destroy ();
        session_start();
        session_regenerate_id(true);
    }

}