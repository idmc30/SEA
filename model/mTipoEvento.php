<?php
require_once 'conexion.php';

class TipoEvento{
    private $objPdo;
	function __construct(){
			$this->objPdo = new Conexion(1);
  }
  
	public function registrarTipoEvento($evento_tipo_nombre,$evento_descripcion ,$id_sesion_registro_aud){
        $sql="INSERT INTO sea.evento_tipos(evento_tipo_nombre,evento_tipo_descripcion ,evento_tipo_activo,id_sesion_registro_aud, fecha_registro_aud)VALUES (:evento_tipo_nombre,:evento_descripcion ,TRUE, :id_sesion_registro_aud, NOW())";
        $sentence = $this->objPdo->prepare($sql);
        $resultado = $sentence->execute(array(   
                                'evento_tipo_nombre' =>$evento_tipo_nombre,
                                'evento_descripcion' =>$evento_descripcion,
                                'id_sesion_registro_aud' =>$id_sesion_registro_aud
                        ));
        return $resultado;
    } 


    
    public function actualizarTipoEvento($nombre_tipo_evento, $descripcion_tipo_evento, $id_tipo_evento, $id_sesion_update_aud){
        $sql='UPDATE sea.evento_tipos SET evento_tipo_nombre = :nombre_tipo_evento, evento_tipo_descripcion = :descripcion_tipo_evento, id_sesion_update_aud = :id_sesion_update_aud, fecha_update_aud = NOW() WHERE evento_tipo_id = :id_tipo_evento';
        $sentence=$this->objPdo->prepare($sql);
        $resultado=$sentence->execute(array(   'nombre_tipo_evento'=> $nombre_tipo_evento,
                                'descripcion_tipo_evento'=> $descripcion_tipo_evento,
                                'id_tipo_evento'=> $id_tipo_evento,
                                'id_sesion_update_aud'=> $id_sesion_update_aud
                            ));
        return $resultado;                    
    }   
    
      

    public function consultarTipoEvento() {
            $stmt = $this->objPdo->prepare("SELECT * FROM sea.evento_tipos WHERE evento_tipo_activo =TRUE ORDER BY evento_tipo_id DESC");
       		$stmt->execute();
        	$tipoEvento = $stmt->fetchAll(PDO::FETCH_OBJ);
       		return $tipoEvento;
    }
    public function consultarTipoEventoById($evento_tipo_id) {
        $stmt = $this->objPdo->prepare("SELECT * FROM sea.evento_tipos where evento_tipo_id = :evento_tipo_id");
        $stmt->execute(array('evento_tipo_id' => $evento_tipo_id));
        $tipoEvento = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $tipoEvento[0];
    }
    public function eliminarTipoEvento($evento_tipo_id, $estado_tipo_evento, $id_sesion_update_aud){
        $sql='UPDATE sea.evento_tipos SET evento_tipo_activo = :estado_tipo_evento, id_sesion_update_aud = :id_sesion_update_aud, fecha_update_aud = NOW() WHERE evento_tipo_id = :evento_tipo_id';
        $sentence=$this->objPdo->prepare($sql);
        $resultado=$sentence->execute(array(  
                                'estado_tipo_evento'=> $estado_tipo_evento,
                                'evento_tipo_id'=> $evento_tipo_id,
                                'id_sesion_update_aud'=> $id_sesion_update_aud
                            ));

         return $resultado;                   
    }
}