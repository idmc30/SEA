<!DOCTYPE html>
<html lang="es">
<?php require 'view/general/lHead.php' ?>
<style type="text/css">
  .bootstrap-timepicker-widget.dropdown-menu.open {
    display: inline-block;
    z-index: 10000;
}
</style>

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
              <br><br>
              
              <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <hr class="hrdivision">
                    <div class="card-body">                      
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
                              if ($nro_org >1) {
                                echo ", ";
                              }                              
                              echo $org->nombre_organizador;
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
                              if ($nro_esp >1) {
                                echo ", ";
                              }                              
                              echo $esp->nombre_especialidad;                            
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
                              if ($nro_pob >1) {
                                echo ", ";
                              }                              
                              echo $pob->nombre_publico_objetivo;                            
                              $nro_pob++;
                            }
                          ?>                          
                        </p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>LUGAR</b></small>
                        <br>
                        <p class="pdeteve"><?php echo $oevento->nombre_lugar ?></p>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                  <div class="card">
                    <hr class="hrdivision">
                    <div class="card-body">
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>TIPO EVENTO</b></small>
                        <br>
                        <p class="pdeteve"><?php echo strtoupper($oevento->evento_tipo_nombre) ?></p>
                      </div>
                      <hr>
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
                <div class="col-md-3 grid-margin stretch-card">
                  <div class="card ">
                    <img src="<?php echo $oevento->evento_foto ?>" alt="sample" class="rounded mw-100">
                    <br>
                    <div class="card-header cardmtmheader">FINANZAS</div>
                    <div class="card-body">
                      <br>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>COSTO PONENTE</b></small>
                        <p class="pdeteve">S/.<?php echo number_format(round(($oevento->costo_ponente_costo_evento), 2), 2, '.', ''); ?>&nbsp&nbsp</p>
                      </div>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>COSTO BREAK</b></small>
                        <p class="pdeteve">S/.<?php echo number_format(round(($oevento->costo_break_costo_evento), 2), 2, '.', ''); ?> &nbsp&nbsp</p>
                      </div>
                      <div class="wrapper w-100 ml-3 wrapdeteve">
                        <small class="text-mutedsea"><b>COSTO CERTIFICADO</b></small>
                        <p class="pdeteve">S/.<?php echo number_format(round(($oevento->costo_certificado_costo_evento), 2), 2, '.', ''); ?> &nbsp&nbsp</p>
                      </div>
                      <hr>
                      <div class="wrapper w-100 ml-2 wrapdeteve">
                        <small class="text-mutedsea" style="font-size: 17px"><b>TOTAL</b></small>
                        <p class="pdeteve"><b>S/.<?php echo number_format(round(($suma_costos), 2), 2, '.', '') ?> &nbsp&nbsp</b></p>
                      </div>
                    </div>
                  </div>
                </div>                 
              </div>
                    
              <br><br>
              <input type="hidden" id="codigo_evento" value="<?php echo $_GET['key']?>">
              <div class="row">                
            
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-header cardmtmheader">
                      <div class="row">
                        <div class="col-md-10">LISTA DE ASISTENTES</div><br>
                        <div class="col-md-1">
                          <a id="exportarAsistentes" href="#" target="_blank" href="" style="color:#f39c12; font-size: 25px" data-toggle="tooltip" title="Exportar" class="btn btn-export btn-rounded btn-icon"><i class="mdi mdi-file-excel"></i></a>
                       </div>   
                    </div>
                    </div>
                    <div class="card-body">
                    <br>               
                      <div class="table-responsive">
                        <table id="tablaparticipante" class="table">
                          <thead>
                            <tr>
                                <th>N°</th>
                                <th>DNI</th>
                                <th>APELLIDOS Y NOMBRES</th>
                                <th>TIPO de ASISTENTE</th>
                                <th>FECHA ASISTENCIA</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $c=1; ?>
                          <?php foreach ($lparticipantes as $participante): ?>
                            <tr>
                                <td><?php echo $c; ?></td>
                                <td><?php echo $participante->dni_persona?></td>
                                <td><?php echo strtoupper($participante->ape_paterno.' '.$participante->ape_materno.' '.$participante->nombre_persona)?></td>
                                <td><?php echo $participante->tipopar_nombre?></td>                                   
                                <td><?php echo $participante->fecha_asistencia;?></td>
                                
                            </tr>
                            <?php $c=$c+1; ?>
                          <?php endforeach ?>
                           
                          
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
    <script>      
      $(document).on('click', '#btn_modulos', function(event) {
        event.preventDefault();
        window.location.href = 'index.php?page=evento&action=modulo&key=<?php echo $_GET['key'] ?>';
      });
    </script>
    <script src="assets/js/data-table.js"></script>
    <script src="assets/customs/plugins/datatable/spanish_datatable.js"></script>
    <script>
      $('#tablaitem').DataTable({
          "bLengthChange": false,
          "lengthMenu": [10],
          "language": spanish_datatable
      });
    </script>
    <script>
      $('#tablaparticipante').DataTable({
          "bLengthChange": false,
          "lengthMenu": [10],
          "language": spanish_datatable
      });
    </script>
   <script src="assets/customs/plugins/datepicker/js/bootstrap-datepicker.js"></script>
   <script src="assets/customs/plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
   <script src="js/eventos/evento_exportar_consulta.js"></script>
</body>

</html>