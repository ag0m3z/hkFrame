<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 22/09/2017
 * Time: 11:04 PM
 */

namespace core;


class seguridad
{
    public function valida_session_id($NoUsuario = null ){

        //NoUsuario,init_time,session_id

        if($NoUsuario == null){
            $NoUsuario = $_SESSION['DataLogin']['idUsuario'];
        }

        if(array_key_exists('DataLogin',$_SESSION)){

            if(!isset($_SESSION['DataLogin']['idUsuario'])){
                session_unset ();
                session_destroy ();
                session_start();
                session_regenerate_id(true);
                echo "<script>location.href ='".core::ROOT_APP()."modules/applications/layout/error/?error=".md5(3)."';</script>";
            }

        }else{
            //no existe session

            session_unset ();
            session_destroy ();
            session_start();
            session_regenerate_id(true);
            echo "<script>location.href ='".core::ROOT_APP()."modules/applications/layout/error/?error=".md5(3)."';</script>";
        }
    }

    public function get_obtener_ip(){

        if($_SERVER['HTTP_X_FORWARDED_FOR']){

            $is_ipaddress = array(
                'LOCAL'=>$_SERVER['REMOTE_ADDR'],
                'PROXY'=>$_SERVER['HTTP_X_FORWARDED_FOR']
            );

        }else{
            $is_ipaddress =  array(
                'LOCAL'=>$_SERVER['REMOTE_ADDR'],
                'PROXY'=>"127.0.0.1"
            );
        }

        return $is_ipaddress ;
    }

}