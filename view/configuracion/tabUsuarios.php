<?php $c=1 ?>
  <?php  foreach ($lusuario as $usuario): ?>
<?php 
  $usuarioEstado= $objUSuario->estadoUsuario($usuario->id_usuario);
?>



        <tr id="#">
        <td class="tabmtmth"> <?php echo $c;  ?></td> 
          <td class="tabmtmth"> <?php echo $usuario->dni_persona;  ?></td> 
          <td class="tabmtmth"> <?php echo $usuario->ape_paterno.' '.$usuario->ape_materno.' '.$usuario->nombre_persona;  ?>
          </td>       
          <td class="tabmtmth"> <?php echo $usuario->nombre_rol_usuario?></td>  

          <?php if ($usuario->estado_usuario!='A'): ?>
              <td class="tabmtmth"><div class="badge badge-danger badge-fw">Inactivo</div></td> 
            <?php else: ?>
              <td class="tabmtmth"><div class="badge badge-success badge-fw">Activo</div></td> 
          <?php endif ?>

          <td style="text-align: center;"><a href="#" onclick="EditUsuario('<?php echo $usuario->id_usuario; ?>')" ><i class="fa fa-edit" data-toggle="tooltip" title="Editar"></i></a>&nbsp
          	<?php if ($usuario->estado_usuario == 'A') { ?>
              <?php if ($usuario->id_usuario != $_SESSION['idsesion']) { ?>
                
                <input id="habilitarUsuario" name="habilitarUsuario" data-idusuario="<?php echo $usuario->id_usuario; ?>" class="estadoUsuario" type="checkbox" <?php echo $estado = ($usuarioEstado==='A') ? 'checked' : ''; ;?>>
				<?php } ?>
          	<?php } else{ ?>
      <input id="habilitarUsuario" name="habilitarUsuario" data-idusuario="<?php echo $usuario->id_usuario; ?>" class="estadoUsuario" type="checkbox" <?php echo $estado = ($usuarioEstado==='A') ? 'checked' : ''; ;?>>
          	<?php } ?>
          </td>       
        </tr>
     
     <?php $c=$c+1 ?>
 <?php endforeach; ?>