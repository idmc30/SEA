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
                  <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="index.php?page=inicio&action=inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Asistencia</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px"></li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label"><h2><b>DETALLE DE ASISTENCIA</b></h2></label>
              </div>
            </div>
          </div>
          <br>
            <div class="card">
              <div class="card-header cardmtmheader"></div>
              <div class="col-md-12 grid-margin">
               <br>
                <form class="form-sample">
                  <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Evento</b></label>
                        <div class="col-sm-8">
                          <select class="js-example-basic-single" style="width:100%" id="cmbevento" name="cmbevento">
                          <option value="0" selected="selected" disabled>Seleccionar un evento...</option>
                          <?php foreach ($levento as $evento): ?>
                            <option value="<?php echo $evento->evento_id ?>"><?php echo $evento->evento_nombre ?></option>
                          <?php endforeach ?>
                            
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><b>Tipo Asistente</b></label>
                        <div class="col-sm-8">
                          <select class="js-example-basic-single" style="width:100%" id="cmbtipoasistencia" name="cmbtipoasistencia">
                          <option value="%" selected="selected" >Todos</option>                          
                          <?php foreach ($ltipopersona as $tipopersona): ?>
                            <option value="<?php echo $tipopersona->id_tipo_persona ?>"><?php echo $tipopersona->nombre_tipo_persona ?></option>
                          <?php endforeach ?>                             
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <hr class="hrdivision" />
                <div class="card-body" style="font-size: 0rem;">
                  <div class="row">
                    <div class="table-responsive">
                      <table id="tabladt" class="table">
                        <thead>
                          <tr style="text-align: center; background: #282f3a; color: #fff">
                            <th>N°</th>
                            <th>DNI</th>
                            <th>Nombre y Apellidos</th>
                            <th>Tipo de Asistente</th>
                            <th>Hora Entrada</th>
                            <th>Hora Salida</th>
                            <th>Tiempo Asistencia</th>
                            <th>Certificado</th>
                          </tr>
                        </thead>
                        <tbody id="listadodetalleasistencia">
                                      
                        </tbody>
                      </table>
                    </div>
              </div>  
                </div> 
              <br>            
            </div>
            </div>
        </div>
        
        <?php require'view/general/vFooter.php' ?>        
      </div>
    </div>
  </div> 
  <?php require'view/general/lScript.php' ?>
  <script src="assets/js/select2.js"></script>
  <script src="assets/js/data-table.js"></script>
  <script src="assets/customs/plugins/datatable/spanish_datatable.js"></script>
  <script>
    $('#tabladt').DataTable({
        "bLengthChange": true,
        "lengthMenu": [10],
        "language": spanish_datatable
    });
  </script>
  <script src="js/jDetalleAsistencia.js"></script>
  
</body>

</html>
