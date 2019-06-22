<?php $c=1; ?>  
  <?php  foreach ($ldetalle as $detalleasistencia): ?>
        <tr id="#">
          <td  style="text-align: center;"> <?php echo "<b>".$c."</b>";?></td>
          <td class="tabmtmth"> <?php echo $detalleasistencia->dni_persona;  ?></td>
          <td class="tabmtmth"> <?php echo $detalleasistencia->persona;  ?></td>
          <td> <?php echo $detalleasistencia->nombre_tipo_persona;  ?></td>
          <td> <?php echo $detalleasistencia->hora_tiempo_asistencia_participante;  ?></td>
          <td> <?php echo "ss"  ?></td>
          <td> <?php echo "aaa" ?></td>
          <td> <?php echo $detalleasistencia->certificado_participante_evento ?></td>     
        </tr>
     
     <?php $c=$c+1 ?>  

 <?php endforeach; ?>