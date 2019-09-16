<?php

require_once 'conexion.php';

class Usuario{

    private $objPdo;

    public function __construct() {

        $this->objPdo = new Conexion(1);
    }


    public function updatetUsuario($idrolusuario,$idsesionupdateaud,$idusuario){

        $sql="UPDATE sea.usuario SET id_rol_usuario=:idrolusuario, id_sesion_update_aud=:idsesionupdateaud, fecha_update_aud=NOW() WHERE id_usuario=:idusuario";

        $stmt = $this->objPdo->prepare($sql);
        $stmt->execute(array( 'idrolusuario' =>$idrolusuario,
                              'idsesionupdateaud' =>$idsesionupdateaud,
                              'idusuario'=>$idusuario
                        ));
    }

    public function getUsuariosPerfil($idusuario){
                
        $sentence=$this->objPdo->prepare("SELECT * FROM sea.usuario u 
                                        INNER JOIN sea.persona p ON u.id_persona = p.id_persona
                                        INNER JOIN sea.rol_usuario ru ON u.id_rol_usuario=ru.id_rol_usuario
                                        WHERE u.id_usuario=:idusuario ");
        $sentence->execute(array( 'idusuario'=>$idusuario  ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0];
    }
  
  public function insertUsuario($contrasena, $dni_usuario, $idpersona, $id_rol_usuario,$id_sesion_registro_aud){

  
    $sql="INSERT INTO sea.usuario(contrasena, estado_usuario, dni_usuario, modalidad_registro, id_persona, id_rol_usuario, id_sesion_registro_aud, fecha_registro_aud) VALUES (:contrasena, 'A', :dni_usuario, null, :idpersona, :id_rol_usuario, :id_sesion_registro_aud, NOW())";

    $stmt = $this->objPdo->prepare($sql);
    $stmt->execute(array(   'contrasena' =>$contrasena,
                            'dni_usuario' =>$dni_usuario,
                            'idpersona' =>$idpersona,
                            'id_rol_usuario' =>$id_rol_usuario,
                            'id_sesion_registro_aud' =>$id_sesion_registro_aud
                    ));
}


    public function listarUsuariosPerfil(){
            
        $sentence=$this->objPdo->prepare("SELECT * FROM sea.usuario u 
                                        INNER JOIN sea.persona p ON u.id_persona = p.id_persona
                                        INNER JOIN sea.rol_usuario ru ON u.id_rol_usuario=ru.id_rol_usuario");
        $sentence->execute();
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

 public function listarUsuariosParaPonentes() {
        $stmt = $this->objPdo->prepare("SELECT * FROM sea.usuario u INNER JOIN sea.persona p ON p.id_persona = u.id_persona WHERE u.estado_usuario LIKE 'A'");
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

    public function getUsuario($idUsuario){
        $sentence=$this->objPdo->prepare("SELECT id_usuario, contrasena, estado_usuario, dni_usuario, modalidad_registro, 
        id_persona, id_rol_usuario FROM sea.usuario WHERE id_usuario=:idUsuario");
        $sentence->execute(array(
                                'idUsuario'=>$idUsuario,

                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0];
    }

    
    public function eliminarUsuario($id_sesion_update_aud,$fecha_update,$idUsuario){
        $sentence=$this->objPdo->prepare("UPDATE sea.usuario SET  estado_usuario='I', id_sesion_update_aud=:id_sesion_update_aud,                                                fecha_update_aud=:fecha_update   WHERE id_usuario=:idUsuario");
        $sentence->execute(array(
                                  'id_sesion_update_aud'=>$id_sesion_update_aud,
                                  'fecha_update'=>$fecha_update,
                                  'idUsuario'=>$idUsuario,

                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    public function activarUsuario($id_sesion_update_aud,$fecha_update,$idUsuario){
        $sentence=$this->objPdo->prepare("UPDATE sea.usuario SET  estado_usuario = 'A', id_sesion_update_aud=:id_sesion_update_aud, fecha_update_aud=:fecha_update   WHERE id_usuario=:idUsuario");
        $sentence->execute(array(
                                  'id_sesion_update_aud'=>$id_sesion_update_aud,
                                  'fecha_update'=>$fecha_update,
                                  'idUsuario'=>$idUsuario,

                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    public function estadoUsuario($idusuario){
        $sentence=$this->objPdo->prepare("SELECT estado_usuario FROM sea.usuario WHERE id_usuario=:idusuario");
        $sentence->execute(array(
                                'idusuario'=>$idusuario
                            ));
        $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
        return $resultado[0]->estado_usuario;


    }

      public function listarUsuarios(){
        
            $sentence=$this->objPdo->prepare("SELECT * FROM sea.usuario u 
                                            INNER JOIN sea.persona p ON u.id_persona = p.id_persona WHERE estado_usuario='A'");
            $sentence->execute();
            $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
       }

    public function registrarUsuarioManual($contrasena, $dni_usuario, $id_persona, $id_sesion_registro_aud){

        $sql="INSERT INTO sea.usuario(contrasena, estado_usuario, dni_usuario, id_persona, 
            id_rol_usuario, id_sesion_registro_aud, fecha_registro_aud, id_sesion_update_aud, fecha_update_aud, modalidad_registro) VALUES (:contrasena, 'A', :dni_usuario, :id_persona, 1, :id_sesion_registro_aud, NOW(), NULL, NULL,'M')";

        $stmt = $this->objPdo->prepare($sql);
        $stmt->execute(array(   'contrasena' =>$contrasena,
                                'dni_usuario' =>$dni_usuario,
                                'id_persona' =>$id_persona,
                                'id_sesion_registro_aud' =>$id_sesion_registro_aud
                        ));
    }

    public function consultarUsuarioByID($id_persona) {
        $stmt = $this->objPdo->prepare("SELECT * FROM sea.usuario where id_persona = :id_persona and estado_usuario like 'A'");
        $stmt->execute(array('id_persona' => $id_persona));
        $usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuario[0];
    }
    public function registrarUsuario($contrasena, $dni_usuario, $id_persona){
        $sql="INSERT INTO sea.usuario(contrasena, estado_usuario, dni_usuario, id_persona, 
            id_rol_usuario, id_sesion_registro_aud, fecha_registro_aud, id_sesion_update_aud, fecha_update_aud) VALUES (:contrasena, 'A', :dni_usuario, :id_persona, 1, NULL, NOW(), NULL, NULL)";
        $stmt = $this->objPdo->prepare($sql);
        $stmt->execute(array(   'contrasena' =>$contrasena,
                                'dni_usuario' =>$dni_usuario,
                                'id_persona' =>$id_persona
                        ));
    }

    public function consultarIngresoUsuario($dni_usuario, $contrasena) {
        $stmt = $this->objPdo->prepare("SELECT id_usuario FROM sea.usuario where dni_usuario = :dni_usuario and contrasena = :contrasena and estado_usuario like 'A'");
        $stmt->execute(array('dni_usuario' => $dni_usuario, 'contrasena' => $contrasena));
        $login = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $login[0]->id_usuario;
    }
    public function consultarUsuarioByDNI($dni_usuario) {
        $stmt = $this->objPdo->prepare("SELECT * FROM sea.usuario where dni_usuario = :dni_usuario and estado_usuario like 'A'");
        $stmt->execute(array('dni_usuario' => $dni_usuario));
        $usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuario[0];
    }

    public function consultarDNIPersonaByID($id_usuario) {
        $stmt = $this->objPdo->prepare("SELECT dni_usuario FROM sea.usuario where id_usuario = :id_usuario and estado_usuario like 'A'");
        $stmt->execute(array('id_usuario' => $id_usuario));
        $usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuario[0]->dni_usuario;
    }


}