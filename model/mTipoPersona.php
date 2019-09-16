<?php
require_once 'conexion.php';

class TipoPersona{
    private $objPdo;
    function __construct(){
            $this->objPdo = new Conexion(1);
        }
    public function listarTipoPersona() {
        
           $sentence = $this->objPdo->prepare("SELECT id_tipo_persona, nombre_tipo_persona, estado_tipo_persona
           FROM sea.tipo_persona WHERE estado_tipo_persona like 'A'");
       		 $sentence->execute();
        	 $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
       		 return $resultado;
    }
  
  
}