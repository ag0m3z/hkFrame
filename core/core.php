<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 22/09/2017
 * Time: 11:04 PM
 */

namespace core;
error_reporting(0);
date_default_timezone_set('America/Monterrey');

//error_reporting ( E_ALL ^ E_NOTICE );

header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


class core
{
    public static $_nombreApp = "HockSales";
    public static $_versionApp = "17.09.20";

    public function __construct()
    {


    }

    public static  function ROOT_APP(){
        $ruta = '/HockmaSales/' ;
        return $ruta;
    }

    public static function APP_NAME($NombreApp = NULL){

        if($NombreApp == null){$NombreApp = self::$_nombreApp;}
        return $NombreApp;
    }

    public static function APP_VERSION($VersionApp = null){
        if($VersionApp == null){$VersionApp = self::$_versionApp;}
        return $VersionApp;
    }

    public static function getTitle($title = null){
        if($title == null){$title = self::$_nombreApp;}

        print "<title>".$title."</title>";

    }

    public static function HeaderContetType($Type = "JSON"){

        $Type = strtolower($Type);

        echo header("ContentType:application/'.$Type.'; charset=utf-8");


    }

    public static function includeCSS($dir_path,$all_folder = false){
        if($all_folder){
            // Recorrer todas las hojas de estilo y agregarlas
            $path = $dir_path;
            $handle=opendir($path);
            if($handle){
                while (false !== ($entry = readdir($handle)))  {
                    if($entry!="." && $entry!=".."){
                        $fullpath = $path.$entry;
                        if(!is_dir($fullpath)){
                            echo "<link rel='stylesheet' type='text/css' href='".$fullpath."' />";

                        }
                    }
                }
                closedir($handle);
            }
        }else{
            // Adjuntar solo la Hoja de Estilo solicitada
            echo "<link rel='stylesheet' type='text/css' href='".$dir_path."' />";
        }
    }

    public static function includeJS($dir_path,$all_folder = false){
        if($all_folder){
            // Agregar todos los js y agregarlos
            $path = $dir_path;
            $handle=opendir($path);
            if($handle){
                while (false !== ($entry = readdir($handle)))  {
                    if($entry!="." && $entry!=".."){
                        $fullpath = $path.$entry;
                        if(!is_dir($fullpath)){

                            echo "<script type='text/javascript' src='".$fullpath."'></script>";

                        }
                    }
                }
                closedir($handle);
            }
        }else{
            // Agregar solo el js Solicitado
            echo "<script type='text/javascript' src='".$dir_path."'></script>";
        }
    }

    public static function returnHome(){

        echo "<script>location.href ='".core::ROOT_APP()."';</script>";
    }

    public static function MyAlert($message,$type){

        echo "<script> MyAlert('".$message."','".$type."'); </script>" ;

    }

}