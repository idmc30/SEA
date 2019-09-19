<?php
require_once 'conexion.php';

class ControlAsistencia{
    private $objPdo;
    function __construct(){
        $this->objPdo = new Conexion(1);
        $this->objMysl = new Conexion(3);
    }
    public function eliminarAsistencia($asist_id, $id_session_update_aud){
      $sentence = $this->objPdo->prepare("UPDATE sea.asistencias SET estado_asistencia = 'I', fecha_update_aud = NOW(), id_session_update_aud = :id_session_update_aud WHERE asist_id = :asist_id");
      $resultado = $sentence->execute(array('asist_id' => $asist_id, 'id_session_update_aud' => $id_session_update_aud,
      ));
      return $resultado;
    }

    public function listarPermisos($id_asistencia){
      $stmt = $this->objPdo->prepare("SELECT * FROM sea.permiso WHERE id_asistencia = :id_asistencia");
      $stmt->execute(array('id_asistencia' => $id_asistencia ));
      $listaParticipantes = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $listaParticipantes;
    }

    public function consultarPersonalByDNI($dni){
      $stmt = $this->objMysl->prepare("SELECT persona_id FROM personal where dni like :dni");
      $stmt->execute(array('dni' => $dni ));
      $personal = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $personal[0]->persona_id;
    }

    public function listarParticipantes($evento_id){
      $stmt = $this->objPdo->prepare("SELECT u.dni_usuario, u.id_usuario, p.nombre_persona, p.ape_paterno, p.ape_materno, a.hora_entrada_asistencia, a.hora_salida_asistencia, a.asist_id, ep.evento_id FROM sea.asistencias a INNER JOIN sea.evento_participantes ep ON ep.evpar_id = a.evpart_id INNER JOIN sea.usuario u ON u.id_usuario = ep.id_usuario INNER JOIN sea.persona p ON p.id_persona = u.id_persona WHERE a.evento_id = :evento_id AND a.estado_asistencia not like 'I'");
      $stmt->execute(array('evento_id' => $evento_id ));
      $listaParticipantes = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $listaParticipantes;
    }

    public function listarParticipantesByDNI($evento_id, $dni_usuario){
      $stmt = $this->objPdo->prepare("SELECT u.dni_usuario, u.id_usuario, p.nombre_persona, p.ape_paterno, p.ape_materno, a.hora_entrada_asistencia, a.hora_salida_asistencia, a.asist_id, ep.evento_id FROM sea.asistencias a INNER JOIN sea.evento_participantes ep ON ep.evpar_id = a.evpart_id INNER JOIN sea.usuario u ON u.id_usuario = ep.id_usuario INNER JOIN sea.persona p ON p.id_persona = u.id_persona WHERE a.evento_id = :evento_id AND a.estado_asistencia not like 'I' AND u.dni_usuario like :dni_usuario");
      $stmt->execute(array('evento_id' => $evento_id, 'dni_usuario' => $dni_usuario ));
      $listaParticipantesDNI = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $listaParticipantesDNI;
    }

