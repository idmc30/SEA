<?php
require_once 'conexion.php';

/**
 * 01.- Irwin Morales 09/04/2019 metodo para Lugar
 * 02.- Diego Valdera 10/04/2019 continuacion de metodo para lugar
 */
class TiempoAsistenciaParticipante{
    private $objPdo;
	function __construct(){
			$this->objPdo = new Conexion(1);
	}

  public function registrarAsistenciaUsuario($id_participante_evento, $fecha_tiempo_asistencia_participante, $hora_tiempo_asistencia_participante, $id_sesion_registro_aud){
        $sql="INSERT INTO sea.tiempo_asistencia_participante(fecha_tiempo_asistencia_participante,             hora_tiempo_asistencia_participante, id_participante_evento, id_sesion_registro_aud, fecha_registro_aud, id_sesion_update_aud, fecha_update_aud) VALUES (:fecha_tiempo_asistencia_participante, :hora_tiempo_asistencia_participante, :id_participante_evento, :id_sesion_registro_aud, NOW(), NULL, NULL)";
        $stmt = $this->objPdo->prepare($sql);
        $stmt->execute(array(   'id_participante_evento' =>$id_participante_evento,
                                'fecha_tiempo_asistencia_participante' =>$fecha_tiempo_asistencia_participante,
                                'hora_tiempo_asistencia_participante' =>$hora_tiempo_asistencia_participante,
                                'id_sesion_registro_aud' =>$id_sesion_registro_aud
                        ));
  }
}