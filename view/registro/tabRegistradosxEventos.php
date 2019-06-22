
  <?php $c=1 ?>
  <?php  foreach ($lparticipantes as $participantes): ?>
        <tr id="#">
        <td class="tabmtmth"> <?php echo $c;  ?></td> 
          <td class="tabmtmth"> <?php echo $participantes->dni_persona;  ?></td> 
          <td class="tabmtmth"> <?php echo $participantes->ape_paterno.' '.$participantes->ape_materno.' '.$participantes->nombre_persona;  ?>
          </td>   
          <td class="tabmtmth"><?php echo $participantes->tipopar_nombre;  ?></td>  
          
          <td class="tabmtmth"><?php echo $estado_certificado = ($participantes->evpar_certificado) ? 'SI' : 'NO' ;?>  </td>              
          <td style="text-align: center;"><a href="#" onClick="desinscribirParticipante('<?php echo $participantes->evpar_id ?>');" ><i class="icon-close" data-toggle="tooltip" data-placement="left" title="" data-original-title="Cancelar"></i></a></td>        
        </tr>
     
     <?php $c=$c+1 ?>  

 <?php endforeach; ?>