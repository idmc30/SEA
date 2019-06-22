<?php $c=1; ?>
   <?php  foreach ($lPublcoObjetivo as $publicoObjetivo): ?>
        <tr id="#">
          <td  style="text-align: center;"> <?php echo "<b>".$c."</b>";?></td>  
          <td class="tabmtmth"> <?php echo $publicoObjetivo->nombre_publico_objetivo;  ?></td>       
          <td> <?php echo $publicoObjetivo->descripcion_publico_objetivo;  ?></td>          
          <td class="tablamtmsaccion"> <a href="#" onClick="editar('<?php echo $publicoObjetivo->id_publico_objetivo ?>');"><i class="icon-pencil"></i></a>&nbsp <a href="#" onClick="eliminar('<?php echo $publicoObjetivo->id_publico_objetivo ?>')"><i class="icon-trash"></i></a></td>         
        </tr>
     
     <?php $c=$c+1 ?>  

 <?php endforeach; ?>
