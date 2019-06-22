<?php $c=1 ?>
  <?php  foreach ($lusuario as $usuario): ?>
        <tr id="#">
        <td class="tabmtmth"> <?php echo $c;  ?></td> 
          <td class="tabmtmth"> <?php echo $usuario->dni_persona;  ?></td> 
          <td class="tabmtmth"> <?php echo $usuario->ape_paterno.' '.$usuario->ape_materno.' '.$usuario->nombre_persona;  ?>
          </td>                      
          <td style="text-align: center;">
          	<?php if ($usuario->estado_usuario == 'A') { ?>
          		<?php if ($usuario->id_usuario != $_SESSION['idsesion']) { ?>
					<a href="#" onClick="deshabilitarUsuarios('<?php echo $usuario->id_usuario ?>');" data-toggle="tooltip" data-target="#deshabilitar"><i class="icon-close" data-toggle="tooltip" data-placement="left" title="" data-original-title="Deshabilitar"></i></a>
				<?php } ?>
          	<?php } else{ ?>
			<!-- &nbsp&nbsp -->
				<a href="#" onClick="habilitarUsuarios('<?php echo $usuario->id_usuario ?>');" data-toggle="tooltip" data-target="#habilitar"><i class="icon-check" data-toggle="tooltip" data-placement="left" title="" data-original-title="Habilitar"></i></a>
          	<?php } ?>
          </td>       
        </tr>
     
     <?php $c=$c+1 ?>
 <?php endforeach; ?>