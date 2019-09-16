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
                    <li class="breadcrumb-item"><a href="index.php?page=asistencia&action=control">Control</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px"></li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label"><h2><b>CONTROL DE ASISTENCIA</b></h2></label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-header cardmtmheader">
                  <div class="row">
                  <div class="col-md-11"></div>
                  <div class="col-md-1">
                    <a id="exportarAsistentes" href="index.php?page=asistencia&action=exportarAsistentes&evento=<?php echo base64_encode($idEvento) ?>" target="_blank" style="color:#f39c12; font-size: 25px" data-toggle="tooltip" title="" class="btn btn-export btn-rounded btn-icon" data-original-title="Exportar"><i class="mdi mdi-file-excel"></i></a>
                  </div>   
                </div>
                </div>
                <div class="ctrlasistencia"><br><b><?php echo strtoupper($evento->evento_nombre) ?></b><br></div><br>
                <div class="row"> 
                  <div class="col-lg-4">
                    <br><br>
                    <div class="form-group row">
                      <div class="col-sm-2"></div>
                      <label class="col-sm-2 col-form-label">DNI</label>
                      <div class="col-sm-8">
                        <input hidden id="txtIdEvento" name="txtIdEvento" type="text" value="<?php echo $idEvento ?>"/>
                        <input hidden id="txtApertura" name="txtApertura" type="text" value="<?php echo $response['representante'] ?>"/>
                        <input hidden id="txtEstado" name="txtEstado" type="text" value="<?php echo $response['estado'] ?>"/>
                        <input id="txtDNI" name="txtDNI" type="text" class="form-control" placeholder="DNI" maxlength="8" onkeypress="return soloNumeros(event)" autofocus="" value=""/>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <div class="col-sm-2"></div>
                      <label class="col-sm-3 col-form-label"><b>CONTROL</b></label>
                      <div class="col-sm-7">
                         <?php if ($response['representante']) {?>
                            <select class="form-control" id="cmbAsistencia" name="cmbAsistencia">
                              <option value="0" selected>-- SELECCIONAR --</option> 
                              <option value="2">ENTRADA</option>
                              <option value="3">SALIDA</option>
                              <option value="4">PERMISO SALIDA</option>
                              <option value="5">PERMISO ENTRADA</option>
                              <option value="6">CIERRE</option>
                            </select>
                         <?php }else{ ?>
                            <select class="form-control" id="cmbAsistencia" name="cmbAsistencia">
                              <option value="0" selected>-- SELECCIONAR --</option> 
                              <option value="1">APERTURA</option>
                            </select>
                         <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <br><br>
                      <div class="text-center pb-4">
                        <img id="imagen" src="assets/customs/imag/pj.png" alt="profile" class="img-lg rounded-circle mb-3"/>
                        <br>
                        <h4 id="nombre_completo">Nombres y Apellidos</h4>
                      </div>
                  </div>                  
                  <div class="col-lg-1"></div>
                  <div class="col-lg-2">
                    <br>
                      <div class="card bg-gradient-danger text-white text-center card-shadow-danger">
                        <div class="card-body">
                          <label style="font-size: 50px" id="dia"><?php echo date("j") ?></label>
                          <br>
                          <h4 class="font-weight-normal" id="mes"><?php echo strtoupper($monthName) ?></h4>
                          <label style="font-size: 20px" id="hora"><?php echo date("g:i a") ?></label>
                        </div>
                      </div>
                      <br>
                  </div>

                </div>
                <hr class="hrdivision" />
                <div class="card-body">
                  <br>  
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
                          <th>Permisos</th>
                          <th>Asistencia</th>
                        </tr>
                      </thead>
                      <tbody id="listaParticipante">                       
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="modal fade" id="permisos" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form class="form-sample" id="frmPermiso" name="frmPermiso">
                      <div class="modal-content">
                        <div class="modal-header text-white bg-primary" >
                          <h5 class="modal-title" id="nombreAsistente" name="nombreAsistente"></h5>
                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white"><b>x</b></span>
                          </button>
                        </div>
                        <div class="card-body">
                          <br>  
                          <div class="table-responsive">
                            <table id="tabladt" class="table">
                              <thead>
                                <tr style="text-align: center; background: #282f3a; color: #fff">
                                  <th>N°</th>
                                  <th>Hora Salida</th>
                                  <th>Hora Entrada</th>
                                </tr>
                              </thead>
                              <tbody id="listaPpermiso">                       
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </form>
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
  <script type="text/javascript" src="js/jControlAsistencia.js"></script>
</body>

</html>
