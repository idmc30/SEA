<!DOCTYPE html>
<html lang="es">
<!-- 1.- CGuerrero  04/04/2049 Registro de Evento -->
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
                        <li class="breadcrumb-item"><a href="index.php?page=evento&action=detalle">Detalle Evento</a></li>
                        <li class="breadcrumb-item active itemactiv" aria-current="page"></li>
                      </ol>
                    </nav>
                  </div>
                  <div class="col-md-6 titulovent">
                    <label class="col-sm-12 col-form-label"  style=""><b>DETALLE ITEM</b></label>
                  </div>
                </div>
              </div>
              <br><br>
              
              <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <hr class="hrdivision">
                    <div class="card-body"> 
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                      <input type="hidden" id="codigo_evento" value="<?php echo $_GET['key']?>">
                        <small class="text-mutedsea"><b>TIPO</b></small>
                        <br>
                        <p class="pdeteve"><?php echo strtoupper($oevento->evento_tipo_nombre) ?></p>
                      </div>
                      <hr>                     
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>TITULO</b></small>
                        <br>
                        <p class="pdeteve"><?php echo strtoupper($oevento->evento_nombre) ?></p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>DESCRIPCION</b></small>
                        <br>
                        <p class="pdeteve"><?php echo strtoupper($oevento->evento_descripcion) ?> </p>
                      </div>
                      <hr>                      
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>Fecha de Inicio</b></small>
                        <br>
                        <p class="pdeteve"><?php echo $oevento_fecha_inicio ?></p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>Fecha Fin</b></small>
                        <br>
                        <p class="pdeteve"><?php echo  $oevento_fecha_final ?></p>
                      </div>
                      <hr>                  
                    </div>
                  </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-header cardmtmheader">
                      <div class="row">
                        <div class="col-md-10">ITEMS</div><br>
                        <input type="hidden" id="keyEventoPrimerPadre" value="<?php echo $id_evento_primer_padre?>">
                        <div class="col-md-1">
                        <button type="button" class="btn btn-export btn-rounded btn-icon" data-toggle="tooltip" data-placement="left" title="" data-original-title="Añadir Items" id="btn_additem" data-id="<?php echo $_GET['key'] ?>">
                            <i class="mdi mdi-plus"></i>
                        </div>   
                    </div>
                    </div>
                    <div class="card-body">
                    <br>               
                      <div class="table-responsive">
                        <table id="tablaitem" class="table">
                          <thead>
                            <tr>
                                <th>N°</th>
                                <th>TIPO</th>
                                <th>NOMBRE</th>
                                <th>ACCION</th>
                            </tr>
                          </thead>
                          <tbody id="listado_Items_evento">                                       
                          </tbody>
                        </table>
                      </div>
                      <div id="div_modales"></div>
                    </div>
                  </div>
                </div>                
              </div>              
            </div>
              <?php require'view/general/vFooter.php' ?>  
          </div>
        </div>
    <?php require'view/general/lScript.php' ?>
    <script>      
      $(document).on('click', '#btn_modulos', function(event) {
        event.preventDefault();
        /* Act on the event */
        window.location.href = 'index.php?page=evento&action=modulo&key=<?php echo $_GET['key'] ?>';
      });
    </script>
    <script src="assets/js/data-table.js"></script>
    <script src="assets/customs/plugins/datatable/spanish_datatable.js"></script>
    <script>
      $('#tablaitem').DataTable({
          "bLengthChange": false,
          "lengthMenu": [10],
          "language": spanish_datatable
      });
    </script>
    <script>
      $('#tablaparticipante').DataTable({
          "bLengthChange": false,
          "lengthMenu": [10],
          "language": spanish_datatable
      });
    </script>
    <script src="assets/customs/plugins/datepicker/js/bootstrap-datepicker.js"></script>
   <script src="assets/customs/plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="js/eventos/evento_detalleitem.js"></script>
</body>

</html>