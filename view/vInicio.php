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
              <div class="col-md-3">
              </div>
              <div>
                <h1><b>SISTEMA DE EVENTOS ACADEMICOS</b></h1>
              </div>
           
            </div>
          </div>
          <div class="card col-md-12">
            <br>
            <div class="card-body">
              <div class="row">
               
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-header cardmtmheader">LISTA DE EVENTOS</div>
                    <div class="card-body">
                    <br>               
                      <div class="table-responsive table-hover">
                        <table id="tabladt" class="table">
                          <thead class="tabmtmheader">
                            <tr>                              
                              <th class="tabmtmth">AFICHE</th>
                              <th class="tabmtmth">NOMBRE</th>
                              <th class="tabmtmth">TIPO</th>
                              <th class="tabmtmth">ESTADO</th>
                              <th class="tabmtmth">ACCION</th>
                            </tr>
                          </thead>
                          <tbody id="listadoEventos">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                        <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="labelnombre"></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p id="pdescripcion"></p>
                                  <br>
                                  <label>Día: &nbsp<b id="fechainiciob"></b></label>
                                  <br>
                                  <label>Hora: &nbsp<b id="horab">8:00 a.m.</b></label>
                                  <br>
                                  <label>Lugar: &nbsp<b id="lugarb"></b></label>
                                  <br>
                                  <label>Costo de Certificado: s/.&nbsp<b id="labelcostrocertificado">Auditorio Central</b></label>
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
  <script type="text/javascript" src="js/jInicio.js"></script>
</body>

</html>
