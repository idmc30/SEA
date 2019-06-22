<?php
require_once 'conexion.php';
/**
 * 01.- Irwin Morales 10/04/2019 métodos del publico objetivo
 * 02.- Irwin Morales 13/04/2019 se modifico los metodos para agregar los id de auditoria
 * 03.- idmc 30/04/2019 modificado se agrego sentence y return a los metodo
 */
class PublicoObjetivo{
           private $objPdo;
			function __construct(){
					$this->objPdo = new Conexion(1);
				}
        
	 public function insertarPublicoObjetivo($nombre,$descripcion,$idsesionregistroaud,$fecharegistroaud){
			
        $sql="INSERT INTO sea.publico_objetivo(nombre_publico_objetivo, descripcion_publico_objetivo, estado_publico_objetivo,id_sesion_registro_aud,fecha_registro_aud,id_sesion_update_aud,fecha_update_aud) VALUES (:nombre, :descripcion, 'A',:idsesionregistroaud,:fecharegistroaud,NULL,NULL);";
        $sentence = $this->objPdo->prepare($sql);
        $respuesta=$sentence->execute(array(
                            'nombre' =>$nombre,
                            'descripcion' =>$descripcion,
                            'idsesionregistroaud' =>$idsesionregistroaud,
                            'fecharegistroaud' =>$fecharegistroaud                                                    
                        ));
       return $respuesta;
		} 
  
    public function listarPublicoObjetivo() {
           $sentence = $this->objPdo->prepare("SELECT id_publico_objetivo, nombre_publico_objetivo, descripcion_publico_objetivo, estado_publico_objetivo  FROM sea.publico_objetivo WHERE estado_publico_objetivo='A' ORDER BY id_publico_objetivo DESC");
       		 $sentence->execute();
        	 $respuesta = $sentence->fetchAll(PDO::FETCH_OBJ);
       		 return $respuesta;
    }
    public function listarPublicoObjetivoxIdEvento($id_evento) {
             $sentence = $this->objPdo->prepare("SELECT* FROM sea.evento_publico_objetivo ep INNER JOIN sea.publico_objetivo pob on ep.id_publico_objetivo = pob.id_publico_objetivo WHERE ep.id_evento = :id_evento");
             $sentence->execute(array(
                                    'id_evento' => $id_evento,
                                   ));
             $respuesta = $sentence->fetchAll(PDO::FETCH_OBJ);
             return $respuesta;
    }    
    
    public function listarPublicoObjetivoActivo() {
             $sentence = $this->objPdo->prepare("SELECT id_publico_objetivo, nombre_publico_objetivo, descripcion_publico_objetivo, estado_publico_objetivo  FROM sea.publico_objetivo WHERE estado_publico_objetivo='A' ORDER BY id_publico_objetivo DESC");
             $sentence->execute();
             $respuesta = $sentence->fetchAll(PDO::FETCH_OBJ);
             return $respuesta;
    }
    public function eliminarPublicoObjetivo($id_publico_objetivo, $estadoPuObj,$idsesionupdateaud,$fechaupdateaud) {
        $sentence = $this->objPdo->prepare('UPDATE sea.publico_objetivo  SET estado_publico_objetivo=:estadoPuObj,id_sesion_update_aud= :idsesionupdateaud,fecha_update_aud=:fechaupdateaud  WHERE id_publico_objetivo=:id_publico_objetivo;');
        $respuesta = $sentence->execute(array(
                                    'id_publico_objetivo' => $id_publico_objetivo,
                                    'estadoPuObj' => $estadoPuObj,
                                    'idsesionupdateaud' => $idsesionupdateaud,
                                    'fechaupdateaud' => $fechaupdateaud
                                   ));
        return $respuesta;
    }
   
public function modificarPublicoObjetivo($nombrePuObj,$descripcionPuObj,$id_publico_objetivo,$idsesionupdateaud,$fechaupdateaud){
    $sql='UPDATE sea.publico_objetivo SET nombre_publico_objetivo=:nombrePuObj,id_sesion_update_aud= :idsesionupdateaud,fecha_update_aud=:fechaupdateaud, descripcion_publico_objetivo=:descripcionPuObj  WHERE id_publico_objetivo= :id_publico_objetivo';
    $sentence=$this->objPdo->prepare($sql);
    $respuesta=$sentence->execute(array(
                         'nombrePuObj'=> $nombrePuObj,
                         'descripcionPuObj'=> $descripcionPuObj,
                         'id_publico_objetivo'=> $id_publico_objetivo,
                         'idsesionupdateaud' => $idsesionupdateaud,
                         'fechaupdateaud' => $fechaupdateaud                        
                        ));
    return $respuesta;
  } 
  public function getPublicoObjetivo($id) {
         $sentence = $this->objPdo->prepare('SELECT * FROM sea.publico_objetivo where id_publico_objetivo = :codigo');
         $sentence->execute(array('codigo' => $id));
         $respuesta = $sentence->fetchAll(PDO::FETCH_OBJ);
         return $respuesta[0];
     }
}