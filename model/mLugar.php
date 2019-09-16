<?php
require_once 'conexion.php';

class Lugar{
    private $objPdo;
	function __construct(){
			$this->objPdo = new Conexion(1);
	}
 public function listarLugaresActivos() {
            $sentence = $this->objPdo->prepare("SELECT * FROM sea.lugar l WHERE l.estado_lugar LIKE 'A'");
            $sentence->execute();
            $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
    }
	public function registrarLugar($nombre_lugar,$ubicacion_lugar,$referencia_lugar, $id_sesion_registro_aud){
        $sql="INSERT INTO sea.lugar(nombre_lugar, ubicacion_lugar, referencia_lugar, latitud_lugar, longitud_lugar, estado_lugar, id_sesion_registro_aud, fecha_registro_aud, id_sesion_update_aud, fecha_update_aud)VALUES (:nombre_lugar, :ubicacion_lugar, :referencia_lugar, NULL, NULL, 'A', :id_sesion_registro_aud, NOW(), NULL, NULL)";
        $sentence = $this->objPdo->prepare($sql);
        $resultado=$sentence->execute(array('nombre_lugar' =>$nombre_lugar,
                                'ubicacion_lugar' =>$ubicacion_lugar,
                                'referencia_lugar' =>$referencia_lugar,
                                'id_sesion_registro_aud' =>$id_sesion_registro_aud
                        ));
       return $resultado;
	} 
    
    public function actualizarLugar($nombre_lugar, $ubicacion_lugar, $referencia_lugar, $id_lugar, $id_sesion_update_aud){
        $sql='UPDATE sea.lugar SET nombre_lugar = :nombre_lugar, ubicacion_lugar = :ubicacion_lugar, referencia_lugar = :referencia_lugar, id_sesion_update_aud = :id_sesion_update_aud, fecha_update_aud = NOW()  WHERE id_lugar = :id_lugar';
        $sentence=$this->objPdo->prepare($sql);
        $resultado=$sentence->execute(array(   'nombre_lugar'=> $nombre_lugar,
                                'ubicacion_lugar'=> $ubicacion_lugar,
                                'referencia_lugar'=> $referencia_lugar,
                                'id_lugar'=> $id_lugar,
                                'id_sesion_update_aud'=> $id_sesion_update_aud
                            ));
        return  $resultado;
    }     
    public function consultarLugar() {
            $sentence = $this->objPdo->prepare("SELECT id_lugar, nombre_lugar, ubicacion_lugar, referencia_lugar FROM sea.lugar WHERE estado_lugar LIKE 'A'");
       		$sentence->execute();
        	$resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
       		return $resultado;
    }
    public function consultarLugarById($id_lugar) {
        $sentence = $this->objPdo->prepare("SELECT * FROM sea.lugar WHERE id_lugar = :id_lugar and estado_lugar LIKE 'A'");
        $sentence->execute(array('id_lugar' => $id_lugar));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0];
    }
    public function eliminarLugar($id_lugar, $estado_lugar, $id_sesion_update_aud){
        $sql='UPDATE sea.lugar SET estado_lugar = :estado_lugar, id_sesion_update_aud = :id_sesion_update_aud, fecha_update_aud = NOW()  WHERE id_lugar = :id_lugar';
        $sentence=$this->objPdo->prepare($sql);
        $resultado=$sentence->execute(array(   'estado_lugar'=> $estado_lugar,
                                'id_lugar'=> $id_lugar,
                                'id_sesion_update_aud'=> $id_sesion_update_aud
                            ));
        return $resultado;
    }
}