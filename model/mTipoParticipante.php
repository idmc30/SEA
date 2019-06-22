<?php
require_once 'conexion.php';
/**
 * 01.- Diego Valdera 11/04/2019 metodo para Evento
 * 02.- idmc modificado el 30/04/2019 se agrego sentence y el return 
 */
class TipoParticpante{
    private $objPdo;
	function __construct(){
			$this->objPdo = new Conexion(1);
  }
  
  public function listarTipoParticipante() {
    $sentence = $this->objPdo->prepare("SELECT tipopar_id, tipopar_nombre, tipopar_estado
    FROM sea.tipo_participante WHERE tipopar_estado='A'");
       $sentence->execute();
       $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
       return $resultado;
}
}