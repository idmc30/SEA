 <!DOCTYPE html>
<html lang="es">
<!-- 1.- CGuerrero  04/04/2049 Portada
Sus estilos e imágenes están en "assets/customs/portada".
Solo para el carousel se usa los estilos del template general. -->
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEA</title>

  <link href="assets/customs/portada/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="assets/customs/portada/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="assets/customs/portada/font/Monserrat/css.css" rel="stylesheet" type="text/css">
  <link href='assets/customs/portada/font/Kaushan/css.css' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <link href="assets/customs/portada/css/agency.min.css" rel="stylesheet">
  <link rel="shorcut icon" type="image/x-icon" href="assets/customs/portada/img/pj.ico">

  <!-- Inicio Links para carousel -->
  <link href="assets/vendors/css/vendor.bundle.base.css" rel="stylesheet">
  <link href="assets/vendors/css/vendor.bundle.addons.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- Fin Links para carousel -->

</head>

<body id="page-top">

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php"><b>SEA</b></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php?page=registro&action=form">Registrarse</a>
          </li>
          &nbsp&nbsp
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php?page=login&action=form">Acceder</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact"><b>Contáctanos</b></a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-heading text-uppercase">CORTE  SUPERIOR  DE JUSTICIA  DE  LAMBAYEQUE</div>
        <div class="row  intro-lead-in">
          <div class="col-md-4 logosub">
            <br><br>
            <img class="logoport" src="assets/customs/portada/img/ua_opt_sn.png">
          </div>            
          <div class="col-md-6 subtuaef">
            <br><br><br>
            <label style="font-size: 36px">UNIDAD ACADÉMICA</label>
            <br>
            <label style="font-size: 16px">ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE AUXILIARES JURISDICCIONALES Y ADMINISTRATIVOS</label>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section class="bg-light contactividades" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center" style="height: 90px;">
          <!-- <div><img src="assets/customs/portada/img/ua_opt.png" alt="image"/ style="width: 125px"></div>
          <br><br><br>  -->        
          <h2 class="section-headingg text-uppercase">Actividades Académicas</h2>
          <h3 class="section-subheadingg text-muted" style="color:#6c757d !important">Debe estar registrado para poder inscribirse</h3>
        </div>
      </div>
  <!-- Inicio Carousel de Actividades -->
      <div class="row grid-margin">
        <div class="col-lg-12">
          <div class="owl-carousel owl-theme loop">

          <?php if ($levento): ?>

                <?php  foreach ($levento as $evento): ?>
                  <div class="owl-item carafi">
                    
                    <img src="<?php echo $evento->evento_foto?>" alt="image"/>
                  </div>          
              
                <?php endforeach; ?> 

          <?php else: ?>
                <?php echo "<h4>No se econtraron registros</h4>"?>
          <?php endif ?>
         
          </div>
        </div>
        <div class="row col-lg-12">
          <div class="col-md-10"></div>
          <div><a class="portada" href="index.php?page=panel&action=actividades"><b style="font-size: 14px">VER TODAS...</b></a></div>
        </div>
        
      </div>
  <!-- Fin Carousel de Actividades -->
    </div>
  </section>
  <!-- Inicio de Contacto -->
  <!-- <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-headingg text-uppercase">Contáctanos</h2>
          <h3 class="section-subheadingg text-muted">El mensaje será recepcionado por Unidad Académica</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form id="contactForm" name="sentMessage" novalidate="novalidate">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" id="name" type="text" placeholder="Nombres y Apellidos" required="required" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="email" type="email" placeholder="Correo" required="required" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="phone" type="tel" placeholder="Teléfono" required="required" data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <textarea class="form-control" id="message" placeholder="Mensaje" required="required" data-validation-required-message="Please enter a message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Enviar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section> -->
  <!-- Fin de Contacto -->
  <!-- Inicio de Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-10"></div>
        <div >
          <span class="copyright" style="color: #dee2e6">Copyright &copy; <b>PJ_DEV</b> 2019</span>
        </div>        
      </div>
    </div>
  </footer>
  <!-- Fin de Footer -->
  <!-- Inicio de Script de portada-->
  <script src="assets/customs/portada/vendor/jquery/jquery.min.js"></script>
  <script src="assets/customs/portada/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/customs/portada/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="assets/customs/portada/js/jqBootstrapValidation.js"></script>
  <script src="assets/customs/portada/js/contact_me.js"></script>  
  <script src="assets/customs/portada/js/agency.min.js"></script>
  <!-- Fin de Script de portada-->
  <!-- Inicio de Script de carousel-->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <!-- Fin de Script de carousel-->
</body>

</html>
