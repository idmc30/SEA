<?php

require_once 'conexion.php';

class Costo {

    private $objPdo;

    public function __construct() {

        $this->objPdo = new Conexion(1);
    }

 
    public function obtenerCostoxIdEvento($id_evento){
        $sentence = $this->objPdo->prepare("SELECT * FROM sea.costo_evento ce WHERE ce.id_evento = :id_evento");
        $sentence->execute(array(
                                'id_evento' => $id_evento, 
                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0];        
    } 


    public function registrarCostos($costo_ponente_costo_evento, $costo_break_costo_evento, $costo_certificado_costo_evento, $id_evento, $id_sesion_registro_aud, $fecha_registro_aud){
        $sentence = $this->objPdo->prepare("INSERT INTO sea.costo_evento(costo_ponente_costo_evento, costo_break_costo_evento, costo_certificado_costo_evento, id_evento, id_sesion_registro_aud, fecha_registro_aud)
    VALUES (:costo_ponente_costo_evento, :costo_break_costo_evento, :costo_certificado_costo_evento, :id_evento, :id_sesion_registro_aud, :fecha_registro_aud);");
        $resultado = $sentence->execute(array(
                                    'costo_ponente_costo_evento' => $costo_ponente_costo_evento,
                                    'costo_break_costo_evento' => $costo_break_costo_evento,
                                    'costo_certificado_costo_evento' => $costo_certificado_costo_evento,                                    
                                    'id_evento' => $id_evento,
                                    'id_sesion_registro_aud' => $id_sesion_registro_aud,
                                    'fecha_registro_aud' => $fecha_registro_aud,
                                    ));
        return $resultado;
    }

    public function actualizarcostos($id_costo_evento, $costo_ponente_costo_evento, $costo_break_costo_evento, $costo_certificado_costo_evento, $id_evento, $id_sesion_update_aud, $fecha_update_aud){
        $sentence = $this->objPdo->prepare("UPDATE sea.costo_evento SET costo_ponente_costo_evento= :costo_ponente_costo_evento, costo_break_costo_evento=:costo_break_costo_evento, costo_certificado_costo_evento= :costo_certificado_costo_evento, id_evento=:id_evento, id_sesion_update_aud=:id_sesion_update_aud, fecha_update_aud=:fecha_update_aud WHERE id_costo_evento=:id_costo_evento;");
        $resultado = $sentence->execute(array(
                                    'costo_ponente_costo_evento' => $costo_ponente_costo_evento,
                                    'costo_break_costo_evento' => $costo_break_costo_evento,
                                    'costo_certificado_costo_evento' => $costo_certificado_costo_evento,                                    
                                    'id_evento' => $id_evento,
                                    'id_sesion_update_aud' => $id_sesion_update_aud,
                                    'fecha_update_aud' => $fecha_update_aud,
                                    'id_costo_evento' => $id_costo_evento,
                                    ));
        return $resultado;
    }    

}