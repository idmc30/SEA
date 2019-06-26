<!DOCTYPE html>
<html lang="es">  
<!-- 1.- CGuerrero  04/04/2049 Listado de eventos Activos para cotrol de Asistencia -->
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
                    <li class="breadcrumb-item"><a href="#">Asistencia</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px"></li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label"><h2><b>EVENTOS ACTIVOS</b></h2></label>
              </div>
            </div>
          </div>
          <br>
            <div class="card">
              <div class="card-header cardmtmheader"></div>
              <div class="col-md-12 grid-margin">
               <!-- Inicio de filtro por evento y tipo de asistente  -->
               <br>
                <div class="card-body" style="font-size: 0rem;">
                  <div class="row">
                    <div class="table-responsive">
                      <table id="tabladt" class="table">
                        <thead>
                          <tr style="text-align: center; background: #282f3a; color: #fff">
                            <th>N°</th>
                            <th>NOMBRE</th>
                            <th>DESCRIPCIÓN</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>LUGAR</th>
                            <th>PONENTE</th>
                            <th>ACCION</th>
                            <th>ASISTENCIA</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $c = 1; ?>
                          <?php foreach ($listaEventoActivo as $eventoActivo): ?>
                          <tr>
                            <td><?php echo $c ?></td>
                            <td><?php echo $eventoActivo->evento_nombre ?></td>
                            <td><?php echo $eventoActivo->evento_descripcion ?></td>
                            <?php
                              list($ano,$mes,$dia) = explode('-',$eventoActivo->evento_fecha_inicio);
                              $fecha_inicio_evento = $dia.'/'.$mes.'/'.$ano;
                            ?>
                            <td><?php echo $fecha_inicio_evento ?></td>
                            <td><?php echo $eventoActivo->evento_hora_inicio ?></td>
                            <?php $nombre_lugar = $objEvento->consultarNombreLugar($eventoActivo->lugar_id) ?>
                            <td><?php echo $nombre_lugar ?></td>
                            <?php $id_usuario = $objEvento->consultarUsuarioByIDEvento($eventoActivo->evento_id) ?>
                            <?php $nombre_ponnete = $objEvento->consultarNombrePonente($id_usuario) ?>
                            <?php $response = array(); ?>
                            <?php $response['nombre'] = $nombre_ponnete->nombre_persona ?>
                            <?php $response['appaterno'] = $nombre_ponnete->ape_paterno ?>
                            <?php $response['apmaterno'] = $nombre_ponnete->ape_materno ?>
                            <td><?php echo $response['nombre'].' '.$response['appaterno'].' '.$response['apmaterno'] ?></td>
                            <td class="tablamtmsaccion">
                              <a href="" onClick="reprograma('<?php echo $eventoActivo->evento_id ?>');" data-toggle="modal" data-target="#reprogramar">
                                <i class="icon-clock" data-toggle="tooltip" data-placement="left" title="" data-original-title="Reprogramar"></i>
                              </a>
                              &nbsp&nbsp
                              <a href="" onClick="cancelar('<?php echo $eventoActivo->evento_id ?>');" data-toggle="modal" data-target="#cancelar">
                                <i class="icon-ban" data-toggle="tooltip" data-placement="left" title="" data-original-title="Cancelar"></i></a>
                            </td>
                            <td style="text-align: center;">
                              <a href="index.php?page=asistencia&action=asistencia&idEvento=<?php echo $eventoActivo->evento_id ?>">
                                <?php if ($id_usuario) {?>
                                  <div class="badge badge-warning badge-fw">Controlar</div>
                                <?php }else{ ?>
                                  <button class="badge badge-secondary badge-fw" disabled>Controlar</button>
                                <?php } ?>
                              </a>
                            </td>
                          </tr>
                          <?php $c = $c+1; ?>                  
                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </div>  
                </div> 
              <br>              
            </div>
            </div>

              <!-- INICIO DE MODAL REPROGRAMAR-->
                <div class="modal fade" id="reprogramar" name="reprogramar" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form class="form-sample" id="frmReprograma" name="frmReprograma">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-2">NOMBRE DE EVENTO</h5>
                      </div>
                      <div class="modal-body">
                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Fecha Inicio</b></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control fechas" id="fechaInicioEvento" name="fechaInicioEvento">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Fecha Fin</b></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control fechas" id="fechaFinEvento" name="fechaFinEvento">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Hora</b></label>
                        <div class="col-sm-8">
                          <div class="input-group date" id="timepicker-example" data-target-input="nearest">
                            <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                              <input type="text" class="form-control datetimepicker-input" data-target="#timepicker-example" id="HoraEvento" name="HoraEvento">
                              <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Comentario</b></label>
                        <div class="col-sm-8">
                          <textarea class="form-control" id="comentario" name="comentario" rows="4" placeholder="Comentario"></textarea>
                        </div>
                      </div>
                      </div>
                      <input hidden type="" id="txtIdEventoReprograma" name="txtIdEventoReprograma">
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-rounded btn-fw" onclick="Reprograma()">Reprogramar</button>
                        &nbsp&nbsp
                        <button type="button" class="btn btn-secondary btn-rounded btn-fw" onclick="CerrarReprograma()">Cancelar</button>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
              <!-- FIN DE MODAL REPROGRAMAR-->
                
              <!-- INICIO DE MODAL CANCELAR-->
                <div class="modal fade" id="cancelar" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form class="form-sample" id="frmCancelar" name="frmCancelar">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-2">NOMBRE DE EVENTO</h5>
                      </div>
                      <div class="modal-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Comentario</b></label>
                        <div class="col-sm-8">
                          <textarea class="form-control" id="comentarioCancelacion" name="comentarioCancelacion" rows="4" placeholder="Comentario"></textarea>
                        </div>
                      </div>
                      </div>
                      <input hidden type="" id="txtIdEventoCancelar" name="txtIdEventoCancelar">
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-rounded btn-fw" onclick="CancelarEvento()">Cancelar Evento</button>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
              <!-- FIN DE MODAL CANCELAR-->
        </div>
        
        <?php require'view/general/vFooter.php' ?>        
      </div>
    </div>
  </div> 
  <?php require'view/general/lScript.php' ?>
 
 <script src="assets/customs/plugins/datatable/spanish_datatable.js"></script>
  <script>
    $('#tabladt').DataTable({
        "bLengthChange": false,
        "lengthMenu": [10],
        "language": spanish_datatable
    });
  </script>
  <script type="text/javascript" src="js/jPonente.js"></script>
  <script src="assets/customs/plugins/datepicker/js/bootstrap-datepicker.js"></script>
  <script src="assets/customs/plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
  <script>
    $('.fechas').datepicker({
      language: "es",
      autoclose: true,
      todayHighlight: true
    });
      $('#timepicker-example').datetimepicker({
        format: 'LT'
      }); 
  </script>
</body>

</html>
