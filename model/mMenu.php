<?php
require_once 'conexion.php';

class Menu{

	private $objPdo;

	function __construct(){
		$this->objPdo = new Conexion(1);
	}

		public function listarMenuNavegacionAsignacion(){
			$sentence = $this->objPdo->prepare("SELECT * FROM sea.menu m
			WHERE estado_menu='A'	ORDER BY m.id_menu ASC	");
			$sentence->execute();
			$resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
			return $resultado;
		}

		

		public function listarMenuNavegacion($idRol){
			$sentence = $this->objPdo->prepare("SELECT * FROM sea.acceso a
			INNER JOIN sea.rol_usuario r ON a.id_rol_usuario=r.id_rol_usuario
			INNER JOIN sea.menu m ON a.id_menu=m.id_menu
			WHERE estado_acceso='A' and a.id_rol_usuario=:idRol ORDER BY m.id_menu ASC");
			$sentence->execute(array(
									 'idRol' =>$idRol
									));
			$resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
			return $resultado;
		}


		public function consultarTotalSubMenu($idMenu){
	
			$sentence = $this->objPdo->prepare("SELECT count(*) as total_sub_menu FROM sea.menu
			WHERE referencia_menu=:idMenu");
			$sentence->execute(array(
									 'idMenu' =>$idMenu
									));
			$resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
			return $resultado[0]->total_sub_menu;
		}
}