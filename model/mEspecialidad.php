<?php

require_once 'conexion.php';

class Especialidad {

    private $objPdo;

    public function __construct() {

        $this->objPdo = new Conexion(1);
    }

 
    public function listarEspecialidades(){
        $sentence=$this->objPdo->prepare("SELECT * FROM sea.especialidad;");
        $sentence->execute();
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    public function listarEspecialidadesxEstado($estado){
        $sentence=$this->objPdo->prepare("SELECT * FROM sea.especialidad e WHERE e.estado_especialidad = :estado;");
        $sentence->execute(array(
                                'estado' => $estado, 
                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    //porfa vean que la identacion esta presente, dentro de public esta $sentence
    //y termina con el return 

    public function listarEspecialidadesEvento($id_evento){
        $sentence = $this->objPdo->prepare("SELECT * FROM sea.especialidad_evento ee INNER JOIN sea.especialidad e on ee.id_especialidad = e.id_especialidad WHERE ee.id_evento = :id_evento;");
        $sentence->execute(array('id_evento' => $id_evento ));
        $respuesta = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }


    public function obtenerEspecialidadxId($id_especialidad){ // aqui el que hace el modelo tiene libertad para llamarlo como quiera, pero es recomendable que sea con e nombre igual al de las columnas de la tabla.
        $sentence = $this->objPdo->prepare("SELECT * FROM sea.especialidad e WHERE e.id_especialidad = :id_especialidad");
        $sentence->execute(array(
                                'id_especialidad' => $id_especialidad, 
                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0];        
    }


    public function registrarEspecialidad($nombre_especialidad, $abreviatura_especialidad, $estado_especialidad, $id_sesion_registro_aud, $fecha_registro_aud){
        $sentence = $this->objPdo->prepare("INSERT INTO sea.especialidad(nombre_especialidad, abreviatura_especialidad, 
            estado_especialidad, id_sesion_registro_aud, fecha_registro_aud)
    VALUES (:nombre_especialidad, :abreviatura_especialidad, 
            :estado_especialidad, :id_sesion_registro_aud, :fecha_registro_aud);");
        $resultado = $sentence->execute(array(
                                    'nombre_especialidad' => $nombre_especialidad,
                                    'abreviatura_especialidad' => $abreviatura_especialidad,
                                    'estado_especialidad' => $estado_especialidad,                                    
                                    'id_sesion_registro_aud' => $id_sesion_registro_aud,
                                    'fecha_registro_aud' => $fecha_registro_aud,
                                    ));
        return $resultado;
    } 

}