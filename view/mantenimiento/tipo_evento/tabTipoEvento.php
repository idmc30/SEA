<?php $c=1;?>
<?php  foreach ($listaTipoEvento as $lista_Tipo_Evento): ?>
<tr>
	<td><?php echo $c?></td>
  	<td><?php echo $lista_Tipo_Evento->evento_tipo_nombre; ?></td>
  	<td><?php echo $lista_Tipo_Evento->evento_tipo_descripcion; ?></td>
  	<td class="tablamtmsaccion">
    	<a data-toggle="tooltip" title="Editar" onclick="EditaTipoEvento('<?php echo $lista_Tipo_Evento->evento_tipo_id; ?>')" ><li class="fa fa-edit"></li></a>
    	&nbsp
    	<a data-toggle="tooltip" title="Eliminar" onclick="EliminarTipoEvento('<?php echo $lista_Tipo_Evento->evento_tipo_id; ?>','I')"><li class="fa fa-trash"></li></a>
  	</td>
</tr>
<?php $c=$c+1; ?>
<?php endforeach; ?>