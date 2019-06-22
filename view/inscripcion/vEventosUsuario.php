<!DOCTYPE html>
<html lang="es">  
<!-- 1.- CGuerrero  04/04/2049 Lista de Eventos Inscrios de Usuarios -->
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
                    <li class="breadcrumb-item"><a href="index.php?page=inicio&action=inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Mis Eventos</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px"></li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label"  style="font-size: 30px;"><b>EVENTOS INSCRITO</b></label>
              </div>
            </div>
          </div>

            <div class="col-md-12 grid-margin">
              <div class="card">              
              <div class="card-header cardmtmheader"></div>
              <div class="card-body">
                <!-- Inicio de tabla listado de eventos -->
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="table">
                      <tbody>
                        <?php if ($lmisevento): ?>
                            <?php foreach ($lmisevento as $evento): ?>
                              
                              <tr>
                                  <td style="text-align: right;">
                                  <?php 
                                    $fecha_inicio = date_create($evento->evento_fecha_inicio);
                                    
                                  ?>
                                    <h4><?php  echo date_format($fecha_inicio, 'd-m-Y'); ?></h4>
                                    <br>
                                    <b><?php echo $evento->evento_hora_inicio ?></b>
                                  </td>
                                  <td>
                                    <?php if ($evento->evento_fecha_reprogramacion==null): ?>
                                        <p><?php echo $evento->evento_tipo_nombre .'   '. $evento->evento_estado_nombre;
                                        ?> 
                                        </p>
                                    <?php else: ?>
                                          <?php 
                                                $fecha_reprogramacion= date_create($evento->evento_fecha_reprogramacion);
                                          ?>
                                        <p><?php echo $evento->evento_tipo_nombre .'   '. $evento->evento_estado_nombre.'     '.date_format($fecha_reprogramacion,'d-m-Y').'   '.$evento->evento_hora_reprogramacion;?> 
                                            </p>
                                    <?php endif ?>
                                  
                                    <h3><b><?php echo $evento->evento_nombre ?></b></h3>
                                    <p><?php echo $evento->evento_descripcion ?> </p>
                                    <br>
                                    <p><?php echo $evento->nombre_lugar ?></p>
                                    <br>
                                  </td>
                                  <td>
                                    <img src="<?php echo $evento->evento_foto ?>" alt="image"/>
                                  </td>
                              </tr>
                            <?php endforeach ?>
	
                        <?php else: ?>
                                 <h4>Usted no se ha inscrito a ningun evento</h4>
                        <?php endif ?>   

                                
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- Fin de tabla listado de eventos -->
              </div>
              </div>
            </div>
        </div>        
        <?php require'view/general/vFooter.php' ?>        
      </div>
    </div>
  </div>   
 <?php require'view/general/lScript.php' ?>
</body>


</html>
