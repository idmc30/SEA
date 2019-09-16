<?php
require_once 'conexion.php';

class Persona{
    private $objPdo;
	function __construct(){
		$this->objPdo = new Conexion(1);
    }
 


    public function insertPersona($dni_persona, $nombre_persona, $ape_paterno, $ape_materno,$sexo, $correo_persona, $telefono_persona, $anexo, $id_sesion_registro_aud){
        $sql="INSERT INTO sea.persona(dni_persona, nombre_persona, ape_paterno, ape_materno, sexo, fech_nac, direccion_persona, correo_persona, telefono_persona, profesion_persona, foto_persona, estado_persona, id_tipo_persona, id_modalidad_contractual, id_sesion_registro_aud, fecha_registro_aud, id_sesion_update_aud, fecha_update_aud, anexo) VALUES (:dni_persona, :nombre_persona, :ape_paterno, :ape_materno, :sexo, NULL, NULL, :correo_persona, :telefono_persona, NULL, NULL, 'A', 1, NULL, :id_sesion_registro_aud, NOW(), NULL, NULL, :anexo)";
        $sentence = $this->objPdo->prepare($sql);
        $resultado=$sentence->execute(array(   'dni_persona' =>$dni_persona,
                                'nombre_persona' =>$nombre_persona,
                                'ape_paterno' =>$ape_paterno,
                                'ape_materno' =>$ape_materno,
                                'sexo' =>$sexo,
                                'correo_persona' =>$correo_persona,
                                'telefono_persona' =>$telefono_persona,
                                'anexo' =>$anexo,
                                'id_sesion_registro_aud' =>$id_sesion_registro_aud
                        ));
       return $resultado;                 
    }

