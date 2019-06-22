<!DOCTYPE html>
<html lang="en">
<!-- 1.- CGuerrero  04/04/2049 Login -->
<?php require 'view/general/lHead.php' ?>

<body class="sidebar-dark">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <a href="index.php">
                  <img src="assets/customs/imag/pjx63.png" alt="logo" style="width: 50px">
                  <b class="titulologin">SEA</b>
                </a>
              </div>

              <form class="pt-3" id="frmLogin" name="frmLogin">
                <div class="form-group">
                  <label for="exampleInputEmail">DNI</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input id="txtDNI" name="txtDNI" type="text" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="DNI" autofocus="" maxlength="8" onkeypress="return soloNumeros(event)">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Contraseña</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input id="txtContrasena" name="txtContrasena" type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Contraseña">                        
                  </div>
                </div>
                
                <div class="my-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Acceder</button>
                </div>
              </form>
                <div class="text-center mt-4 font-weight-light">
                  ¿No tienes cuenta? <a href="index.php?page=registro&action=form" class="text-primary">Regístrate</a>
                </div>
            </div>
          </div>
          <!-- Inico de Footer -->
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2019  DEV_PJ</p>
          </div>
          <!-- Fin de Footer -->
        </div>
      </div>  
    </div>
  </div>
  <?php require 'view/general/lHead.php' ?>
  <?php require 'view/general/lScript.php' ?>
  <script type="text/javascript" src="js/jLogin.js"></script>
</body>

</html>
