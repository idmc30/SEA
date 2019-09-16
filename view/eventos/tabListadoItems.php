<?php $c=1; ?>  
  <?php  foreach ($litems as $items): ?>
        <tr id="#">
          <td  style="text-align: center;"> <?php echo "<b>".$c."</b>";?></td>  
          <td class="tabmtmth"> <?php echo $items->evento_tipo_nombre;  ?></td> 
          <td class="tabmtmth"> <?php echo $items->evento_nombre;  ?></td>                     
          <td class="tablamtmsaccion">
          <a href="index.php?page=evento&action=item&key=<?php echo  base64_encode($items->evento_id) ?>&eventopadre=<?php if ($id_evento_pertenece_padre) {echo $id_evento_pertenece_padre;} else { if($id_evento_pertenece){echo  $id_evento_pertenece; } } ?>">
          <i class="icon-eye"></i></a>&nbsp
            <a href="#" onClick="editar('<?php echo base64_encode($items->evento_id) ?>');"><i class="icon-pencil"></i></a>&nbsp<a href="#" onClick="eliminar('<?php echo base64_encode($items->evento_id) ?>')"><i class="icon-trash"></i></a>
        </td>         
        </tr>
     
     <?php $c=$c+1 ?>  

 <?php endforeach; ?>