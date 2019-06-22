<?php
/**
 * modelos de eventos idmc 30/04/2019
 */
require_once 'conexion.php';

class Evento {

    private $objPdo;

    public function __construct() {

        $this->objPdo = new Conexion(1);
    }


 /*@DVALDERA*/

  public function consultarEventoPertenece($idEvento){
    $stmt = $this->objPdo->prepare("SELECT evento_pertenece FROM sea.eventos where evento_id = :idEvento");
    $stmt->execute(array('idEvento' => $idEvento));
    $pertenece = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $pertenece[0]->evento_pertenece;
  }

 public function cantidadCertificadoByID($id_usuario) {
    $stmt = $this->objPdo->prepare("SELECT COUNT(*) as certificado FROM sea.evento_participantes WHERE id_usuario = :id_usuario AND evpar_certificado is TRUE");
    $stmt->execute(array('id_usuario' => $id_usuario));
    $certificado = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $certificado[0];
}

public function cantidadAsistenciaByID($id_usuario) {
    $stmt = $this->objPdo->prepare("SELECT COUNT(*) as asistencia FROM sea.evento_participantes ep INNER JOIN sea.asistencias a on a.evpart_id = ep.evpar_id WHERE ep.id_usuario = :id_usuario AND a.estado_asistencia LIKE 'E' OR a.estado_asistencia LIKE 'S'");
    $stmt->execute(array('id_usuario' => $id_usuario));
    $asistencia = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $asistencia[0];
}

public function consultarParticipanteByID($id_usuario) {
    $stmt = $this->objPdo->prepare("SELECT * from sea.evento_participantes ep INNER JOIN sea.eventos e ON e.evento_id = ep.evento_id INNER JOIN sea.usuario u ON u.id_usuario = ep.id_usuario WHERE ep.evpar_estado LIKE 'A' AND ep.id_usuario = :id_usuario");
    $stmt->execute(array('id_usuario' => $id_usuario));
    $participanteEvento = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $participanteEvento;
}

public function listarEventosActivos() {
    $stmt = $this->objPdo->prepare("SELECT * FROM sea.eventos WHERE evento_estado IN (1,2,4)");
    $stmt->execute();
    $eventoActivo = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $eventoActivo;
}

public function consultarAsistenteByDNI($dni, $idEvento) {
    $stmt = $this->objPdo->prepare("SELECT evpar_id FROM sea.evento_participantes ep INNER JOIN sea.usuario u ON u.id_usuario = ep.id_usuario WHERE ep.evento_id = :idEvento AND ep.tipopar_id = 3 AND ep.evpar_estado LIKE 'A' AND u.dni_usuario LIKE :dni");
    $stmt->execute(array( 'dni' => $dni, 'idEvento' => $idEvento ));
    $asistente = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $asistente[0]->evpar_id;
}

public function consultarEveParById($idEvento) {
    $stmt = $this->objPdo->prepare("SELECT evpar_id FROM sea.evento_participantes ep INNER JOIN sea.usuario u ON u.id_usuario = ep.id_usuario WHERE ep.evento_id = :idEvento AND ep.tipopar_id = 1 AND ep.evpar_estado LIKE 'A'");
    $stmt->execute(array('idEvento' => $idEvento ));
    $evePar = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $evePar[0]->evpar_id;
}

public function consultarRepresentanteByDNI($dni, $idEvento) {
    $stmt = $this->objPdo->prepare("SELECT evpar_id FROM sea.evento_participantes ep INNER JOIN sea.usuario u ON u.id_usuario = ep.id_usuario WHERE ep.evento_id = :idEvento AND ep.tipopar_id = 1 AND ep.evpar_estado LIKE 'A' AND u.dni_usuario LIKE :dni");
    $stmt->execute(array( 'dni' => $dni, 'idEvento' => $idEvento ));
    $representante = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $representante[0]->evpar_id;
}

public function consultarNombreLugar($id_lugar) {
    $stmt = $this->objPdo->prepare("SELECT nombre_lugar FROM sea.lugar where estado_lugar like 'A' and id_lugar = :id_lugar");
    $stmt->execute(array( 'id_lugar' => $id_lugar ));
    $lugar = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $lugar[0]->nombre_lugar;
}

public function consultarUsuarioByIDEvento($id_evento) {
    $stmt = $this->objPdo->prepare("SELECT id_usuario FROM sea.evento_participantes WHERE evento_id = :id_evento AND tipopar_id = 2 AND evpar_estado LIKE 'A' GROUP BY id_usuario");
    $stmt->execute(array( 'id_evento' => $id_evento ));
    $usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $usuario[0]->id_usuario;
}

public function consultarNombrePonente($id_usuario) {
    $stmt = $this->objPdo->prepare("SELECT p.nombre_persona, p.ape_paterno, p.ape_materno FROM sea.usuario u INNER JOIN sea.persona p ON u.id_persona = p.id_persona WHERE u.id_usuario = :id_usuario");
    $stmt->execute(array( 'id_usuario' => $id_usuario ));
    $ponente = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $ponente[0];
}

public function consultarEventoDiplomadoById($id_evento) {
    $stmt = $this->objPdo->prepare("SELECT e.id_tipo_evento, te.nombre_tipo_evento FROM sea.evento e INNER JOIN sea.tipo_evento te on te.id_tipo_evento = e.id_tipo_evento WHERE e.id_evento = :id_evento");
    $stmt->execute(array( 'id_evento' => $id_evento ));
    $diplomado = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $diplomado[0];
}

public function registrarHoraInicioControByIdOrganizador($id_organizador, $id_sesion_update_aud){
    $sentence = $this->objPdo->prepare("UPDATE sea.evento SET hora_inicio_control = NOW(), id_sesion_update_aud = :id_sesion_update_aud, fecha_update_aud = NOW() WHERE id_organizador = :id_organizador");
    $resultado = $sentence->execute(array('id_organizador' => $id_organizador, 'id_sesion_update_aud' => $id_sesion_update_aud));
    return $resultado;
}

public function registrarHoraFinalByIdOrganizador($id_organizador, $hora_final_evento, $id_sesion_update_aud){
    $sentence = $this->objPdo->prepare("UPDATE sea.evento SET hora_final_evento = :hora_final_evento, id_sesion_update_aud = :id_sesion_update_aud, fecha_update_aud = NOW() WHERE id_organizador = :id_organizador");
    $resultado = $sentence->execute(array('id_organizador' => $id_organizador, 'hora_final_evento' => $hora_final_evento, 'id_sesion_update_aud' => $id_sesion_update_aud));
    return $resultado;
}

public function reprogramarEvento($evento_id, $evento_fecha_inicio, $evento_fecha_final, $evento_hora_inicio, $comentario_evento, $id_sesion_update_aud){
    $sentence = $this->objPdo->prepare("UPDATE sea.eventos SET evento_estado = 4, evento_fecha_reprogramacion = :evento_fecha_inicio, evento_hora_reprogramacion = :evento_hora_inicio, evento_comentario = :comentario_evento, id_sesion_update_aud = :id_sesion_update_aud, fecha_update_aud = NOW(), evento_fecha_reprogramacion_final = :evento_fecha_final WHERE evento_id = :evento_id");
    $resultado = $sentence->execute(array('evento_id' => $evento_id, 'evento_fecha_inicio' => $evento_fecha_inicio, 'evento_fecha_final' => $evento_fecha_final, 'evento_hora_inicio' => $evento_hora_inicio, 'comentario_evento' => $comentario_evento, 'id_sesion_update_aud' => $id_sesion_update_aud));
    return $resultado;
}

public function cancelarEvento($evento_id, $evento_comentario, $id_sesion_update_aud){
    $sentence = $this->objPdo->prepare("UPDATE sea.eventos SET evento_estado = 5, evento_comentario = :evento_comentario, id_sesion_update_aud = :id_sesion_update_aud, fecha_update_aud = NOW() WHERE evento_id = :evento_id");
    $resultado = $sentence->execute(array('evento_comentario' => $evento_comentario, 'evento_id' => $evento_id, 'id_sesion_update_aud' => $id_sesion_update_aud));
    return $resultado;
}

public function consultarEventoByID($evento_id) {
    $stmt = $this->objPdo->prepare("SELECT * FROM sea.eventos WHERE evento_id = :evento_id");
    $stmt->execute(array('evento_id' => $evento_id ));
    $evento = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $evento[0];
}
/*@DVALDERA*/

/**
 * @idmc
 */

