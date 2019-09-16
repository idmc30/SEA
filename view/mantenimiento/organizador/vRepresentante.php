<!DOCTYPE html>
<html lang="es">
<?php require 'view/general/lHead.php' ?>

<body class="sidebar-dark">
  <div class="container-scroller">
    <?php require 'view/general/vSuperior.php' ?>
    <div class="container-fluid page-body-wrapper">
      <?php require 'view/general/vMenu.php' ?>
      <div class="main-panel">

        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="col-md-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-custom d-none d-xs-block d-sm-block">
                    <li class="breadcrumb-item"><a href="index.php?page=inicio&action=inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Mantenimiento</a></li>
                    <li class="breadcrumb-item"><a href="index.php?page=organizador&action=registro">Organizador</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px">
                    </li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label" style="font-size: 30px;"><b>REPRESENTANTE</b></label>
              </div>
            </div>
          </div>
              <br>
              <div class="col-lg-12 grid-margin">
                <div class="card">
                  <div class="card-header cardmtmheader">LISTADO DE REPRESENTANTE POR EVENTO</div>
                  <div class="card-body">
                  <br>               
                    <div class="table-responsive table-hover">
                      <table id="tabladt" class="table">
                        <thead class="tabmtmheader">
                          <tr>
                              <th>N°</th>
                              <th>DNI</th>
                              <th>NOMBRE Y APELLIDOS</th>                              
                              <th>MODALIDAD CONTRACTUAL</th>
                              <th>Teléfono</th>
                              <th>EVENTO</th>
                              <th>DESACTIVAR</th>
                          </tr>
                        </thead>
                        <tbody id="lrepresentante">
                        <?php $c=1; ?>  
                          <?php  foreach ($lrepresentante as $representante): ?>  
                            <tr id="#">
                              <td  style="text-align: center;"><?php echo "<b>".$c."</b>";?></td>  
                              <td class="tabmtmth"><?php echo $representante->dni_persona?></td> 
                              <td class="tabmtmth"><?php echo $representante->ape_paterno.' '.$representante->ape_materno.' '.$representante->nombre_persona?></td>            
                              <td><?php echo $representante->nombre_modalidad_contractual ?></td> 
                              <td><?php echo $representante->telefono_persona ?></td>     
                              <td><?php echo $representante->evento_nombre ?></td>  
                              <td class="tablamtmsaccion">
                                <a href="#" onClick="desactivar('<?php echo $representante->evpar_id ?>');" ><i class="icon-close"></i></a>
                              </td>         
                            </tr>
                            <?php $c=$c+1 ?>  

                           <?php endforeach; ?>  
                      </table>
                    </div>

                  </div>
                </div>
              </div>           
              </div>
              
            </div>
          </div>
          <?php require'view/general/vFooter.php' ?>
        </div>
        

      </div>
    </div>
  </div>  
  <?php require'view/general/lScript.php' ?>
  <script src="assets/js/data-table.js"></script>
  <script src="assets/customs/plugins/datatable/spanish_datatable.js"></script>
  <script>
    $('#tabladt').DataTable({
        "bLengthChange": false,
        "lengthMenu": [10],
        "language": spanish_datatable
    });
  </script>
  <script src="assets/js/modal-demo.js"></script>
  <script src="js/jOrganizador.js"></script>
</body>

</html>