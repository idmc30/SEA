 <!DOCTYPE html>
<html lang="es">
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
          <br><br><br>  -->        
          <h2 class="section-headingg text-uppercase">Actividades Académicas</h2>
          <h3 class="section-subheadingg text-muted" style="color:#6c757d !important">Debe estar registrado para poder inscribirse</h3>
        </div>
      </div>
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
    </div>
  </section>
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
  <script src="assets/customs/portada/vendor/jquery/jquery.min.js"></script>
  <script src="assets/customs/portada/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/customs/portada/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="assets/customs/portada/js/jqBootstrapValidation.js"></script>
  <script src="assets/customs/portada/js/contact_me.js"></script>  
  <script src="assets/customs/portada/js/agency.min.js"></script>
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
</body>

</html>
