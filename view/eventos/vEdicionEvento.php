<!DOCTYPE html>
<html lang="es">
<?php require 'view/general/lHead.php' ?>
<link rel="stylesheet" href="assets/customs/plugins/datepicker/css/bootstrap-datepicker.css">
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
                    <li class="breadcrumb-item"><a href="#">Evento</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px"></li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label"><h2><b>REGISTRO DE EVENTO</b></h2></label>
              </div>
            </div>
          </div>

            <div class="col-md-12 grid-margin">
              <div class="card">
                <form class="card-body" id="form_registro" name="form_registro" action="#" method="POST">
                  <hr class="hrdivision">
                  <br>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Tipo Evento</b></label>
                        <div class="col-sm-8">
                          <select class="form-control" id="tipo_evento" name="tipo_evento">
                            <option disabled selected>Seleccionar</option>
                            <?php foreach ($ltiposeventos as $tipo): ?>
                              <option value="<?php echo $tipo->evento_tipo_id ?>" <?php echo ($tipo->evento_tipo_id == $oevento->tipo_evento_id) ? 'selected' : '' ; ?>><?php echo $tipo->evento_tipo_nombre ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Nombre</b></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $oevento->evento_nombre ?>" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Descripción</b></label>
                        <div class="col-sm-8">
                          <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Descripción"><?php echo $oevento->evento_descripcion ?></textarea>
                        </div>
                      </div>
                      <br>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Organizador</b></label>
                        <div class="col-sm-8">
                          <select class="form-control js-example-basic-single" id="organizador" name="organizador" style="width: 100%">
                            <option disabled selected>Seleccionar</option>
                            <?php foreach ($lorganizadores as $org): ?>
                              <option value="<?php echo $org->id_organizador ?>" <?php echo ($id_organizador == $org->id_organizador) ? 'selected' : '' ; ?>><?php echo $org->nombre_organizador ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Representante</b></label>
                        <div class="col-sm-8">
                          <select class="form-control js-example-basic-single" id="representante" name="representante" style="width: 100%">
                            <option disabled selected>Seleccionar</option>
                            <?php foreach ($lrepresentantes as $rep): ?>
                              <option value="<?php echo $rep->id_usuario ?>" <?php echo ($id_representante == $rep->id_usuario) ? 'selected' : '' ; ?>><?php echo $rep->nombre_persona ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>                      
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Especialidad</b></label>
                        <div class="col-sm-8">
                          <select class="js-example-basic-multiple" id="especialidades" multiple="multiple" style="width:100%;">                            
                            <?php foreach ($lespecialidades as $esp): ?>
                              <option value="<?php echo $esp->id_especialidad ?>" <?php echo (in_array($esp->id_especialidad, $levento_esp) == true) ? 'selected' : '' ; ?>><?php echo $esp->nombre_especialidad ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>                      
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Público Objetivo</b></label>
                        <div class="col-sm-8">
                          <select class="js-example-basic-multiple" id="pobjetivo"  multiple="multiple" style="width:100%;">
                            <?php foreach ($lpobjectivos as $pob): ?>
                              <option value="<?php echo $pob->id_publico_objetivo ?>" <?php echo (in_array($pob->id_publico_objetivo, $levento_pob) == true) ? 'selected' : '' ; ?> ><?php echo $pob->nombre_publico_objetivo ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Afiche</b></label>
                         <input type="file" name="img" class="file-upload-default">

                          <div class="input-group col-md-8 col-sm-8">
                            <input type="text" class="form-control file-upload-info" id="subir_imagen" name="subir_imagen" placeholder="Subir Imagen" value="<?php echo $imagen ?>">
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                          </div>

                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Fecha Inicio</b></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control fechas" id="fechainicioevento" name="fechainicioevento" value="<?php echo $oevento_fecha_inicio ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Fecha Fin</b></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control fechas" id="fechafinevento" name="fechafinevento" value="<?php echo $oevento_fecha_final ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Hora</b></label>
                        <div class="col-sm-8">
                          <div class="input-group date" id="timepicker-example" data-target-input="nearest">
                        <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                          <input type="text" class="form-control datetimepicker-input" data-target="#timepicker-example" id="hora" name="hora" value="<?php echo $hora_amp_pm ?>">
                          <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                        </div>
                      </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Lugar</b></label>
                        <div class="col-sm-8">
                          <select class="form-control" id="lugar" name="lugar">
                            <option disabled selected >Seleccionar</option>
                            <?php foreach ($listar_lugares as $lug): ?>
                              <option value="<?php echo $lug->id_lugar ?>" <?php echo ($lug->id_lugar == $oevento->lugar_id) ? 'selected' : '' ; ?>><?php echo $lug->nombre_lugar ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Certificado</b></label>
                        <div class="col-sm-4">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="certificado" id="certificado" value="si" <?php echo ($oevento->evento_certificado == true) ? 'checked' : '' ; ?>  placeholder="Certificado">
                              Si
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="certificado" id="certificado" value="no" <?php echo ($oevento->evento_certificado == false) ? 'checked' : '' ; ?>>
                              No
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Costo Certificado Público</b></label>
                        <div class="col-sm-8">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-primary text-white" style="background-color: #01579b !important;">S/.</span>
                            </div>
                            <input type="text" id="costo_certificado_publico" name="costo_certificado_publico" class="form-control moneda" value="<?php echo $oevento->costo_certificado_publico ?>">
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="card-header cardmtmheader">FINANZAS</div>
                  <br>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><b>Costo de Ponente</b></label>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-primary text-white" style="background-color: #01579b !important;">S/.</span>
                            </div>
                            <input type="text" id="costoponente" name="costoponente" class="form-control moneda" value="<?php echo $oevento->costo_ponente_costo_evento ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><b>Costo de Break</b></label>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-primary text-white" style="background-color: #01579b !important;">S/.</span>
                            </div>
                            <input type="text" id="costobreak" name="costobreak" class="form-control moneda" value="<?php echo $oevento->costo_break_costo_evento ?>">
                          </div>                          
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><b>Costo de Certificado</b></label>
                        <div class="col-sm-7">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-primary text-white" style="background-color: #01579b !important;">S/.</span>
                            </div>
                            <input type="text" id="costocertificado" name="costocertificado" class="form-control moneda" value="<?php echo $oevento->costo_certificado_costo_evento ?>">
                            <input type="hidden" name="key" value="<?php echo base64_encode($oevento->id_evento) ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-5"></div>
                      <button type="submit" class="btn btn-inverse-info mb-2"><i class="fa fa-floppy-o"></i> Guardar</button>                        
                  </div>
                </form>
              </div>
            </div>
        </div>
        
     

        <?php require'view/general/vFooter.php' ?>        
      </div>
    </div>
  </div> 
  <?php require'view/general/lScript.php' ?>

  <script src="assets/js/select2.js"></script>
  <script src="assets/js/file-upload.js"></script>
  <script src="assets/customs/plugins/datepicker/js/bootstrap-datepicker.js"></script>
  <script src="assets/customs/plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>

  <script src="js/eventos/evento_editar.js"></script>

</body>

</html>
