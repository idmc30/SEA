
                        <?php foreach ($leventos as $evento): ?>
                           <tr>
                             <td><?php echo $nro++; ?></td>
                             <td><?php echo $evento->evento_nombre ?></td>
                             <td><?php echo $evento->evento_descripcion ?></td>                            
                             <?php 
                               $totalOrganizador= $organizador->totalderOrganizadoresxEvento($evento->evento_id);
                             ?>
                             <?php if ($totalOrganizador>0): ?>
                                <td style="text-align: center;"><a href="#" onclick="modalOrganizadores('<?php echo $evento->evento_id ?>')"><?php echo $totalOrganizador?></a></td>                             
                             <?php else: ?>
                             <td style="text-align: center;"><?php echo "<b>No tiene Organizador</b>" ?></td>
                              <?php endif ?>

                             <td><?php echo $evento->evento_fecha_inicio ?></td>
                             <td><?php echo ($evento->evento_certificado == true) ? 'Si' : 'No' ; ?></td>
                             <td><?php echo $evento->evento_estado_nombre ; ?></td>
                             <td><?php echo $evento->evento_tipo_nombre; ?></td>
                             <td class="tablamtmsaccion">
                              <a href="index.php?page=evento&action=detalle&key=<?php echo base64_encode($evento->evento_id) ?>" title="Detalle"><i class="icon-eye"></i></a>
                              &nbsp
                              <a href="index.php?page=evento&action=editar&key=<?php echo base64_encode($evento->evento_id) ?>" title="Editar"><i class="icon-pencil"></i></a>
                              &nbsp <a href="#" onClick="eliminar('<?php echo base64_encode($evento->evento_id) ?>')"><i class="icon-trash"></i>                             
                            </td>                             
                           </tr>                    
                        <?php endforeach ?>                     

                       
                    