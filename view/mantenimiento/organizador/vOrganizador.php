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
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px">
                    </li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label" style="font-size: 30px;"><b>ORGANIZADOR</b></label>
              </div>
            </div>
          </div>
              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-header cardmtmheader">REGISTRO</div>
                  <div class="card-body">
                    <br>
                    <form id="frmOrganizador" name="frmOrganizador" class="form-sample">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><b>Tipo</b></label>
                            <div class="col-sm-8">
                              <select id="cmbtipoorga" name="cmbtipoorga" class="form-control">
                                <option value="0" selected="selected" disabled>Seleccionar</option>
                                <?php  foreach ($ltipoOrg as $tipoOrg): ?>
                                     <option value="<?php echo $tipoOrg->id_tipo_organizador?>"><?php echo utf8_encode($tipoOrg->nombre_tipo_organizador)?></option>
                                  <?php endforeach; ?>  
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><b>Nombre</b></label>
                            <div class="col-sm-8">
                              <div class="form-group"> 
                                <input type="text" id="txtnombre" name="txtnombre" class="form-control" placeholder="Nombre" />
                             </div>
                             <input type="hidden" id="codorganizador" name="codorganizador">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><b>Teléfono</b></label>
                            <div class="col-sm-8">
                              <input type="text" id="txttelefono" name="txttelefono" class="form-control" placeholder="Teléfono"  maxlength="9" onkeypress="return soloNumeros(event)"/>
                            </div>     
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><b>Anexo</b></label>
                            <div class="col-sm-8">
                              <input type="text" id="txtanexo" name="txtanexo" class="form-control" placeholder="Anexo" maxlength="9" onkeypress="return soloNumeros(event)"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                      <div class="col-md-5"></div>
                      <div class="col-md-3">
                        <input type="submit"  id="btnorganizador" class="btn btn-inverse-info btn-fw" value="Guardar">
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <br><br>
              <div class="col-lg-12 grid-margin">
                <div class="card">
                  <div class="card-header cardmtmheader">LISTA</div>
                  <div class="card-body">
                  <br>               
                    <div class="table-responsive table-hover">
                      <table id="tabladt" class="table">
                        <thead class="tabmtmheader">
                          <tr>
                              <th>N°</th>
                              <th>TIPO</th>
                              <th>NOMBRE</th>                              
                              <th>TELEFONO</th>
                              <th>ANEXO</th>
                              <th>ACCION</th>
                          </tr>
                        </thead>
                        <tbody id="lorganizador"></tbody>
                      
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
  <script src="js/jOrganizador.js"></script>
</body>

</html>