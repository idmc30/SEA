<?php

require_once 'conexion.php';

class Usuario{

    private $objPdo;

    public function __construct() {

        $this->objPdo = new Conexion(1);
    }

/**
 * 1.- Diego Valdera 11/04/2019 metodo para Usuario
 * 2.-idmc 02/05/2019 se agrego los metodo eliminar usuario y getusuario
 */

 /**
  * agragado el 21/06/2019 idmc
  */
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

    // public function listarUsuarios(){
    //     $sentence=$this->objPdo->prepare("SELECT * FROM sea.usuario u 
    //                                     INNER JOIN sea.persona p on u.id_persona = p.id_persona");
    //     $sentence->execute();
    //     $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
    //     return $resultado;


    // }

      public function listarUsuarios(){
        
            $sentence=$this->objPdo->prepare("SELECT * FROM sea.usuario u 
                                            INNER JOIN sea.persona p ON u.id_persona = p.id_persona WHERE estado_usuario='A'");
            $sentence->execute();
            $resultado = $sentence->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
       }

/**
 * diego
 */

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