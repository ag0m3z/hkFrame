<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 22/09/2017
 * Time: 11:04 PM
 */

namespace core;


class bd
{
    //Atributo para crear la conexion con la base de datos
    private $conexion ;

    public $_confirm = false;
    public $_rows = array();
    public $_query = "";
    public $_message = "";

    private $_data_source = array(
        "PRD"=>array(
            "bdHost"=>"localhost",
            "bdUser"=>"root",
            "bdPass"=>"",
            "bdData"=>"HSDESK",
            "port"=>"3306"
        ),
        "QAS"=>array(
            "bdHost"=>"localhost",
            "bdUser"=>"root",
            "bdPass"=>"",
            "bdData"=>"HSDESK",
            "port"=>"3306"
        ),
        "DEV"=>array(
            "bdHost"=>"localhost",
            "bdUser"=>"root",
            "bdPass"=>"",
            "bdData"=>"HSDESK",
            "port"=>"3306"
        )
    );

    public function __construct($BD = "PRD")
    {
        //Constructor para la conexion con la base de datos

        $this->conexion = new \mysqli('localhost','root','','HSDESK','3306');

        if($this->conexion->connect_errno){

            $this->_message = "Connect failed: ". $this->conexion->connect_error ;
            $this->_confirm = false;
            exit();

        }else{
            $this->conexion->query("SET NAMES 'utf8'");
            $this->_message = "conexion exitosa";
        }

    }

    //funciones para sanatizar las consultas
    private function clean_input($input) {

        $search = array(
            '@<script[^>]*?>.*?</script>@si',   // Elimina javascript
            '@<[\/\!]*?[^<>]*?>@si',            // Elimina las etiquetas HTML
            '@<style[^>]*?>.*?</style>@siU',    // Elimina las etiquetas de estilo
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Elimina los comentarios multi-l�nea
        );

        $output = preg_replace($search, '', $input);
        return $output;
    }

    public function get_sanatiza($input) {

        if (is_array($input)) {
            foreach($input as $var=>$val) {
                $output[$var] = $this->get_sanatiza($val);
            }
        }
        else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input  = $this->clean_input($input);
            $output =   $this->conexion->real_escape_string($input);
        }
        return $output;
    }

    // funcion para ejecutar solomante el query sin guardar el resultado
    public function execute_query(){

        if (!$this->conexion->query($this->_query)) {

            $this->_message = "Mesaje de error: " . $this->conexion->errno. " " . $this->conexion->error ;
            $this->_confirm = false;
            exit();

        }
    }

    public function get_result_multi_query(){

        unset($this->_rows);

        if (!$this->conexion->multi_query($this->_query)) {

            $this->_message = "Mesaje de error: " . $this->conexion->errno. " " . $this->conexion->error ;
            $this->_confirm = false;
            exit();
        }

        do {
            if ($resultado = $this->conexion->store_result()) {
                $this->_rows[] = $resultado->fetch_all();
                $resultado->free();

            } else {
                if ($this->conexion->errno) {

                    $this->_message = "Store failed: (" . $this->conexion->errno . ") " . $this->conexion->error;
                    $this->_confirm = false;
                    exit();
                }
            }
        } while ($this->conexion->more_results() && $this->conexion->next_result());
    }

    public function get_result_query(){

        unset($this->_rows);

        if(!$result = $this->conexion->query($this->_query)){

            $this->_message = "Mesaje de error: " . $this->conexion->errno. " " . $this->conexion->error ;
            $this->_confirm = false;
            exit();

        }else{

            while($this->_rows[] = $result->fetch_array()) ;
            $this->conexion->next_result();  //Prepara el siguiente juego de resultados de una llamada
            $result->free_result(); //Libera la memoria asociada al resultado.
            array_pop($this->_rows) ;

        }
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->conexion->close();    }


}