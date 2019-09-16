<?php
require_once 'conexion.php';
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