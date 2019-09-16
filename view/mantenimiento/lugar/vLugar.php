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
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px"></li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label"  style="font-size: 30px;"><b>LUGAR</b></label>
              </div>
            </div>
          </div>
          <div class="card col-md-12">
            <br>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 grid-margin">
                  <div class="card">
                    <div class="card-header cardmtmheader">REGISTRO</div>
                    <div class="card-body">
                     <br>
                      <form class="form-sample" id="frmLugar" name="frmLugar">
                        <div class="form-group row">
                          <label  class="col-sm-3 col-form-label"><b>Nombre</b></label>
                          <div class="col-sm-8">
                            <input name="txtIdLugar" id="txtIdLugar" type="text" class="form-control" placeholder="ID Lugar" value="0" hidden />
                            <input name="txtNombreLugar" id="txtNombreLugar" type="text" class="form-control" placeholder="Nombre" />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"><b>ubicación</b></label>
                          <div class="col-sm-8">
                            <input name="txtUbicacion" id="txtUbicacion" type="text" class="form-control" placeholder="Ubicación" />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"><b>Referencia</b></label>
                          <div class="col-sm-8">
                            <textarea name="txtReferencia" id="txtReferencia" class="form-control" id="" rows="4" placeholder="Referencia"></textarea>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-5"></div>
                          <div class="col-md-3">
                            <button type="button" class="btn btn-inverse-info btn-fw" onclick="AceptarLugar()" >Guardar</button>
                          </div>
                        </div>
                    </form>
                  </div>                                  
                  </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-header cardmtmheader">LISTA</div>
                    <div class="card-body">
                    <br>               
                      <div class="table-responsive table-hover">
                        <table id="tabladt" class="table">
                          <thead class="tabmtmheader">
                            <tr>
                              <th>N°</th>
                              <th class="tabmtmth">NOMBRE</th>
                              <th class="tabmtmth">UBICACION</th>
                              <th class="tabmtmth">REFERENCIA</th>
                              <th class="tabmtmth">ACCION</th>
                            </tr>
                          </thead>
                          <tbody id="tbodys">
                          </tbody>
                        </table>
                      </div>
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
  <script type="text/javascript" src="js/jLugar.js"></script>
</body>

</html>
