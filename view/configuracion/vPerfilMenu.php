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
                    <li class="breadcrumb-item"><a href="index.php?page=inicio&action=inicio">Configuraciones</a></li>
                    <li class="breadcrumb-item"><a href="#">Pefil Menu</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px"></li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label"  style="font-size: 30px;"><b>Perfil-Menu</b></label>
              </div>
            </div>
          </div>
            <br>
            <div class="row">
            <div class="col-lg-3 grid-margin stretch-card">
            <div class="card">
              <div class="card-header cardmtmheader">Perfil</div>
              <div class="card-body">
                <div class="auth-form-transparent text-left p-3">              
                  <div class="form-group row">
                      <div class="col-lg-12">
                        <select class="js-example-basic-single" style="width:100%" id="cmbRol" name="cmbRol">                          
                          <option value="0" selected="selected" disabled>Seleccionar Perfil</option>
                          <?php foreach ($lrol as $rol): ?>
                              <option value="<?php echo $rol->id_rol_usuario ?>"><?php echo $rol->nombre_rol_usuario ?></option>
                             <?php endforeach ?>                            
                        </select>
                      </div>
                    </div>
                    <br>
                </div>
              </div>
            </div>
            </div>            
          
            <div class="col-lg-9 grid-margin stretch-card">
              <div class="card">
                <div class="card-header cardmtmheader">LISTA DE Menu y SubMenu</div>
                <div class="card-body">
                <br>               
                  <div class="table-responsive table-hover">
                    <table id="tabladt" class="table">
                      <thead class="tabmtmheader">
                        <tr>
                         <th>Activar</th>
                          <th>N°</th>
                          <th>Nombre-Menu</th>
                          <th>Descripcion</th>
                          <th>Direccion</th>
                          <th>Nivel</th>
                        </tr>
                      </thead>
                      <tbody id="listadoMenus">                          
                      </tbody>
                    </table>
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
  <script src="assets/js/select2.js"></script>
  <script src="assets/customs/plugins/datatable/spanish_datatable.js"></script>
  <script>
  </script>
  <script type="text/javascript" src="js/jPerfilMenu.js"></script>
</body>

</html>
