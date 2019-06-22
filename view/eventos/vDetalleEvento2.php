<!DOCTYPE html>
<html lang="es">
<!-- 1.- CGuerrero  04/04/2049 Registro de Evento -->
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
                        <li class="breadcrumb-item"><a href="index.php?page=evento&action=lista">Lista Evento</a></li>
                        <li class="breadcrumb-item active itemactiv" aria-current="page"></li>
                      </ol>
                    </nav>
                  </div>
                  <div class="col-md-6 titulovent">
                    <label class="col-sm-12 col-form-label"  style=""><b>DETALLE EVENTO</b></label>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                    <hr class="hrdivision">
                    <div class="card-body">
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>TIPO EVENTO</b></small>
                        <br>
                        <p class="pdeteve"><?php echo strtoupper($oevento->evento_tipo_nombre) ?> &nbsp 
                          <?php if ($oevento->tipo_evento_id == 1): ?>
                          <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Añadir" id="btn_aniadir">
                            <!-- <i class="mdi mdi-animation plus-diplo"></i> -->
                            <i class="mdi mdi-plus-circle-outline font-weight-bold ml-auto px-1 py-1 text-dark mdi-24px"></i>
                          </button>                             
                          <?php endif ?>
                          <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Añadir" id="btn_ver">
                            <!-- <i class="mdi mdi-animation plus-diplo"></i> -->
                            <i class="mdi mdi-plus-circle-outline font-weight-bold ml-auto px-1 py-1 text-dark mdi-24px"></i>
                          </button> 
                        </p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>TITULO</b></small>
                        <br>
                        <p class="pdeteve"><?php echo strtoupper($oevento->evento_nombre) ?></p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>DESCRIPCIÓN</b></small>
                        <br>
                        <p class="pdeteve"><?php echo $oevento->evento_descripcion ?></p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>ORGANIZADOR</b></small>
                        <br>
                        <p class="pdeteve">
                          <?php
                            foreach ($lorganizadores as $org) {
                              echo $org->nombre_organizador;
                              
                              if ($nro_org >1) {
                                echo " / ";
                              }
                              $nro_org++;
                            }
                          ?>
                        </p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>ESPECIALIDAD</b></small>
                        <br>
                        <p class="pdeteve">
                          <?php
                            foreach ($lespecialidades as $esp) {
                              echo $esp->nombre_especialidad;
                              
                              if ($nro_esp >1) {
                                echo " / ";
                              }
                              $nro_esp++;
                            }
                          ?>                          
                        </p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>PUBLICO OBJETIVO</b></small>
                        <br>
                        <p class="pdeteve">
                          <?php
                            foreach ($lpobjectivos as $pob) {
                              echo $pob->nombre_publico_objetivo;
                              
                              if ($nro_pob >1) {
                                echo " / ";
                              }
                              $nro_pob++;
                            }
                          ?>                          
                        </p>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                    <hr class="hrdivision">
                    <div class="card-body">
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>FECHA INICIO</b></small>
                        <br>
                        <p class="pdeteve"><?php echo $oevento_fecha_inicio ?></p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>FECHA FIN</b></small>
                        <br>
                        <p class="pdeteve"><?php echo $oevento_fecha_final ?></p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>HORA</b></small>
                        <br>
                        <p class="pdeteve"><?php echo $hora_am_pm ?></p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>LUGAR</b></small>
                        <br>
                        <p class="pdeteve"><?php echo $oevento->nombre_lugar ?></p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>CERTIFICADO</b></small>
                        <br>
                        <p class="pdeteve"><?php echo ($oevento->evento_certificado == true) ? 'SI' : 'NO' ; ?></p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>COSTO CERTIFICADO PUBLICO</b></small>
                        <br>
                        <p class="pdeteve"><?php echo $oevento->costo_certificado_publico ?></p>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-header cardmtmheader">FINANZAS</div>
                    <div class="card-body">
                      <br>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>COSTO PONENTE</b></small>
                        <br>
                        <p class="pdeteve">S/.<?php echo number_format(round(($oevento->costo_ponente_costo_evento), 2), 2, '.', ''); ?>&nbsp&nbsp</p>
                      </div>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>COSTO BREAK</b></small>
                        <br>
                        <p class="pdeteve">S/.<?php echo number_format(round(($oevento->costo_break_costo_evento), 2), 2, '.', ''); ?> &nbsp&nbsp</p>
                      </div>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>COSTO CERTIFICADO</b></small>
                        <br>
                        <p class="pdeteve">S/.<?php echo number_format(round(($oevento->costo_certificado_costo_evento), 2), 2, '.', ''); ?> &nbsp&nbsp</p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-2 wrapdeteve">
                        <small class="text-mutedsea" style="font-size: 17px"><b>TOTAL</b></small>
                        <br>
                        <p class="pdeteve"><b>S/.<?php echo number_format(round(($suma_costos), 2), 2, '.', '') ?> &nbsp&nbsp</b></p>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
                    
              <br><br>
              <div class="row">
                <div class="col-md-3 grid-margin stretch-card">
                  <div class="card ">
                    <img src="<?php echo $oevento->evento_foto ?>" alt="sample" class="rounded mw-100">
                  </div>
                </div>
                <div class="col-md-9 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-header cardmtmheader">
                      <div class="row">
                        <div class="col-md-11">LISTA DE INSCRITOS</div><br>
                        <div class="col-md-1">
                          <button type="button" class="btn btn-export btn-rounded btn-icon" data-toggle="tooltip" data-placement="left" title="" data-original-title="Exportar">
                            <i class="mdi mdi-file-excel"></i>
                          </button>
                        </div>   
                    </div>
                    </div>
                    <div class="card-body">
                    <br>               
                      <div class="table-responsive">
                        <table id="tabladt" class="table">
                          <thead>
                            <tr>
                                <th>N°</th>
                                <th>DNI</th>
                                <th>NOMBRE y APELLIDOS</th>
                                <th>TIPO de ASISTENTE</th>
                                <th>ASISTENCIA</th>
                                <th>TELÉFONO</th>
                                <th>FECHA REGISTRO</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td>01</td>
                                <td>12345678</td>
                                <td>Lorem Ipsum Lorem</td>
                                <td>Juez</td>
                                <td>Asistió</td>
                                <td>01/05/2019</td>
                            </tr>
                            <tr>
                                <td>02</td>
                                <td>12345678</td>
                                <td>Lorem Ipsum Lorem</td>
                                <td>Externo</td>
                                <td>No Asistió</td>
                                <td>01/05/2019</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div id="div_modales"></div>

              <?php require'view/general/vFooter.php' ?>  
          </div>
        </div>
    <?php require'view/general/lScript.php' ?>
    <script src="assets/js/data-table.js"></script>
    <script src="js/eventos/evento_aniadir.js"></script>
 <!--    <script>
      
      $(document).on('click', '#btn_modulos', function(event) {
        event.preventDefault();
        /* Act on the event */
        // window.location.href = 'index.php?page=evento&action=modulo&key=<?php// echo $_GET['key'] ?>';
      });

    </script> -->
</body>

</html>