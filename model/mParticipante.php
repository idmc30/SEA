<?php
require_once 'conexion.php';

class Participante{

	private $objPdo;

	function __construct(){
		$this->objPdo = new Conexion(1);
    }

public function consultarIdParticipanteEvento($idUsuario,$idEvento) {
    $stmt = $this->objPdo->prepare("SELECT evpar_id FROM sea.evento_participantes ep
    INNER JOIN sea.usuario u ON ep.id_usuario=u.id_usuario
    WHERE ep.id_usuario=:idUsuario AND ep.evento_id=:idEvento AND evpar_estado='A'  AND estado_usuario='A' ");
    $stmt->execute(array(
                  'idUsuario' => $idUsuario,
                  'idEvento' => $idEvento
                ));
    $eventoparticipanteid = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $eventoparticipanteid[0]->evpar_id;
}

    public function eliminarParticipanteEvento($idsesionupdateaud,$idparticipanteevento) {
        $stmt = $this->objPdo->prepare("UPDATE sea.evento_participantes SET evpar_estado='I',id_sesion_update_aud=:idsesionupdateaud, fecha_update_aud=NOW() WHERE evpar_id=:idparticipanteevento;");
        $rows = $stmt->execute(array(
                                    'idsesionupdateaud' => $idsesionupdateaud,
                                    'idparticipanteevento' => $idparticipanteevento, 
                                   ));
        return $rows;
    }

    public function validarAsistencia($idUsuario,$idEvento) {
        $stmt = $this->objPdo->prepare("SELECT count(*) as total FROM sea.evento_participantes ep
        INNER JOIN sea.usuario u ON ep.id_usuario=u.id_usuario
        WHERE ep.id_usuario=:idUsuario AND ep.evento_id=:idEvento AND evpar_estado='A'  AND estado_usuario='A' ");
        $stmt->execute(array(
                      'idUsuario' => $idUsuario,
                      'idEvento' => $idEvento
                    ));
        $asistencia = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $asistencia[0]->total;
    }

    public function listarParticipantesxEvento($id_evento){
        $sentence=$this->objPdo->prepare("SELECT * from sea.evento_participantes ep 
            INNER JOIN sea.usuario u on ep.id_usuario = u.id_usuario
            INNER JOIN sea.persona p on p.id_persona=u.id_persona
            INNER JOIN sea.tipo_participante tp on tp.tipopar_id=ep.tipopar_id
            LEFT JOIN sea.organizador o on ep.id_organizador = o.id_organizador
            WHERE ep.evento_id = :id_evento AND ep.evpar_estado='A' AND p.estado_persona='A' ORDER BY evpar_id DESC ");
        $sentence->execute(array(                                
                                'id_evento' => $id_evento, 
                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function listarParticipantesxEvento2($id_evento){
        $sentence=$this->objPdo->prepare("SELECT  p.ape_paterno, p.ape_materno, p.nombre_persona, p.dni_persona, to_char( fecha_entrada_asistencia, 'DD-MM-YYYY') as fecha_asistencia ,a.hora_entrada_asistencia, a.hora_salida_asistencia, a.asist_id, a.evento_id, a.tipo_asistente, ep.evpar_certificado,tipopar_nombre from sea.evento_participantes ep 
        INNER JOIN sea.usuario u on ep.id_usuario = u.id_usuario
        INNER JOIN sea.persona p on p.id_persona=u.id_persona
        INNER JOIN sea.tipo_participante tp on tp.tipopar_id=ep.tipopar_id
                    INNER JOIN sea.asistencias a on a.evpart_id = ep.evpar_id
        LEFT JOIN sea.organizador o on ep.id_organizador = o.id_organizador
        WHERE ep.evento_id = :id_evento AND ep.evpar_estado='A' AND p.estado_persona='A' ORDER BY evpar_id DESC  ");
        $sentence->execute(array(                                
                                'id_evento' => $id_evento, 
                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    public function registrarParticipantexEvento($evento_id, $participante_id, $evpar_certificado, $evpar_fecha_registro, $id_sesion_registro_aud, $tipopar_id, $id_organizador){
        $sentence = $this->objPdo->prepare("INSERT INTO sea.evento_participantes(evento_id, id_usuario, evpar_estado, evpar_certificado, evpar_fecha_registro, id_sesion_registro_aud, fecha_registro_aud, tipopar_id, id_organizador)
        	VALUES (:evento_id, :participante_id, 'A', :evpar_certificado, :evpar_fecha_registro, :id_sesion_registro_aud, NOW(), :tipopar_id, :id_organizador);");
        $resultado = $sentence->execute(array(
                            'evento_id' => $evento_id,
                            'participante_id' => $participante_id,
                            'evpar_certificado' => $evpar_certificado,
                            'evpar_fecha_registro' => $evpar_fecha_registro,
                            'id_sesion_registro_aud' => $id_sesion_registro_aud,
                            'tipopar_id' => $tipopar_id,
                            'id_organizador' => $id_organizador,

        ));
        return $resultado;
    }

    public function listarParticipantesxTipo($evpar_tipo, $id_evento){
        $sentence=$this->objPdo->prepare("SELECT * from sea.evento_participantes ep 
            INNER JOIN sea.usuario u on ep.id_usuario = u.id_usuario
            INNER JOIN sea.organizador o on ep.id_organizador = o.id_organizador
            INNER JOIN sea.persona p on u.id_persona = p.id_persona
            WHERE ep.tipopar_id = :evpar_tipo and ep.evento_id = :id_evento;");
        $sentence->execute(array(
                                'evpar_tipo' => $evpar_tipo, 
                                'id_evento' => $id_evento, 
                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

}