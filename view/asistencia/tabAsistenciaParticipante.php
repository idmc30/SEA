<?php $c=1; ?>  
  <?php  foreach ($listarParticipantesAsistentes as $lista): ?>
        <tr>
          <td style="text-align: center;"><?php echo $c ?></td>
          <td style="text-align: center;"><?php echo $lista->dni_usuario ?></td>
          <td style="text-align: center;"><?php echo $lista->nombre_persona.' '.$lista->ape_paterno.' '.$lista->ape_materno ?></td>
          <?php $id_personal = $objControlAsistencia->consultarPersonalByDNI($lista->dni_usuario); ?>
          <?php if ($id_personal) { ?>
            <td style="text-align: center;">Interno</td>
          <?php }else{ ?>
            <td style="text-align: center;">Externo</td>
          <?php } ?>
          <?php list($hora_entrada_asistencia, $milisegundo) = explode('.',$lista->hora_entrada_asistencia) ?>
          <td style="text-align: center;"><?php echo $hora_entrada_asistencia ?></td>
          <?php list($hora_salida_asistencia, $milisegundo1) = explode('.',$lista->hora_salida_asistencia) ?>
          <td style="text-align: center;"><?php echo $hora_salida_asistencia ?></td>
          <?php $nombreCompleto = $lista->nombre_persona.' '.$lista->ape_paterno.' '.$lista->ape_materno ?>
          <td style="text-align: center;"><a href="#" onClick="controlPermisos('<?php echo $lista->asist_id ?>','<?php echo $nombreCompleto ?>');"><i class="fa fa-clock-o" data-toggle="modal" data-placement="left" title="" data-original-title="permisos" data-target="#permisos"></i></a></td>
          <td style="text-align: center;"><a href="#" onClick="desactivarAsistencia('<?php echo $lista->asist_id ?>',<?php echo $idEvento ?>);"><i class="fa fa-ban" data-toggle="tooltip" data-placement="left" title="" data-original-title="Cancelar"></i></a></td>
        </tr> 
     <?php $c=$c+1 ?>  
 <?php endforeach; ?>