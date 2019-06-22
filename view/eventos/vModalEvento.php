<!-- Modal -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-white bg-primary" >
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo_modal ?></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white"><b>x</b></span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <div class="form-group row">
            <label  class="col-sm-3 col-form-label"><b>Nombre</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Modulo" value="<?php echo $omodulo->nombre_modulo ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-3 col-form-label"><b>Fecha Inicio</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control fechas" id="fecha_inicio" placeholder="dd/mm/yyyy" value="<?php echo $fecha_inicio ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPassword" class="col-sm-3 col-form-label"><b>Fecha Fin</b></label>
            <div class="col-sm-9">
              <input type="text" class="form-control fechas" id="fecha_fin" placeholder="dd/mm/yyyy" value="<?php echo $fecha_final ?>">
            </div>
          </div>
          <input type="hidden" id="key_detalle" value="<?php echo base64_encode($id_modulo) ?>">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark  mr-auto" data-dismiss="modal"><i class="fa fa-reply"></i> Cerrar</button>
        <button type="button" class="btn btn-primary bg-primary" id="btn_guardar" data-modo="<?php echo $modo ?>"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>