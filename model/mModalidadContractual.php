<?php
require_once 'conexion.php';

class ModalidadContractual{
    private $objPdo;
	function __construct(){
		$this->objPdo = new Conexion(1);
	}
    public function consultarModalidadContractual() {
        $sentence = $this->objPdo->prepare("SELECT * FROM sea.modalidad_contractual where estado_modalidad_contractual like 'A'");
        $sentence->execute();
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
}
?>