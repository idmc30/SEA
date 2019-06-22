<!DOCTYPE html>
<html lang="es">
<!-- 1.- CGuerrero  04/04/2049 Lugar de Evento -->
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
                    <li class="breadcrumb-item"><a href="#">Registro</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-align: right;font-size: 15px"></li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6" style="text-align:right;">
                <label class="col-sm-12 col-form-label"  style="font-size: 30px;"><b>INSCRIPCION MANUAL DE PARTICIPANTES</b></label>
              </div>
            </div>
          </div>
          <br><br>
          <div class="row">
            <div class="card col-md-5">
              <div class="moving-square-loader" id="cargando" name="cargando" hidden></div>
              <div class="card">                  
                <div class="card-header cardmtmheader">INSCRIPCIÓN</div>
                <div class="card-body">  
                 <br>
                  <form class="form-sample" id="frminscripcion" name="frminscripcion">
                
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label"><b>Evento</b></label>
                      <div class="col-sm-8">
                        <select class="js-example-basic-single" style="width:100%" id="cmbevento" name="cmbevento">                          
                          <option value="0" selected="selected" disabled>Seleccionar Evento</option>
                          <?php foreach ($levento as $evento): ?>
                              <option value="<?php echo $evento->evento_id ?>"><?php echo $evento->evento_nombre ?></option>
                             <?php endforeach ?>                            
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <!-- <label class="col-sm-4 col-form-label"><b>DNI</b></label>
                      <div class="col-sm-8">
                        <input id="txtDNI" name="txtDNI" type="text" class="form-control" placeholder="DNI" maxlength="8"  onkeypress="return soloNumeros(event)"  value=""  tabindex="10">                          
                      </div> -->
                          <label  class="col-sm-4 col-form-label"><b>Usuarios</b></label>
                          <div class="col-sm-8">
                            <select class="js-example-basic-single" style="width:100%" id="cmbusuario" name="cmbusuario">                    <option value="0" selected="selected" disabled>Seleccionar Usuario</option>                                      
                               <?php foreach ($lusuario as $usuarios): ?>
                                  <option value="<?php echo $usuarios->id_usuario ?>"><?php echo $usuarios->dni_usuario.'-'.$usuarios->ape_paterno.' '.$usuarios->ape_materno.' '.$usuarios->nombre_persona ?></option>
                                <?php endforeach ?>                            
                            </select>                          
                        </select>
                      </div>
                    </div>
                     
                    <!-- <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><b>Nombre y Apellidos</b></label>
                      <div class="col-sm-8">
                        <input name="txtParticipante" id="txtParticipante" type="text" class="form-control" placeholder="Nombre y Apellidos" disabled="" />
                      </div>
                    </div> -->
                    <!-- <input type="text" id="txtid" name="txtid"> -->
                    
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label"><b>Tipo</b></label>
                      <div class="col-sm-8">
                        <select class="js-example-basic-single" style="width:100%" id="cmbtipo" name="cmbtipo">                          
                          <option value="0" selected="selected" disabled>Seleccionar Tipo</option>                                                   
                          <?php foreach ($ltipoParticipante as $tipoparticipante): ?>
                              <option value="<?php echo $tipoparticipante->tipopar_id ?>"><?php echo $tipoparticipante->tipopar_nombre ?></option>
                             <?php endforeach ?>                            
                        </select>                          
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group row" id="estado_tipo_organizador"><!-- condicional a tipo-->
                      <label  class="col-sm-4 col-form-label"><b>Organizador</b></label>
                      <div class="col-sm-8">
                        <select class="js-example-basic-single" style="width:100%" id="cmborganizador" name="cmborganizador">                          
                          <option value="0" selected="selected" disabled>Seleccionar Tipo</option>                               
                             <?php foreach ($lorganizador as $organiazador): ?>
                                 <option value="<?php echo $organiazador->id_organizador ?>"><?php echo $organiazador->nombre_organizador ?></option>
                             <?php endforeach ?>   
                        </select>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row" id="estado_certificado"><!-- condicional a evento-->
                    <label class="col-sm-4 col-form-label"><b>Certificado</b></label>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="certificado" id="certificadotrue" value="si"  placeholder="Certificado">
                          Si
                        <i class="input-helper"></i></label>
                      </div>                          
                    </div>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="certificado" id="certificadofalse" value="no" >
                          No
                        <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <br><br><br>
                  </div>
                  <br>
                    <div class="row">
                      <div class="col-md-4"></div>
                      <div class="col-md-3">
                        <button type="submit" class="btn btn-inverse-info btn-fw" >Inscribir</button>                    
                      </div>                    
                    </div>
                </form>                   
              </div>                                  
              </div>                  
            </div>
            <div class="col-lg-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-header cardmtmheader">PARTICIPANTES</div>
                  <div class="card-body">
                  <br>               
                    <div class="table-responsive table-hover">
                      <table id="tabladt" class="table">
                        <thead class="tabmtmheader">
                          <tr>
                            <th>N°</th>                              
                            <th>DNI</th>
                            <th>NOMBRE Y APELLIDOS</th>
                            <th>TIPO</th>
                            <th>CERTIFICADO</th><!-- Condicional a evento -->
                            <th>DESINSCRIBIR</th>
                          </tr>
                        </thead>
                        <tbody id="listadoinscritos">
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        
        <?php require'view/general/vFooter.php' ?>        
      </div>
    </div>
  </div> 
  <?php require'view/general/lScript.php' ?>
  <script src="assets/js/select2.js"></script>
  <script src="assets/js/data-table.js"></script>
  <script src="assets/customs/plugins/datatable/spanish_datatable.js"></script>
  <script>
    $('#tabladt').DataTable({
        "bLengthChange": false,
        "lengthMenu": [10],
        "language": spanish_datatable
    });
  </script>
  <script src="js/jInscripcionManual.js"></script>
</body>

</html>
