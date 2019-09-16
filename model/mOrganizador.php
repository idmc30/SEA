<?php
require_once 'conexion.php';

class Organizador{

	private $objPdo;

	function __construct(){
		$this->objPdo = new Conexion(1);
	}

		public function listarOrganizadoresxEvento($evento_id){
			$sentence = $this->objPdo->prepare("SELECT * FROM sea.evento_participantes ep
																					INNER JOIN sea.organizador o ON  ep.id_organizador=o.id_organizador
																					WHERE ep.evento_id=:evento_id and ep.id_organizador is not null and evpar_estado='A'
																					ORDER BY evpar_id DESC");
			$sentence->execute(array( 
															 'evento_id' => $evento_id
													    ));
			$resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
			return $resultado;
		}


		public function totalderOrganizadoresxEvento($id_evento) {
			$sentence = $this->objPdo->prepare("SELECT count(*) as total_organizadores FROM sea.evento_participantes ep
																				WHERE ep.evento_id=:id_evento and id_organizador is not null and evpar_estado='A'");
			$sentence->execute(array( 
													'id_evento' => $id_evento
												));
			$resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
			return $resultado[0]->total_organizadores;
		}

	public function insertarOrganizador($telefono,$anexo,$nombre,$idtipoorganizador,$idsesionregistroaud,$fecharegistroaud){

		$sql="INSERT INTO sea.organizador(telefono_organizador, anexo_organizador, nombre_organizador, id_tipo_organizador,id_sesion_registro_aud, fecha_registro_aud, id_sesion_update_aud,fecha_update_aud,estado_organizador)  VALUES (:telefono, :anexo, :nombre, :idtipoorganizador, :idsesionregistroaud, :fecharegistroaud, NULL,NULL,'A');";
		$sentence = $this->objPdo->prepare($sql);
		$resultado=$sentence->execute(array(
			'telefono' =>$telefono,
			'anexo' =>$anexo,
			'nombre' =>$nombre,
			'idtipoorganizador' =>$idtipoorganizador,
			'idsesionregistroaud' =>$idsesionregistroaud,
			'fecharegistroaud' =>$fecharegistroaud,
		));
		return $resultado;
	} 

	public function eliminarOrganizador($idsesionupdateaud,$fechaupdateaud,$estado,$idorganizador) {
		$sentence = $this->objPdo->prepare("UPDATE sea.organizador  SET id_sesion_update_aud=:idsesionupdateaud,fecha_update_aud=:fechaupdateaud, estado_organizador=:estado WHERE id_organizador=:idorganizador");
		$resultado = $sentence->execute(array( 
			'idsesionupdateaud' => $idsesionupdateaud,
			'fechaupdateaud' => $fechaupdateaud,
			'estado' => $estado,
			'idorganizador' => $idorganizador,
		));
		return $resultado;
	}

	public function modificarOrganizador($telefono,$anexo,$nombre,$idtipoorganizador,$idsesionupdateaud,$fechaupdateaud,$idorganizador){
		$sql="UPDATE sea.organizador  SET  telefono_organizador=:telefono, anexo_organizador=:anexo, nombre_organizador=:nombre, id_tipo_organizador=:idtipoorganizador,id_sesion_update_aud=:idsesionupdateaud,fecha_update_aud=:fechaupdateaud WHERE id_organizador=:idorganizador";
		$sentence=$this->objPdo->prepare($sql);
		$sentence->execute(array(
			'telefono'=> $telefono,
			'anexo'=> $anexo,
			'nombre'=> $nombre,
			'idtipoorganizador'=> $idtipoorganizador,
			'idsesionupdateaud'=> $idsesionupdateaud,
			'fechaupdateaud'=> $fechaupdateaud,
			'idorganizador'=> $idorganizador,
		));
	} 

	public function getOrganizador($id) {
		$sentence = $this->objPdo->prepare('SELECT id_organizador, telefono_organizador, anexo_organizador, org.nombre_organizador, torg.id_tipo_organizador, torg.nombre_tipo_organizador
			FROM sea.organizador org
			INNER JOIN sea.tipo_organizador torg ON org.id_tipo_organizador=torg.id_tipo_organizador
			WHERE org.id_organizador = :codigo');
		$sentence->execute(array( 
			'codigo' => $id
		));
		$resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
		return $resultado[0];
	}

	public function listarOrganizadores() { 
		$sentence = $this->objPdo->prepare("SELECT * FROM sea.organizador org  
		INNER JOIN sea.tipo_organizador torg ON org.id_tipo_organizador=torg.id_tipo_organizador
		WHERE org.estado_organizador= 'A' ORDER BY id_organizador DESC ");
		$sentence->execute();
		$resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}
}