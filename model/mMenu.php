<?php
require_once 'conexion.php';
/**
* 
* 01.- idmc 30/04/2019 modificado se agrego sentence y return a los metodo
*/
class Menu{

	private $objPdo;

	function __construct(){
		$this->objPdo = new Conexion(1);
	}

/**
 * idmc 13/06/2019 creando modelo de menu de navegacion
 */
		public function listarMenuNavegacion($idRol){
			// $sentence = $this->objPdo->prepare("SELECT*FROM sea.menu ORDER BY id_menu ASC");
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