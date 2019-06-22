<?php
require_once 'conexion.php';
/** 
 * 01.- Irwin Morales 09/04/2019 metod para organizador
 */
class TipoOrganizador{

        private $objPdo;
        function __construct(){
                $this->objPdo = new Conexion(1);
            }
    public function listarTipoOrganizador() {
         $sentence = $this->objPdo->prepare("SELECT id_tipo_organizador, nombre_tipo_organizador, estado_tipo_organizador FROM sea.tipo_organizador  WHERE estado_tipo_organizador='A'");
       		 $sentence->execute();
        	 $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
       		 return $resultado;
    }
  
  }