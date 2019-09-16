<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header text-white bg-primary" >
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?> &nbsp&nbsp &nbsp&nbsp</h5>
              <select class="form-control" name="tipo" id="tipo">
                <option selected disabled>Seleccionar...</option>
                <?php foreach ($ltipos as $tipo): ?>
                  <option value="<?php echo $tipo->evento_tipo_id ?>"  <?php echo $retVal = ($response['idtipoEvento']==$tipo->evento_tipo_id) ? "selected" : "" ;?> ><?php echo $tipo->evento_tipo_nombre ?></option>
                <?php endforeach ?>                
              </select>        
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white"><b>x</b></span>
        </button>
      </div>
      <div class="modal-body">
        <div>
         <input type="hidden" id="txtcodevento" name="txtcodevento" value="<?php echo  $codEvento = ($response['codEvento']) ? base64_encode($response['codEvento']): "" ;?>">
          <div class="form-group row">
            <label  class="col-sm-3 col-form-label"><b>Nombre</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre = ($response['nombreEvento']) ? 		$response['nombreEvento'] : "" ; ?>" >
            </div>
          </div>
          <div class="form-group row">
            <label  class="col-sm-3 col-form-label"><b>Descripcion</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo  $descripcion = (	$response['descripcionEvento']) ? 	$response['descripcionEvento'] : "" ; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label  class="col-sm-3 col-form-label"><b>Fecha Inicio</b></label>
            <div class="col-sm-3">
              <input type="text" class="form-control fechas" id="fecha_i" name="fecha_i" value="<?php echo $fecha_inicio = ($response['fechaInicioEvento']) ? 	$response['fechaInicioEvento'] : "" ; ?>">
            </div>
            <label  class="col-sm-3 col-form-label"><b>Hora Inicio</b></label>
            <div class="col-sm-3">
              <input type="text" class="form-control timer" id="hora_i" name="hora_i" value="<?php echo $hora_inicio = ($response['horainicio']) ? $response['horainicio'] : ""?>">
            </div>
          </div>
          <div class="form-group row">
            <label  class="col-sm-3 col-form-label"><b>Fecha Fin</b></label>
            <div class="col-sm-3">
              <input type="text" class="form-control fechas" id="fecha_f" name="fecha_f" value="<?php echo $fecha_final = ($response['fechaFinal']) ? $response['fechaFinal'] : "" ;?>">
            </div>
            <label  class="col-sm-3 col-form-label"><b>Hora Fin</b></label>
            <div class="col-sm-3">
              <input type="text" class="form-control timer" id="hora_f" name="hora_f" value="<?php echo $hora_inicio = ($response['horafinal']) ? $response['horafinal'] : ""?>"">
            </div>
          </div>
          <input type="hidden" id="key_evento" value="<?php echo base64_encode($key) ?>">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark  mr-auto" data-dismiss="modal"><i class="fa fa-reply"></i> Cerrar</button>
        <button type="button" class="btn btn-primary bg-primary" id="btn_guardar" data-modo="<?php echo $modo ?>"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>