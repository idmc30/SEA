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
                    <li class="breadcrumb-item"><a href="index.php?page=inicio&action=inicios">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Evento</a></li>
                    <li class="breadcrumb-item active itemactiv" aria-current="page"></li>
                  </ol>
                </nav>
              </div>
              <input type="hidden" id="key" value="<?php echo $_GET['key'] ?>">
              <div class="col-md-6 titulovent">
                <label class="col-sm-12 col-form-label"  style=""><b><?php echo strtoupper($oevento->evento_nombre) ?> - MODULOS</b></label>
              </div>
            </div>
          </div>

          <?php if (count($lmodulos) == 0): ?>
            <div class="card">
              <div class="card-header bg-primary text-white " style="background-color: #01579b !important;">
                SIN MODULOS AUN REGISTRADOS
                 <button class="float-right btn btn-light btn-xs btn_modalmodulos" style="margin-right: 0.5rem !important; font-size: 0.665rem !important;"  data-modo="add">+ Modulo</button>            
             </div>
             
          </div>  
          <br> 
          <?php else: ?>

            <?php foreach ($lmodulos as $mod): ?>
              <div class="card">
                <div class="card-header bg-primary text-white " style="background-color: #01579b !important;">
                  <?php echo  $mod->numero_modulo.'.- '.strtoupper($mod->nombre_modulo) ?>
                  <button class="float-right btn btn-warning btn-xs text-white btn_modalmodulos"  style="font-size: 0.665rem !important;" data-modo="edit" data-key="<?php echo base64_encode($mod->id_modulo) ?>">Editar</button>
                  <?php if ($mod->numero_modulo == 1): ?>
                   <button class="float-right btn btn-light btn-xs btn_modalmodulos" style="margin-right: 0.5rem !important; font-size: 0.665rem !important;"  data-modo="add">+ Modulo</button>            
                 <?php endif ?>

               </div>
               <div class="card-body">
                <div class="table-responsive col-md-12">
                  <table class="table  table-hover ">
                    <thead >
                      <th style="background-color: #2ab222c7 !important">Nº</th>
                      <th style="background-color: #2ab222c7 !important">Titulo</th>
                      <th style="background-color: #2ab222c7 !important">Fecha Inicio</th>
                      <th style="background-color: #2ab222c7 !important">Fecha Fin</th>
                      <th style="background-color: #2ab222c7 !important">Hora Inicio</th>
                      <th style="background-color: #2ab222c7 !important">Hora Fin</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>01</td>
                        <td>Sesion 1</td>
                        <td>15/15/2019</td>
                        <td>15/15/2019</td>
                        <td>10:00</td>
                        <td>13:00</td>
                      </tr>
                    </tbody>
                  </table>                    
                </div>
              </div>
            </div>  
            <br>              
          <?php endforeach ?>  
        <?php endif ?>







        <div id="div_modales"></div>

      </div>
      <?php require'view/general/vFooter.php' ?>  
    </div>
  </div>
  <?php require'view/general/lScript.php' ?>

  <script src="js/eventos/modulos.js"></script>

</body>

</html>              