    public function updatePersona($dni,$nombres,$apepaterno,$apematerno,$sexo,$correo,$telefono,$anexo,$idsessionupdate,$idpersona){
        $sentence=$this->objPdo->prepare("UPDATE sea.persona  SET dni_persona=:dni, nombre_persona=:nombres, ape_paterno=:apepaterno, 
            ape_materno=:apematerno, sexo=:sexo,correo_persona=:correo,telefono_persona=:telefono,anexo=:anexo, id_sesion_update_aud=:idsessionupdate, fecha_update_aud=NOW()
      WHERE id_persona=:idpersona");
        $sentence->execute(array(
                                  'dni'=>$dni,
                                  'nombres'=>$nombres,
                                  'apepaterno'=>$apepaterno,
                                  'apematerno'=>$apematerno,
                                  'sexo'=>$sexo,
                                  'correo'=>$correo,
                                  'telefono'=>$telefono,
                                  'anexo'=>$anexo,
                                  'idsessionupdate'=>$idsessionupdate,
                                  'idpersona'=>$idpersona
                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

   
  public function eliminarPersona($id_sesion_update_aud,$fecha_update,$id_persona){
    $sentence=$this->objPdo->prepare(" UPDATE sea.persona SET estado_persona='I',id_sesion_update_aud=:id_sesion_update_aud, fecha_update_aud=:fecha_update    WHERE id_persona=:id_persona");
    $sentence->execute(array(
                              'id_sesion_update_aud'=>$id_sesion_update_aud,
                              'fecha_update'=>$fecha_update,
                              'id_persona'=>$id_persona,

                        ));
    $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
    return $resultado;
}

    public function registrarPersonaManual($dni_persona, $nombre_persona, $ape_paterno, $ape_materno, $correo_persona, $telefono_persona, $anexo, $id_sesion_registro_aud){
        $sql="INSERT INTO sea.persona(dni_persona, nombre_persona, ape_paterno, ape_materno, sexo, fech_nac, direccion_persona, correo_persona, telefono_persona, profesion_persona, foto_persona, estado_persona, id_tipo_persona, id_modalidad_contractual, id_sesion_registro_aud, fecha_registro_aud, id_sesion_update_aud, fecha_update_aud, anexo) VALUES (:dni_persona, :nombre_persona, :ape_paterno, :ape_materno, NULL, NULL, NULL, :correo_persona, :telefono_persona, NULL, NULL, 'A', 1, NULL, :id_sesion_registro_aud, NOW(), NULL, NULL, :anexo)";
        $sentence = $this->objPdo->prepare($sql);
        $resultado=$sentence->execute(array(   'dni_persona' =>$dni_persona,
                                'nombre_persona' =>$nombre_persona,
                                'ape_paterno' =>$ape_paterno,
                                'ape_materno' =>$ape_materno,
                                'correo_persona' =>$correo_persona,
                                'telefono_persona' =>$telefono_persona,
                                'anexo' =>$anexo,
                                'id_sesion_registro_aud' =>$id_sesion_registro_aud
                        ));
       return $resultado;                 
    }
 
   
    public function consultarDatosPersonaDNI($dni_persona) {
        $sentence = $this->objPdo->prepare("SELECT id_usuario,p.id_persona,nombre_persona,ape_paterno, ape_materno FROM sea.persona p 
        INNER JOIN sea.usuario u ON p.id_persona=u.id_persona
        WHERE dni_persona = :dni_persona and estado_persona = 'A'");
        $sentence->execute(array('dni_persona' => $dni_persona));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0];
    }


    public function consultarModalidadContractualPersona($idModalidad) {
        $sentence = $this->objPdo->prepare("SELECT id_modalidad_contractual, nombre_modalidad_contractual
        FROM sea.modalidad_contractual WHERE id_modalidad_contractual=:idModalidad");
        $sentence->execute(array('idModalidad' => $idModalidad));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0];
    }


   public function consultarPersona() {
            $sentence = $this->objPdo->prepare("SELECT p.dni_persona, p.nombre_persona, p.ape_paterno, p.ape_materno,p.id_persona,p.id_modalidad_contractual,u.id_usuario
            FROM sea.persona p 
            INNER JOIN sea.usuario u ON p.id_persona=u.id_persona
            ORDER BY p.id_persona");
       		$sentence->execute();
        	$resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
       		return $resultado;
    }
    
    public function consultarPersonaByDNI($dni_persona) {
        $sentence = $this->objPdo->prepare("SELECT id_persona FROM sea.persona where dni_persona like :dni_persona and estado_persona = 'A'");
        $sentence->execute(array('dni_persona' => $dni_persona));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0]->id_persona;
    }
    public function consultarPersonaByID($id_persona) {
        $sentence = $this->objPdo->prepare("SELECT id_persona FROM sea.persona where id_persona = :id_persona");
        $sentence->execute(array('id_persona' => $id_persona));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0]->id_persona;
    }
	public function registrarPersona($dni_persona, $nombre_persona, $ape_paterno, $ape_materno, $correo_persona, $telefono_persona){
        $sql="INSERT INTO sea.persona(dni_persona, nombre_persona, ape_paterno, ape_materno, sexo, fech_nac, direccion_persona, correo_persona, telefono_persona, profesion_persona, foto_persona, estado_persona, id_tipo_persona, id_modalidad_contractual, id_sesion_registro_aud, fecha_registro_aud, id_sesion_update_aud, fecha_update_aud, anexo) VALUES (:dni_persona, :nombre_persona, :ape_paterno, :ape_materno, NULL, NULL, NULL, :correo_persona, :telefono_persona, NULL, NULL, 'A', 1, NULL, NULL, NOW(), NULL, NULL, NULL)";
        $sentence = $this->objPdo->prepare($sql);
        $resultado=$sentence->execute(array(   'dni_persona' =>$dni_persona,
                                'nombre_persona' =>$nombre_persona,
                                'ape_paterno' =>$ape_paterno,
                                'ape_materno' =>$ape_materno,
                                'correo_persona' =>$correo_persona,
                                'telefono_persona' =>$telefono_persona
                        ));
        return $resultado;
	}
	public function consultarIdPersona() {
        $sentence = $this->objPdo->prepare("SELECT * FROM sea.persona");
        $sentence->execute();
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0];
    }
    public function consultarDatosPersonaByDNI($dni_persona) {
        $sentence = $this->objPdo->prepare("SELECT * FROM sea.persona where dni_persona = :dni_persona and estado_persona = 'A'");
        $sentence->execute(array('dni_persona' => $dni_persona));
        $persona = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $persona[0];
    }
    public function actualizarPerfilPersonaByDNI($dni_persona, $ape_paterno, $ape_materno, $profesion_persona, $nombre_persona, $correo_persona, $telefono_persona, $sexo, $fech_nac, $foto_persona, $direccion_persona, $id_modalidad_contractual, $id_sesion_update_aud, $anexo){
        $sql="UPDATE sea.persona SET dni_persona = :dni_persona, nombre_persona = :nombre_persona, ape_paterno = :ape_paterno, ape_materno = :ape_materno, sexo = :sexo, fech_nac = :fech_nac, direccion_persona = :direccion_persona, correo_persona = :correo_persona, telefono_persona = :telefono_persona, profesion_persona = :profesion_persona, foto_persona = :foto_persona, id_modalidad_contractual = :id_modalidad_contractual, id_sesion_update_aud = :id_sesion_update_aud, fecha_update_aud = NOW(), anexo = :anexo WHERE dni_persona like :dni_persona";
        $sentence = $this->objPdo->prepare($sql);
        $resultado= $sentence->execute(array(   'dni_persona' =>$dni_persona,
                                'nombre_persona' =>$nombre_persona,
                                'ape_paterno' =>$ape_paterno,
                                'ape_materno' =>$ape_materno,
                                'correo_persona' =>$correo_persona,
                                'telefono_persona' =>$telefono_persona,
                                'profesion_persona' =>$profesion_persona,
                                'sexo' =>$sexo,
                                'fech_nac' =>$fech_nac,
                                'foto_persona' =>$foto_persona,
                                'direccion_persona' =>$direccion_persona,
                                'id_modalidad_contractual' =>$id_modalidad_contractual,
                                'id_sesion_update_aud' =>$id_sesion_update_aud,
                                'anexo' =>$anexo
                        ));
           return $resultado;             
    }
}
?>