<?php
require_once 'conexion.php';

class Representante{

	private $objPdo;

	function __construct(){
		$this->objPdo = new Conexion(1);
	}


  public function eliminarRepresentante($id_sesion_update_aud,$fecha_update_aud,$evpar_id) { 
		$sentence = $this->objPdo->prepare("UPDATE sea.evento_participantes SET evpar_estado='I',id_sesion_update_aud=:id_sesion_update_aud, fecha_update_aud=:fecha_update_aud  WHERE evpar_id=:evpar_id");
		$sentence->execute(array(
                              'id_sesion_update_aud'=>$id_sesion_update_aud,
                              'fecha_update_aud'=>$fecha_update_aud,
                              'evpar_id'=>$evpar_id,
                  ));
		$resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}


	public function listarRepresentante($id_organizador) { 
		$sentence = $this->objPdo->prepare("SELECT * from sea.evento_participantes ep 
																				INNER JOIN sea.usuario u on ep.id_usuario = u.id_usuario
																				INNER JOIN sea.persona p on p.id_persona=u.id_persona
																				LEFT JOIN sea.modalidad_contractual mc ON p.id_modalidad_contractual=mc.id_modalidad_contractual
	                                      INNER JOIN sea.eventos e ON ep.evento_id=e.evento_id
																				INNER JOIN sea.tipo_participante tp on tp.tipopar_id=ep.tipopar_id
																				INNER JOIN sea.organizador o on ep.id_organizador = o.id_organizador
																				WHERE ep.id_organizador = :id_organizador AND ep.evpar_estado='A' ORDER BY evpar_id DESC");
		$sentence->execute(array(
                              'id_organizador'=>$id_organizador
                  ));
		$resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}
	
}