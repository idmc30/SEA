<?php
require_once 'conexion.php';
/**
 * 01.- Diego Valdera 18/04/2019 metodo para Modalidad Contractual
 * 02.- idmc 30/04/2019 modificado se agrego sentence y return a los metodo
 */
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