 //update evento al que pertenece 27/05/2019
 
 public function updateEventoPertenece($eventopertenece,$idEvento) {
    $stmt = $this->objPdo->prepare("UPDATE sea.eventos  SET  evento_pertenece=:eventopertenece   WHERE evento_id=:idEvento ");
    $stmt->execute(array(
                              'eventopertenece'=>$eventopertenece,    
                              'idEvento'=>$idEvento
                  ));
    $update = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $update;
}
    
/**
 * 09/05/2019 cambiar de estado a  eventos  puede ser eliminado o cancelado o reprogramado
 */
public function eliminarEvento($estadoEvento,$idEvento) {
    $stmt = $this->objPdo->prepare("UPDATE sea.eventos SET  evento_estado=:estadoEvento WHERE evento_id=:idEvento");
    $stmt->execute(array(
                              'estadoEvento'=>$estadoEvento,    
                              'idEvento'=>$idEvento
                  ));
    $update = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $update;
}

/**
 * 09/05/2019 idmc listado de eventos hijos por evento 
 */
    public function listarItemsxEvento($idEvento) {
        $stmt = $this->objPdo->prepare("SELECT*FROM sea.eventos e
        INNER JOIN sea.evento_estados  ev ON e.evento_estado=ev.evento_estado_id
        INNER JOIN sea.evento_tipos  te on e.tipo_evento_id=te.evento_tipo_id
        WHERE  es_padre is false and evento_estado_nombre in ('ACTIVO','REPROGRAMADO','GENERADO') AND id_padre=:idEvento");
        $stmt->execute(array(
                              'idEvento'=>$idEvento
                      ));
        $lItems = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $lItems;
    }



    /**
     * 07/05/2018 listado de mis eventos
     */ 
    public function listarMisEventos($idUsuario) {
        $stmt = $this->objPdo->prepare("SELECT*FROM sea.evento_participantes pe
        INNER JOIN sea.eventos e ON pe.evento_id=e.evento_id
        INNER JOIN sea.evento_tipos te ON e.tipo_evento_id= te.evento_tipo_id
        INNER JOIN sea.evento_estados ee ON e.evento_estado=ee.evento_estado_id
        INNER JOIN sea.lugar l on e.lugar_id=l.id_lugar
        WHERE pe.id_usuario=:idUsuario AND evento_estado_nombre in ('ACTIVO','REPROGRAMADO','GENERADO') and pe.evpar_estado='A'
        ORDER BY  evpar_id DESC");
        $stmt->execute(array(
                              'idUsuario'=>$idUsuario
                      ));
        $lmisevento = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $lmisevento;
    }


    /**
     * 07/05/2018 idmc busqueda de eventos en el listado de vista de inicio
     */
    public function buscarEventos($inicio,$search) {
        $stmt = $this->objPdo->prepare("SELECT*FROM sea.eventos e
        INNER JOIN sea.evento_estados  ev ON e.evento_estado=ev.evento_estado_id
        INNER JOIN sea.evento_tipos  te on e.tipo_evento_id=te.evento_tipo_id
        WHERE evento_nivel=1 AND evento_tipo_nombre LIKE :search
        ORDER BY e.evento_id DESC
        LIMIT 12 OFFSET :inicio;");
        $stmt->execute(array(
            'inicio' => $inicio,
            'search' => $search,
        ));
        $levento = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $levento;
    }

    /**
     * 07/05/2018 idmc listado de evento en el vista de inicio de sea
     */
    public function listarEventosInicio($inicio) {
        $stmt = $this->objPdo->prepare("SELECT*FROM sea.eventos e
        INNER JOIN sea.evento_estados  ev ON e.evento_estado=ev.evento_estado_id
        INNER JOIN sea.evento_tipos  te on e.tipo_evento_id=te.evento_tipo_id
        WHERE evento_nivel=1 AND evento_estado_nombre in ('ACTIVO','REPROGRAMADO','GENERADO')
        ORDER BY evento_id DESC  LIMIT 12 OFFSET :inicio;");
        $stmt->execute(array(
            'inicio' => $inicio
        ));
        $levento = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $levento;
    }
    /**
     * 06/05/2019 idmc listado de eventos en portada con limit 
     */
    public function listarEventoPortada(){
        $sentence=$this->objPdo->prepare("SELECT*FROM sea.eventos e
        INNER JOIN sea.evento_estados ees ON e.evento_estado=ees.evento_estado_id 
        INNER JOIN sea.evento_tipos et ON e.tipo_evento_id=et.evento_tipo_id 
        WHERE evento_nivel=1 AND evento_estado_nombre in ('GENERADO','REPROGRAMADO','EN CURSO')
        ORDER BY evento_id DESC LIMIT 10 ");
        $sentence->execute();
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    public function consultarEstadoCerficadoxEvento($id_evento) {
        $stmt = $this->objPdo->prepare("SELECT evento_certificado FROM sea.eventos WHERE evento_id = :id_evento");
        $stmt->execute(array('id_evento' => $id_evento ));
        $evento = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $evento[0];
        }
       
        
    public function obtenerIdEventoxDetalle($eventonombre, $id_sesion_registro_aud, $fecha_registro_aud){ 
      $sentence = $this->objPdo->prepare("SELECT evento_id FROM sea.eventos e WHERE 
                                         e.evento_nombre=:eventonombre AND 
                                          e.id_sesion_registro_aud = :id_sesion_registro_aud AND e.fecha_registro_aud=:fecha_registro_aud");
      $sentence->execute(array(
                              'eventonombre' => $eventonombre, 
                              'id_sesion_registro_aud' => $id_sesion_registro_aud, 
                              'fecha_registro_aud' => $fecha_registro_aud, 
                          ));
      $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
      return $resultado[0]->evento_id;        
  }

    public function listarEventosxFecha($fecha_inicial, $fecha_final) {
        $sentence = $this->objPdo->prepare("SELECT * FROM sea.eventos e 
            INNER JOIN sea.evento_estados ee ON e.evento_estado = ee.evento_estado_id
            INNER JOIN sea.evento_tipos et ON e.tipo_evento_id =et.evento_tipo_id
            WHERE e.evento_fecha_inicio BETWEEN :fecha_inicial and :fecha_final and e.evento_nivel=1 and e.evento_estado in (1,2,3,4,5) ORDER BY evento_id DESC");
        $sentence->execute(array(
                        'fecha_inicial' => $fecha_inicial,
                        'fecha_final' => $fecha_final
                        ));
        $respuesta = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }


    public function actualizarEvento($eventonombre,$eventodescripcion,$tipoevento_id,$espadre,$id_padre,$eventoestado,$eventofecha_inicio,$eventofecha_final,$eventohora_inicio,$eventohora_final,$eventofecha_reprogramacion,$eventohora_reprogramacion,$evento_certificado,$eventocomentario,$lugarid,$idsesion_update_aud,$fechaupdate_aud,$costo_certificado_publico,$eventohorainicio_control,$evento_id){
      $sql='UPDATE sea.eventos
      SET  evento_nombre=:eventonombre, evento_descripcion=:eventodescripcion, tipo_evento_id=:tipoevento_id, 
          es_padre=:espadre, id_padre=:id_padre, evento_estado=:eventoestado, evento_fecha_inicio=:eventofecha_inicio, 
          evento_fecha_final=:eventofecha_final, evento_hora_inicio=:eventohora_inicio, evento_hora_final=:eventohora_final, 
          evento_fecha_reprogramacion=:eventofecha_reprogramacion, evento_hora_reprogramacion=:eventohora_reprogramacion, 
          evento_certificado=:evento_certificado, evento_comentario=:eventocomentario, lugar_id=:lugarid, id_sesion_update_aud=:idsesion_update_aud, 
          fecha_update_aud=:fechaupdate_aud, costo_certificado_publico=:costo_certificado_publico, evento_hora_inicio_control=:eventohorainicio_control
    WHERE evento_id=:evento_id';
      $sentence=$this->objPdo->prepare($sql);
      $resultado=$sentence->execute(array(   
                              'eventonombre'=> $eventonombre,
                              'eventodescripcion'=> $eventodescripcion,
                              'tipoevento_id'=> $tipoevento_id,
                              'espadre'=> $espadre,
                              'id_padre'=> $id_padre,
                              'eventoestado'=> $eventoestado,
                              'eventofecha_inicio'=> $eventofecha_inicio,
                              'eventofecha_final'=> $eventofecha_final,
                              'eventohora_inicio'=> $eventohora_inicio,
                              'eventohora_final'=> $eventohora_final,
                              'eventofecha_reprogramacion'=> $eventofecha_reprogramacion,
                              'eventohora_reprogramacion'=> $eventohora_reprogramacion,
                              'evento_certificado'=> $evento_certificado,
                              'eventocomentario'=> $eventocomentario,
                              'lugarid'=> $lugarid,
                              'idsesion_update_aud'=> $idsesion_update_aud,
                              'fechaupdate_aud'=> $fechaupdate_aud,
                              'costo_certificado_publico'=> $costo_certificado_publico,
                              'eventohorainicio_control'=> $eventohorainicio_control,
                              'evento_id'=> $evento_id,
                          ));
      return $resultado;
  }     

    public function actualizarImagenEvento($eventofoto, $evento_id){
      $sql='UPDATE sea.eventos SET evento_foto=:eventofoto WHERE evento_id=:evento_id';
      $sentence=$this->objPdo->prepare($sql);
      $resultado=$sentence->execute(array(
                              'eventofoto'=> $eventofoto,
                              'evento_id'=> $evento_id,
                          ));
      return $resultado;
  } 

    public function registrarEvento($evento_nombre, $evento_descripcion, $tipo_evento_id, $es_padre, $id_padre, $evento_estado, $evento_fecha_inicio, $evento_fecha_final, $evento_hora_inicio, $evento_hora_final, $evento_foto, $evento_fecha_reprogramacion, $evento_hora_reprogramacion, $evento_certificado, $evento_comentario, $lugar_id, $id_sesion_registro_aud, $fecha_registro_aud, $costo_certificado_publico, $evento_hora_inicio_control, $evento_nivel,$evento_pertenece){
      $sentence = $this->objPdo->prepare("INSERT INTO sea.eventos(evento_nombre, evento_descripcion, tipo_evento_id,es_padre, id_padre, evento_estado, evento_fecha_inicio, evento_fecha_final, 
      evento_hora_inicio, evento_hora_final, evento_foto, evento_fecha_reprogramacion, 
      evento_hora_reprogramacion, evento_certificado, evento_comentario, 
      lugar_id, id_sesion_registro_aud, fecha_registro_aud,costo_certificado_publico, evento_hora_inicio_control, evento_nivel,evento_pertenece)
      VALUES ( :evento_nombre, :evento_descripcion, :tipo_evento_id, :es_padre, :id_padre, :evento_estado, :evento_fecha_inicio, :evento_fecha_final, :evento_hora_inicio, :evento_hora_final, :evento_foto, :evento_fecha_reprogramacion, :evento_hora_reprogramacion, :evento_certificado, :evento_comentario, :lugar_id, :id_sesion_registro_aud, :fecha_registro_aud, :costo_certificado_publico, :evento_hora_inicio_control, :evento_nivel,:evento_pertenece);");
      $resultado = $sentence->execute(array(
                                  'evento_nombre' => $evento_nombre,
                                  'evento_descripcion' => $evento_descripcion,
                                  'tipo_evento_id' => $tipo_evento_id,   
                                  'es_padre' => $es_padre,
                                  'id_padre' => $id_padre,
                                  'evento_estado' => $evento_estado,
                                  'evento_fecha_inicio' => $evento_fecha_inicio,
                                  'evento_fecha_final' => $evento_fecha_final,
                                  'evento_hora_inicio' => $evento_hora_inicio,
                                  'evento_hora_final' => $evento_hora_final,
                                  'evento_foto' => $evento_foto,
                                  'evento_fecha_reprogramacion' => $evento_fecha_reprogramacion,
                                  'evento_hora_reprogramacion' => $evento_hora_reprogramacion,
                                  'evento_certificado' => $evento_certificado,
                                  'evento_comentario' => $evento_comentario,
                                  'lugar_id' => $lugar_id,
                                  'id_sesion_registro_aud' => $id_sesion_registro_aud,
                                  'fecha_registro_aud' => $fecha_registro_aud,
                                  'costo_certificado_publico' => $costo_certificado_publico,
                                  'evento_hora_inicio_control' => $evento_hora_inicio_control,
                                  'evento_nivel' => $evento_nivel,
                                  'evento_pertenece' => $evento_pertenece,
                                  ));
      return $resultado;
  } 
 
    public function registrarEventoEspecialidad($id_evento, $id_especialidad, $id_sesion_registro_aud, $fecha_registro_aud){
        $sentence = $this->objPdo->prepare("INSERT INTO sea.especialidad_evento(
            id_evento, id_especialidad, id_sesion_registro_aud, fecha_registro_aud)
            VALUES (:id_evento, :id_especialidad, :id_sesion_registro_aud, :fecha_registro_aud);");
        $resultado = $sentence->execute(array(
                            'id_evento' => $id_evento,
                            'id_especialidad' => $id_especialidad,
                            'id_sesion_registro_aud' => $id_sesion_registro_aud,
                            'fecha_registro_aud' => $fecha_registro_aud,

        ));
        return $resultado;
    }

    public function registrarEventoPobjectivo($id_evento, $id_pobjetivo, $id_sesion_registro_aud, $fecha_registro_aud){
        $sentence = $this->objPdo->prepare("INSERT INTO sea.evento_publico_objetivo(id_evento, id_publico_objetivo, id_sesion_registro_aud, fecha_registro_aud)
            VALUES (:id_evento, :id_pobjetivo, :id_sesion_registro_aud, :fecha_registro_aud);");
        $resultado = $sentence->execute(array(
                            'id_evento' => $id_evento,
                            'id_pobjetivo' => $id_pobjetivo,
                            'id_sesion_registro_aud' => $id_sesion_registro_aud,
                            'fecha_registro_aud' => $fecha_registro_aud,

        ));
        return $resultado;
    }

/**
 * idmc 05/05/2019 se modifico el listado de eventos por que se agregro un campo mas de nivel
 */
    public function listarEvento(){
        $sentence=$this->objPdo->prepare("SELECT*FROM sea.eventos e
        INNER JOIN sea.evento_estados ees ON e.evento_estado=ees.evento_estado_id 
        INNER JOIN sea.evento_tipos et ON e.tipo_evento_id=et.evento_tipo_id 
        WHERE --evento_nivel=1 AND 
        evento_estado_nombre in ('GENERADO','REPROGRAMADO','EN CURSO')
        ORDER BY evento_id DESC ");
        $sentence->execute();
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
  


    public function obtenerEventoxId($id_evento){ // aqui el que hace el modelo tiene libertad para llamarlo como quiera, pero es recomendable que sea con e nombre igual al de las columnas de la tabla.
        $sentence = $this->objPdo->prepare("SELECT * FROM sea.eventos e 
          LEFT JOIN sea.costo_evento ce on e.evento_id = ce.id_evento
          INNER JOIN sea.evento_tipos et on e.tipo_evento_id = et.evento_tipo_id
          LEFT JOIN sea.lugar l on e.lugar_id = l.id_lugar WHERE e.evento_id = :id_evento");
        $sentence->execute(array(
                                'id_evento' => $id_evento, 
                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0];        
    }

    public function eliminarEspecialidadesxEvento($id_evento){
        $sentence = $this->objPdo->prepare("DELETE FROM sea.especialidad_evento ee WHERE ee.id_evento = :id_evento;");
        $resultado = $sentence->execute(array(
                                    'id_evento' => $id_evento
                                    ));
        return $resultado;
    } 
    
    public function eliminarPublicoObjetivoxEvento($id_evento){
        $sentence = $this->objPdo->prepare("DELETE FROM sea.evento_publico_objetivo epob WHERE epob.id_evento = :id_evento;");
        $resultado = $sentence->execute(array(
                                    'id_evento' => $id_evento
                                    ));
        return $resultado;
    } 

}