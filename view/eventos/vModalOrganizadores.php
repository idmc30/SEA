<!-- Modal -->
<div class="modal fade" id="modal_organizadores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-white bg-primary" >
        <h5 class="modal-title" id="exampleModalLabel">Listado de Organizadores</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white"><b>x</b></span>
        </button>
      </div>
      <div class="modal-body">
        <div>
            <ul>
               <?php foreach ($lorganizadores as $organizador): ?>
                      <li><?php echo $organizador->nombre_organizador ?></li>             
               <?php endforeach ?>               
            </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark  mr-auto" data-dismiss="modal"><i class="fa fa-reply"></i> Cerrar</button>  
      </div>
    </div>
  </div>
</div>