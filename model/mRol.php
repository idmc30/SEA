<?php
require_once 'conexion.php';
/**
 * 01.- Diego Valdera 10/04/2019 continuacion de metodo para lugar
 * 02.- idmc 30/04/2019 modificado se agrego sentence y return a los metodo
 */
class Rol{

    private $objPdo;
	function __construct(){
			$this->objPdo = new Conexion(1);
	}
 public function listarRolesActivos() {
            $sentence = $this->objPdo->prepare("SELECT*FROM sea.rol_usuario WHERE estado_rol_usuario = 'A'");
            $sentence->execute();
            $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
    }

    
}