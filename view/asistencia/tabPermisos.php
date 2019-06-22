<?php if ($listarPermisos) { ?>
	<?php $c=1; ?>  
	  <?php  foreach ($listarPermisos as $permiso): ?>
	    <tr>
	      <td style="text-align: center;"><?php echo $c ?></td>
	      <?php list($hora_salida_permiso, $milisegundo) = explode('.',$permiso->hora_salida_permiso) ?>
	      <td style="text-align: center;"><?php echo $hora_salida_permiso ?></td>
	      <?php list($hora_entrada_permiso, $milisegundo1) = explode('.',$permiso->hora_entrada_permiso) ?>
	      <td style="text-align: center;"><?php echo $hora_entrada_permiso ?></td>
	    </tr>
	  <?php $c=$c+1 ?>  
	<?php endforeach; ?>
<?php }else{ ?>
	<tr>
      <td colspan="3" style="text-align: center;">El asistente no ha solicitado permisos</td>
    </tr>
<?php } ?>