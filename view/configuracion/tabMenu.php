<?php $c=1; ?>
<?php $d=1; ?>
<?php $nivel_menu=1?>
    <?php  foreach ($lmenu as $menu): ?>

    <?php $estadoAcceso= $acceso->estadoCheckMenuPerfil($idPerfil,$menu->id_menu)?>
    
    <tr>
    <td><input id="asignarMenu" name="asignarMenu" data-idmenysubmen="<?php echo $menu->id_menu; ?>" class="agregarMenu" type="checkbox" <?php echo $estado = ($estadoAcceso==='A') ? 'checked' : ''; ;?>></td>

    
    <?php $submenu=$menu->referencia_menu;?>
    <?php if ($menu->referencia_menu==NULL): ?>
        <?php $d=1; ?> 
        <td> <?php echo "<b>".$c."</b>";?></td>
        <?php $c=$c+1;?>
    <?php else: ?>
            <?php $c=$c-1 ?>
            <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<b>".$c.".".$d."</b>";?></td>
            <?php if ($submenu==$menu->referencia_menu): ?>
                <?php $d=$d+1 ?> 
                <?php $c=$c+1 ?>  
                                                    
            <?php endif ?>
        
    <?php endif ?>
        

        <td><?php echo $menu->nombre_menu; ?></td>
        <td><?php echo $menu->descripcion_menu; ?></td>
        <td><?php echo $menu->link_menu; ?></td>
        <td><?php echo $nivel = ( $menu->orden_menu==$nivel_menu) ? 'Menu' : 'Sub Menu' ;?></td>
    </tr>
   
<?php endforeach; ?>
