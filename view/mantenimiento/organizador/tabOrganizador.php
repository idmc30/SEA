<?php $c=1; ?>  
  <?php  foreach ($lorganizador as $organizador): ?>
        <tr id="#">
          <td  style="text-align: center;"> <?php echo "<b>".$c."</b>";?></td>  
          <td class="tabmtmth"> <?php echo $organizador->nombre_tipo_organizador;  ?></td> 
          <td class="tabmtmth"> <?php echo $organizador->nombre_organizador;  ?></td>            
          <td style="text-align: center;"> <?php echo $telefono = ($organizador->telefono_organizador==null) ? "--" : $organizador->telefono_organizador;  ?></td>      
          <td style="text-align: center;"> <?php echo $anexo = ($organizador->anexo_organizador==null) ? "--" : $organizador->anexo_organizador;?></td>        
          <td class="tablamtmsaccion">
          <a href="index.php?page=organizador&action=representante&idorganizador=<?php echo $organizador->id_organizador ?>">
             <i class="icon-people" data-toggle="tooltip" data-placement="left" title="" data-original-title="Representante"></i>                </a>&nbsp
            <a href="#" onClick="editar('<?php echo $organizador->id_organizador ?>');"><i class="icon-pencil"></i></a>&nbsp 
            <a href="#" onClick="eliminar('<?php echo $organizador->id_organizador ?>')"><i class="icon-trash"></i></a>
        </td>         
        </tr>
     
     <?php $c=$c+1 ?>  

 <?php endforeach; ?>

