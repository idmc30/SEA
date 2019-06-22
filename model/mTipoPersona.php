<?php
require_once 'conexion.php';
/** 
 * 01.- Irwin Morales 09/04/2019 metod para organizador
 * 02--idmc 30/04/2019 modificado se agrego sentence y return a los metodo
 */
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