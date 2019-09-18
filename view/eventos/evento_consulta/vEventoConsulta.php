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
                    <li class="breadcrumb-item"><a href="index.php?page=inicio&action=inicio">Eventos</a></li>
                    <li class="breadcrumb-item"><a href="#">Consulta</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px"></li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label"><h2><b>CONSULTAR DE EVENTOS</b></h2></label>
              </div>
            </div>
          </div>
          
          <div class="col-md-12 grid-margin">
            <div class="card">
              <div class="card-header cardmtmheader">                  
                <div class="row">
                  <div class="col-md-11"></div>
                </div>               
              </div>
              <br>

              <div class="card-body">
               <div class="form-horizontal">
                <div class="col-md-12">

                  <div class="form-group row">

                    <div class="col-md-5">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Fecha Inicio</b></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control fechas" id="fecha_inicial">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-5">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Fecha Fin</b></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control fechas" id="fecha_final">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-1">
                      <button type="button" class="btn btn-dark" style="color: #fafafa !important;" id="btn_mostrar"><i class="fa fa-list-ul"></i> Mostrar</button>                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
                <div class="col-lg-12 grid-margin">
                <br>
                <div class="card">
                  <div class="card-header cardmtmheader">LISTA</div>
                  <div class="card-body">
                  <br>               
                    <div class="table-responsive table-hover">
                      <table id="tabladt" class="table">
                        <thead class="tabmtmheader">
                          <tr>
                            <th>N°</th>
                            <th>NOMBRE</th>
                            <th>DESCRIPCIÓN</th>
                            <th>ORGANIZADOR</th>
                            <th>FECHA</th>
                            <th>CERTIFICADO</th>
                            <th>ESTADO</th>
                            <th>TIPO</th>
                            <th>ACCION</th>
                          </tr>
                        </thead>
                        <tbody id="tabla_busqueda"></tbody>
                      
                      </table>
                    </div>

                  </div>
                </div>
              </div>
            <br>
            <div id="modalOrganizadores"></div>            
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
  <script src="assets/customs/plugins/datepicker/js/bootstrap-datepicker.js"></script>
  <script src="assets/customs/plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
  <script src="assets/customs/plugins/datatable/spanish_datatable.js"></script>
  <script src="js/eventos/evento_consultar.js"></script>

</body>
</html>