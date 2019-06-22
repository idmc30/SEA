<!DOCTYPE html>
<html lang="es">
<!-- 1.- CGuerrero  04/04/2049 Registro de Usuario -->
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
                    <li class="breadcrumb-item"><a href="#">Registro</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px"></li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label"  style="font-size: 30px;"><b>REGISTRO DE USUARIOS-PERFILES</b></label>
              </div>
            </div>
          </div>
          <!-- --------------------------------------------- -->
            <br>
            <div class="row">
            <div class="col-lg-5 grid-margin stretch-card">
            <div class="card">
              <div class="card-header cardmtmheader">REGISTRO DE USUARIO-PERFIL</div>
              <div class="card-body">
                <div class="auth-form-transparent text-left p-3">              
                  <form class="pt-3" id="frmRegistro" name="frmRegistro">
                  <div class="form-group row">
                   
                        <div class="col-lg-12">
                            <label>Perfil</label>
                            <select class="js-example-basic-single" style="width:100%" id="cmbRol" name="cmbRol">                          
                            <option value="0" selected="selected" disabled>Seleccionar Perfil</option>
                            <?php foreach ($lrol as $rol): ?>
                                <option value="<?php echo $rol->id_rol_usuario ?>"><?php echo $rol->nombre_rol_usuario ?></option>
                                <?php endforeach ?>                            
                            </select>
                        </div>
                            </div>
                        <br>
                        <div class="form-group">
                        <label>DNI</label>
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                            <span class="input-group-text bg-transparent border-right-0">
                                <i class="mdi mdi-account-card-details text-primary"></i>
                            </span>
                            </div>
                            <!-- <input name="txtIdPersona" id="txtIdPersona" type="text" class="form-control" placeholder="ID Persona" value="0" hidden /> -->
                            <input name="txtIdPersona" id="txtIdPersona" type="text" class="form-control" placeholder="ID Persona" value="0" hidden />
                            <input id="txtDNI" name="txtDNI" type="text" class="form-control form-control-lg border-left-0" placeholder="DNI" maxlength="8" onkeypress="return soloNumeros(event)" autofocus="" value="" onblur="ValidarDNI(this.value)" tabindex="10">
                        </div>
                        <label name="lblDni"></label>
                        </div>
                        
                        <div class="form-group">
                        <label>Apellido Paterno</label>
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                            <span class="input-group-text bg-transparent border-right-0">
                                <i class="mdi mdi-account-outline text-primary"></i>
                            </span>
                            </div>
                            <input id="txtapepaterno" name="txtapepaterno" type="text" class="form-control form-control-lg border-left-0" placeholder="Apellido Paterno">
                        </div>
                        </div>
                        <div class="form-group">
                        <label>Apellido Materno</label>
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                            <span class="input-group-text bg-transparent border-right-0">
                                <i class="mdi mdi-account-outline text-primary"></i>
                            </span>
                            </div>
                            <input id="txtapematerno" name="txtapematerno" type="text" class="form-control form-control-lg border-left-0" placeholder="Apellido Materno">
                        </div>
                        </div>
                        <div class="form-group">
                        <label>Nombres</label>
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                            <span class="input-group-text bg-transparent border-right-0">
                                <i class="mdi mdi-account-outline text-primary"></i>
                            </span>
                            </div>
                            <input id="txtnombres" name="txtnombres" type="text" class="form-control form-control-lg border-left-0" placeholder="Nombres">
                        </div>
                        </div>
                        
                        <div class="form-group">
                        <label>Correo</label>
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                            <span class="input-group-text bg-transparent border-right-0">
                                <i class="mdi mdi-email-outline text-primary"></i>
                            </span>
                            </div>
                            <input id="txtCorreo" name="txtCorreo" type="email" class="form-control form-control-lg border-left-0" placeholder="Correo" tabindex="20">
                        </div>
                        </div>

                        <div class="form-group">
                        <label>Teléfono</label>
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                            <span class="input-group-text bg-transparent border-right-0">
                                <i class="mdi mdi-cellphone text-primary"></i>
                            </span>
                            </div>
                            <input id="txtTelefono" name="txtTelefono" type="text" class="form-control form-control-lg border-left-0" placeholder="Teléfono" maxlength="9" onkeypress="return soloNumeros(event)" tabindex="30">
                        </div>
                        </div>

                        <div class="form-group">
                        <label>Anexo</label>
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                            <span class="input-group-text bg-transparent border-right-0">
                                <i class="mdi mdi-deskphone text-primary"></i>
                            </span>
                            </div>
                            <input id="txtAnexo" name="txtAnexo" type="text" class="form-control form-control-lg border-left-0" placeholder="Anexo" maxlength="31" onkeypress="return soloNumeros(event)" tabindex="30">
                        </div>
                        </div>

                        <div class="form-group">
                        <label>Contraseña</label>
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                            <span class="input-group-text bg-transparent border-right-0">
                                <i class="mdi mdi-lock-outline text-primary"></i>
                            </span>
                            </div>
                            <input id="txtContrasena" name="txtContrasena" type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Contraseña" tabindex="40">                        
                        </div>
                        </div>
                    <br>
                    <div class="mt-3" style="text-align: center;">
                      <button type="submit" class="btn btn-inverse-info btn-fw btn-lg font-weight-medium auth-form-btn">Registrarse</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            </div>            
          
            <div class="col-lg-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-header cardmtmheader">LISTA DE USUARIOS</div>
                <div class="card-body">
                <br>               
                  <div class="table-responsive table-hover">
                    <table id="tabladt" class="table">
                      <thead class="tabmtmheader">
                        <tr>
                          <th>N°</th>
                          <th>DNI</th>
                          <th>NOMBRE Y APELLIDOS</th>
                          <th>Perfil</th>
                          <th>Estado</th>
                          <th>ACCION</th>
                        </tr>
                      </thead>
                      <tbody id="listadousuarios">
                         
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
  <?php require 'view/general/lScript.php' ?>
  <script src="assets/js/select2.js"></script>
  <script src="assets/js/data-table.js"></script>
  <script src="assets/customs/plugins/datatable/spanish_datatable.js"></script>
  <script>
    $('#tabladt').DataTable({
        "bLengthChange": false,
        "lengthMenu": [10],
        "language": spanish_datatable
    });
  </script>
  <script type="text/javascript" src="js/jUsuario.js"></script>
</body>

</html>
