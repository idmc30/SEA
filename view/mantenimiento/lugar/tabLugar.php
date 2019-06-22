<?php $c=1;?>
<?php  foreach ($listaLugar as $lista_lugar): ?>
<tr>
	<td><?php echo $c?></td>
  <td><?php echo $lista_lugar->nombre_lugar; ?></td>
  <td><?php echo $lista_lugar->ubicacion_lugar; ?></td>
  <td><?php echo $lista_lugar->referencia_lugar; ?></td>
  <td class="tablamtmsaccion">
    <a data-toggle="tooltip" title="Editar" onclick="EditaLugar('<?php echo $lista_lugar->id_lugar; ?>')" ><li class="fa fa-edit"></li></a>
    &nbsp
    <a data-toggle="tooltip" title="Eliminar" onclick="EliminarLugar('<?php echo $lista_lugar->id_lugar; ?>','I')"><li class="fa fa-trash"></li></a>
  </td>
</tr>
<?php $c=$c+1;?>
<?php endforeach; ?>
