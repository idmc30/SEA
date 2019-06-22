<!DOCTYPE html>
<html lang="en">
<!-- 1.- CGuerrero  04/04/2049 Registro de Usuario -->
<?php require 'view/general/lHead.php' ?>

<body class="sidebar-dark">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo" style="margin-bottom: 1rem">
                <a href="index.php">
                  <img src="assets/customs/imag/pjx63.png" alt="logo" style="width: 50px">
                  <b class="titulologin">SEA</b>
                </a>
              </div>
              
              <form class="pt-3" id="frmRegistro" name="frmRegistro">

                <div class="form-group">
                  <label>DNI</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-card-details text-primary"></i>
                      </span>
                    </div>
                    <input name="txtIdPersona" id="txtIdPersona" type="text" class="form-control" placeholder="ID Persona" value="0" hidden />
                    <input id="txtDNI" name="txtDNI" type="text" class="form-control form-control-lg border-left-0" placeholder="DNI" maxlength="8" onkeypress="return soloNumeros(event)" autofocus="" value="" onblur="ValidarDNI(this.value)" tabindex="10">
                  </div>
                  <label name="lblDni"></label>
                </div>
                
                <div class="form-group">
                  <label>Nombre y Apellidos</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input id="txtnombreApellidos" name="txtnombreApellidos" type="text" class="form-control form-control-lg border-left-0" placeholder="Nombre y Apellidos" readonly="readonly">
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
                
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Registrarse</button>
                </div>
              </form>
                <div class="text-center mt-4 font-weight-light">
                  ¿Ya tienes una cuenta? <a href="index.php?page=login&action=form" class="text-primary">Acceder</a>
                </div>
            </div>
          </div>
          <!-- Inicio de Footer -->
          <div class="col-lg-6 register-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2019  DEV_PJ</p>
          </div>
          <!-- Fin de Footer -->
        </div>
      </div>     
    </div>   
  </div> 
  <?php require 'view/general/lScript.php' ?>
  <script type="text/javascript" src="js/jRegistro.js"></script>
</body>

</html>