    public function listaInscritosEvento($evento_id){
      $stmt = $this->objPdo->prepare("SELECT p.ape_paterno, p.ape_materno, p.nombre_persona, p.dni_persona, to_char( fecha_entrada_asistencia, 'DD-MM-YYYY') as fecha_asistencia ,a.hora_entrada_asistencia, a.hora_salida_asistencia, a.asist_id, a.evento_id, a.tipo_asistente, ep.evpar_certificado 
      FROM sea.evento_participantes ep 
      INNER JOIN sea.usuario u on u.id_usuario = ep.id_usuario
      INNER JOIN sea.persona p on p.id_persona = u.id_persona 
      INNER JOIN sea.asistencias a on a.evpart_id = ep.evpar_id WHERE ep.evento_id =:evento_id AND ep.evpar_estado LIKE 'A' AND ep.tipopar_id = 3");
      $stmt->execute(array('evento_id' => $evento_id ));
      $listaInscritos = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $listaInscritos;
    }

    public function listaRepresentanteEvento($evento_id){
      $stmt = $this->objPdo->prepare("SELECT p.ape_paterno, p.ape_materno, p.nombre_persona, p.dni_persona, a.hora_entrada_asistencia, a.hora_salida_asistencia, a.asist_id, a.evento_id, a.tipo_asistente, ep.evpar_certificado FROM sea.evento_participantes ep INNER JOIN sea.usuario u on u.id_usuario = ep.id_usuario INNER JOIN sea.persona p on p.id_persona = u.id_persona INNER JOIN sea.asistencias a on a.evpart_id = ep.evpar_id WHERE ep.evento_id = :evento_id AND ep.evpar_estado LIKE 'A' AND ep.tipopar_id = 1");
      $stmt->execute(array('evento_id' => $evento_id ));
      $listaInscritos = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $listaInscritos;
    }

    public function registrarAsistenciaEntrada($evpart_id, $evento_id, $tipo_asistente, $id_session_registro_aud){
        $sentence = $this->objPdo->prepare("INSERT INTO sea.asistencias(evpart_id, estado_asistencia, fecha_entrada_asistencia, hora_entrada_asistencia, fecha_registro_aud, fecha_update_aud, fecha_salida_asistencia, hora_salida_asistencia, id_session_registro_aud, id_session_update_aud, evento_id, tipo_asistente) VALUES (:evpart_id, 'E', NOW(), NOW(), NOW(), NULL, NULL, NULL, :id_session_registro_aud, NULL, :evento_id, :tipo_asistente)");
        $resultado = $sentence->execute(array('evpart_id' => $evpart_id, 'id_session_registro_aud' => $id_session_registro_aud, 'evento_id' => $evento_id, 'tipo_asistente' => $tipo_asistente 
        ));
        return $resultado;
    }

    public function registrarAsistenciaSalida($asist_id, $id_session_update_aud){
        $sentence = $this->objPdo->prepare("UPDATE sea.asistencias SET estado_asistencia = 'S', fecha_update_aud = NOW(), fecha_salida_asistencia = NOW(), hora_salida_asistencia = NOW(), id_session_update_aud = :id_session_update_aud WHERE asist_id = :asist_id");
        $resultado = $sentence->execute(array('asist_id' => $asist_id, 'id_session_update_aud' => $id_session_update_aud,
        ));
        return $resultado;
    }

    public function validarAperturaByRepresentante($evpart_id){
      $stmt = $this->objPdo->prepare("SELECT evpart_id, estado_asistencia FROM sea.asistencias WHERE evpart_id = :evpart_id");
      $stmt->execute(array('evpart_id' => $evpart_id ));
      $representante = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $representante[0];
    }

    public function consultarEntradaById($evpart_id){
      $stmt = $this->objPdo->prepare("SELECT asist_id FROM sea.asistencias WHERE evpart_id = :evpart_id AND estado_asistencia LIKE 'E'");
      $stmt->execute(array('evpart_id' => $evpart_id ));
      $asistemteEntrada = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $asistemteEntrada[0]->asist_id;
    }

    public function consultarSalidaById($evpart_id){
      $stmt = $this->objPdo->prepare("SELECT asist_id FROM sea.asistencias WHERE evpart_id = :evpart_id AND estado_asistencia LIKE 'S'");
      $stmt->execute(array('evpart_id' => $evpart_id ));
      $asistemteEntrada = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $asistemteEntrada[0]->asist_id;
    }

    public function consultarPermiso($id_permiso){
      $stmt = $this->objPdo->prepare("SELECT * FROM sea.permiso WHERE id_permiso = :id_permiso AND estado_permiso_salida LIKE 'S' AND estado_permiso_entrada IS NULL");
      $stmt->execute(array('id_permiso' => $id_permiso));
      $permisoSalida = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $permisoSalida[0];
    }

    public function consultarPermisoEntrada($id_permiso){
      $stmt = $this->objPdo->prepare("SELECT * FROM sea.permiso WHERE id_permiso = :id_permiso AND estado_permiso_entrada LIKE 'E' AND estado_permiso_salida like 'S'");
      $stmt->execute(array('id_permiso' => $id_permiso ));
      $permisoSalida = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $permisoSalida[0]->id_permiso;
    }

    public function ultimoPermiso($id_asistencia){
      $stmt = $this->objPdo->prepare("SELECT id_permiso FROM sea.permiso WHERE id_asistencia = :id_asistencia ORDER BY id_permiso DESC LIMIT 1");
      $stmt->execute(array('id_asistencia' => $id_asistencia ));
      $permisoSalida = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $permisoSalida[0]->id_permiso;
    }

    public function consultarPermisoSalida($id_asistencia){
      $stmt = $this->objPdo->prepare("SELECT * FROM sea.permiso WHERE id_asistencia = :id_asistencia AND estado_permiso LIKE 'S' ORDER BY cantidad_permisos");
      $stmt->execute(array('id_asistencia' => $id_asistencia ));
      $permisoSalida = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $permisoSalida[0];
    }

    public function consultarPermisoAsistentes($id_asistencia){
      $stmt = $this->objPdo->prepare("SELECT COUNT(*) AS permisos FROM sea.permiso WHERE id_asistencia = :id_asistencia");
      $stmt->execute(array('id_asistencia' => $id_asistencia ));
      $permisoSalida = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $permisoSalida[0]->permisos;
    }

    public function registrarPermisoSalida($id_asistencia, $id_session_registro_aud){
        $sentence = $this->objPdo->prepare("INSERT INTO sea.permiso(fecha_salida_permiso, hora_salida_permiso, fecha_entrada_permiso, hora_entrada_permiso, id_asistencia, id_session_registro_aud, fecha_registro_aud, id_session_update_aud, fecha_update_aud, estado_permiso_entrada, estado_permiso_salida) VALUES (NOW(), NOW(), NULL, NULL, :id_asistencia, :id_session_registro_aud, NOW(), NULL, NULL, NULL, 'S')");
        $resultado = $sentence->execute(array('id_asistencia' => $id_asistencia, 'id_session_registro_aud' => $id_session_registro_aud));
        return $resultado;
    }

    public function registrarPermisoEntrada($id_asistencia, $id_session_update_aud){
        $sentence = $this->objPdo->prepare("UPDATE sea.permiso SET fecha_entrada_permiso = NOW(), hora_entrada_permiso = NOW(), id_session_update_aud = :id_session_update_aud, fecha_update_aud = NOW(), estado_permiso_entrada = 'E' WHERE id_asistencia = :id_asistencia AND estado_permiso_salida like 'S' AND estado_permiso_entrada IS NULL");
        $resultado = $sentence->execute(array('id_asistencia' => $id_asistencia, 'id_session_update_aud' => $id_session_update_aud ));
        return $resultado;
    }
    
    public function listarDetalleAsistenciaInicio($nombreTipoPersona) {
        $stmt = $this->objPdo->prepare("SELECT p.ape_paterno || ' ' || p.ape_materno || ' ' || p.nombre_persona  as persona,nombre_tipo_persona,p.dni_persona,
          ppe.nombre_perfil_participante_evento,to_char(tap.fecha_tiempo_asistencia_participante,'DD/MM/YYYY') as fecha_tiempo_asistencia_participante,
          tap.hora_tiempo_asistencia_participante,estado_asistencia,e.id_evento,pe.certificado_participante_evento
          FROM sea.participante_evento pe
          INNER JOIN sea.perfil_participante_evento ppe ON pe.id_perfil_participante_evento=ppe.id_perfil_participante_evento
          INNER JOIN sea.evento e ON pe.id_evento=e.id_evento
          INNER JOIN sea.usuario u ON pe.id_usuario=u.id_usuario
          INNER JOIN sea.persona p ON u.id_persona=p.id_persona
          INNER JOIN sea.tipo_persona tp ON p.id_tipo_persona=tp.id_tipo_persona
          INNER JOIN sea.tiempo_asistencia_participante tap ON tap.id_participante_evento=pe.id_participante_evento
          WHERE nombre_tipo_persona LIKE :nombreTipoPersona AND estado_asistencia like 'A' ");
        $stmt->execute( array(
                            'nombreTipoPersona'=>$nombreTipoPersona,
                        ));
        $ldetalleasistencia = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $ldetalleasistencia;
    }

    public function listarDetalleAsistencia($idEvento,$nombreTipoPersona) {
        $stmt = $this->objPdo->prepare("SELECT p.ape_paterno || ' ' || p.ape_materno || ' ' || p.nombre_persona  as persona,nombre_tipo_persona,p.dni_persona,
          ppe.nombre_perfil_participante_evento,to_char(tap.fecha_tiempo_asistencia_participante,'DD/MM/YYYY') as fecha_tiempo_asistencia_participante,
          tap.hora_tiempo_asistencia_participante,estado_asistencia,e.id_evento,pe.certificado_participante_evento
          FROM sea.participante_evento pe
          INNER JOIN sea.perfil_participante_evento ppe ON pe.id_perfil_participante_evento=ppe.id_perfil_participante_evento
          INNER JOIN sea.evento e ON pe.id_evento=e.id_evento
          INNER JOIN sea.usuario u ON pe.id_usuario=u.id_usuario
          INNER JOIN sea.persona p ON u.id_persona=p.id_persona
          INNER JOIN sea.tipo_persona tp ON p.id_tipo_persona=tp.id_tipo_persona
          INNER JOIN sea.tiempo_asistencia_participante tap ON tap.id_participante_evento=pe.id_participante_evento
          WHERE nombre_tipo_persona LIKE :nombreTipoPersona AND e.id_evento=:idEvento  AND estado_asistencia like 'A' ");
        $stmt->execute( array(
                            'idEvento'=>$idEvento,
                            'nombreTipoPersona'=>$nombreTipoPersona,
                        ));
        $ldetalleasistencia = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $ldetalleasistencia;
    }

    public function consultarOrganizadorByIdUsuario($id_usuario) {
        $stmt = $this->objPdo->prepare("SELECT o.id_organizador FROM sea.representante r INNER JOIN sea.organizador o ON o.id_organizador = r.id_organizador WHERE r.id_usuario = :id_usuario");
        $stmt->execute(array('id_usuario' => $id_usuario));
        $organizador = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $organizador[0]->id_organizador;
    }

}