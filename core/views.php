<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 23/09/2017
 * Time: 12:12 AM
 */

namespace core;


class views
{

    private $_view ;
    private $_nameView ;


    public function call_view($data_view = array()){


        $this->_view = $data_view[0] ;
        $this->_nameView = $data_view[1].".php" ;

        if(views::isValid()){

            views::load();
        }

    }

    public function load(){

        include "app/views/$this->_view/$this->_nameView";

    }

    public function isValid(){

        $valid=false;

        if(file_exists($file =  "app/views/$this->_view/$this->_nameView")){
            $valid = true;
        }else{
            views::Error("Error la vista solicitada no existe");
        }

        return $valid;

    }

    public function Error($message){
        print  $message ;
    }

}