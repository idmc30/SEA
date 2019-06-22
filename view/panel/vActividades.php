<!DOCTYPE html>
<html lang="es">
<!-- 1.- CGuerrero  04/04/2049 Lista de Actividades -->
<?php require 'view/general/lHead.php' ?>
<body class="sidebar-dark">
  <div class="container-scroller">
    <!-- 1.- CGuerrero  04/04/2049 Barra Superior -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php"><img src="assets/customs/imag/pjX63.png" style="width: 40px" /><b style="color: #9b9b9b">&nbspSEA</b></a><!-- Nombre completo -->
        <a class="navbar-brand brand-logo-mini" href="index.php?page=principal&action=principal"><img src="assets/customs/imag/pjx63.png" alt="logo"/></a><!-- Logo -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel" style="width: 125%">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                <form class="form-inline md-form mr-auto mb-4" action="index.php?page=panel&action=buscar&pagina=1" method="POST">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" id="search" name="search" class="form-control" placeholder="Tipo de evento" aria-label="Recipient's username">
                      <div class="input-group-append">
                        <button class="btn btn-sm btn-primary" type="submit">Buscar</button>
                      </div>
                    </div>
                  </div>
                </form>
                  <!-- Inicio listado de imágenes -->
                  <div class="row portfolio-grid">

                    <?php if ($numero_filas): ?>
                      <?php foreach ($resultado_limit as $evento): ?>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                          <figure class="effect-text-in">
                            <img src="<?php echo $evento->evento_foto ?>" alt="image"/>
                            <figcaption>
                              <h4 data-toggle="modal" data-target="#exampleModal-2"><?php echo strtoupper($evento->evento_nombre) ?></h4>
                              <p>
                                <a href="index.php?page=login&action=form"><button type="button" class="btn btn-dark btn-rounded btn-fw">Acceder</button></a>
                              </p>
                            </figcaption>
                          </figure>
                        </div>
                      <?php endforeach ?>                           
                      <?php else: ?>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                           <label for="">No se encontraron registros</label>
                         </div>    
                    <?php endif ?>             

                  </div>
                  <!-- Fin listado de imágenes -->
                  <!-- inicio Paginación -->
                  <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-">
                        <nav>
                          <ul class="pagination separated pagination-danger">
                            <li class="page-item
                            <?php 
                                echo $_GET['pagina']==1 ? 'disabled' :''
                            ?>">
                            <a class="page-link" href="index.php?page=panel&action=actividades&pagina=<?php echo $i-1;?>"><i class="mdi mdi-chevron-left"></i>
                            </a>
                            </li>
                            <?php for($i=0;$i<$paginas;$i++): ?>
                              <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active':'' ?>"><a class="page-link" href="index.php?page=panel&action=actividades&pagina=<?php echo $i+1;?>"><?php echo $i+1;?></a></li>                            
                            <?php endfor ?>
                            <li class="page-item
                            <?php 
                              echo $_GET['pagina']>=$paginas ? 'disabled' :''
                            ?>">
                            <a class="page-link" href="index.php?page=panel&action=actividades&pagina=<?php echo $_GET['pagina']+1 ?>"><i class="mdi mdi-chevron-right"></i></a></li>
                          </ul>
                        </nav>
                    </div>
                  </div>
                  <!-- Fin Paginación -->
                </div>
              </div>
              <!-- Fin listado de imágenes -->
              
        
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <b>INFORMATICA_CSJLA</b>. Todos los derechos reservados.</span>
          </div>
        </footer>
      </div>
    </div>
  </div>
</body>

</html>
