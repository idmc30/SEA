<?php
require_once 'conexion.php';

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