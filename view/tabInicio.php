<?php $c=1; ?>  
  <?php  foreach ($leventos as $eventos): ?>
        <tr id="#">          
          <td class="tabmtmth"><img src="<?php echo $eventos->evento_foto ?>" alt="image" class="img-thumbnail"/></td> 
          <td class="tabmtmth"> <a href="#" onclick="modadalEvento('<?php echo $eventos->evento_id ?>')"><?php echo $eventos->evento_nombre  ?></a> </td>                 
          <td class="tabmtmth"> <?php echo "<b>".$eventos->evento_tipo_nombre."</b>"  ?></td>        
          <td> <?php echo $eventos->evento_estado_nombre;  ?></td>  
          
          <?php 
             $consultarincripcion= $participanteEvento->validarAsistencia($idUsuario,$eventos->evento_id); 
             $inscrito=1;
             $noinscrito=0;
          ?>
          
          <?php if ($consultarincripcion==$inscrito): ?>
              <td class="tablamtmsaccion">
                <button type="button" class="btn btn-dark btn-rounded btn-fw" onclick="darDeBaja(<?php echo $idUsuario ?>,<?php echo $eventos->evento_id ?>)">Dar de Baja</button>
            </td>      
          <?php else: ?>
              <td class="tablamtmsaccion">
                <button type="button" class="btn btn-dark btn-rounded btn-fw" onclick="Inscribirse(<?php echo $idUsuario ?>,<?php echo $eventos->evento_id ?>)">Inscribirse</button>
            </td>     
          <?php endif ?>

             
        </tr>
     
     <?php $c=$c+1 ?>  

 <?php endforeach; ?>

