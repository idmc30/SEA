<?php
require_once 'conexion.php';
class Acceso{

	private $objPdo;

	function __construct(){
		$this->objPdo = new Conexion(1);
	}

public function estadoCheckMenuPerfil($codigorol, $codigomenu){
	$stmt=$this->objPdo->prepare("SELECT estado_acceso
	FROM sea.acceso WHERE id_rol_usuario=:codrol AND  id_menu=:codmenu AND estado_acceso='A'");
	$stmt->execute(array(
						 'codrol' =>$codigorol, 
						 'codmenu' =>$codigomenu
						));
	$estadoacceso = $stmt->fetchAll(PDO::FETCH_OBJ);
	return $estadoacceso[0]->estado_acceso;
}   

	public function insertarAcceso($estadoacceso,$idrolusuario,$idmenu,$idsesionregistroaud,$fecharegistroaud){

		$sql="INSERT INTO sea.acceso(estado_acceso, id_rol_usuario, id_menu, id_sesion_registro_aud,fecha_registro_aud)VALUES (:estadoacceso, :idrolusuario, :idmenu,:idsesionregistroaud ,:fecharegistroaud);";
		$sentence = $this->objPdo->prepare($sql);
		$resultado=$sentence->execute(array(
			'estadoacceso' =>$estadoacceso,
			'idrolusuario' =>$idrolusuario,
			'idmenu' =>$idmenu,
			'idsesionregistroaud' =>$idsesionregistroaud,
			'fecharegistroaud' =>$fecharegistroaud,
		));
		return $resultado;
	} 




	public function eliminarAcceso($estado,$idrolusuario,$idmenu,$idsession,$fechaupdate) {
		$stmt = $this->objPdo->prepare('UPDATE sea.acceso
		SET estado_acceso=:estado ,id_sesion_update_aud=:idsesionupdateaud, fecha_update_aud=:fechaupdateaud
	     WHERE id_rol_usuario=:idrolusuario and id_menu=:idmenu');
        $rows = $stmt->execute(array( 
									 'estado'=>$estado,
									 'idsesionupdateaud'=>$idsession,
									 'fechaupdateaud'=>$fechaupdate,
									 'idrolusuario' => $idrolusuario,
									 'idmenu' => $idmenu,

								)
							);
    }
}