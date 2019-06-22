<!DOCTYPE html>
<html lang="es">
<!-- 1.- CGuerrero  04/04/2049 Perfil de Usuario -->
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
              <div class="card">
                <div class="card-header cardmtmheader"></div>
                <!-- Inicio de vista superior de perfil -->
                <div class="row">
                  <div class="col-lg-6">
                    <br><br>
                      <div class="text-center pb-4">
                        <img id="imagen" name="imagen" src="" alt="profile" class="img-lg rounded-circle mb-3"/>
                        <br>
                        <h3><?php echo $response['nombres'].' '.$response['appaterno'].' '.$response['apmaterno'] ?></h3>
                        <p><b><?php echo $response['dni'] ?></b></p><!-- DNI -->
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <br>
                    <div class="py-4">
                      <p class="clearfix">
                        <span class="float-left">Actividades Asistidas</span>
                        <span class="float-right text-muted" style="color: #01579b !important;"><?php echo $cantidadAsistencia->asistencia ?></span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">Certificados Solicitados</span>
                        <span class="float-right text-muted" style="color: #01579b !important;"><?php echo $cantidadCertificado->certificado ?></span>
                      </p>
                    </div>

                    <div class="py-4">
                      <p class="clearfix">
                        <span class="float-left">Correo</span>
                        <span class="float-right text-muted" style="color: #01579b !important;"><?php echo $response['correo'] ?></span>
                      </p>

                      <p class="clearfix">
                        <span class="float-left">Teléfono</span>
                        <span class="float-right text-muted" style="color: #01579b !important;"><?php echo $response['telefono'] ?></span>
                      </p>
                    </div>
                  </div>
                </div>
                <!-- Fin de vista superior de perfil -->
                <hr class="hrdivision" />
                <!-- Inicio de tabs de perfil -->
                <div class="card-body">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="true">Actividades</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Personal</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <!-- Inico de detalle de actividades -->
                    <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                      <?php foreach ($eventoParticipante as $participante): ?>
                        <div class="d-flex align-items-start profile-feed-item">
                          <img src="<?php echo $participante->evento_foto ?>" alt="profile" class="img-sm rounded-circle">
                          <div class="ml-4">
                            <h6><?php echo $participante->evento_nombre ?>
                              <?php list($ano, $mes, $dia) = explode('-',$participante->evento_fecha_inicio); ?>
                              <?php $fecha_inicio_evento = $dia.'/'.$mes.'/'.$ano ?>
                              <small class="ml-4 text-muted"><?php echo $fecha_inicio_evento ?><i class="mdi mdi-clock mr-1"></i><?php echo $participante->evento_hora_inicio ?></small>
                            </h6>
                            <p>
                              <?php echo $participante->evento_descripcion ?>
                            </p>
                          </div>
                        </div>
                      <?php endforeach ?>
                    </div>
                    <!-- Fin de detalle de actividades -->
                    <!-- Inicio de datos personales -->
                    <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                      <form class="form-sample" id="frmPerfil" name="frmPerfil">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">DNI</label>
                              <div class="col-sm-8">
                                <input hidden id="txtFoto" name="txtFoto" type="text" class="form-control form-control-sm" placeholder="Foto" value="<?php echo $response['foto'] ?>" />
                                <input id="txtDNI" name="txtDNI" type="text" class="form-control form-control-sm" placeholder="DNI" maxlength="8" autofocus="" value="<?php echo $response['dni'] ?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Profesion</label>
                              <div class="col-sm-8">
                                <input id="txtProfesion" name="txtProfesion" type="text" class="form-control form-control-sm" placeholder="Profesion" value="<?php echo $response['profesion'] ?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Nombres</label>
                              <div class="col-sm-8">
                                <input id="txtNombres" name="txtNombres" type="text" class="form-control form-control-sm" placeholder="Nombres" value="<?php echo $response['nombres'] ?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Correo</label>
                              <div class="col-sm-8">
                                <input id="txtCorreo" name="txtCorreo" type="email" class="form-control form-control-sm" placeholder="Correo" value="<?php echo $response['correo'] ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Apellidos</label>
                              <div class="col-sm-8">
                                <input id="txtApellidos" name="txtApellidos" type="text" class="form-control form-control-sm" placeholder="Apellidos" value="<?php echo $response['appaterno'].' '.$response['apmaterno'] ?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Celular</label>
                              <div class="col-sm-8">
                                <input id="txtCelular" name="txtCelular" type="text" class="form-control form-control-sm" placeholder="Celular" maxlength="9" onkeypress="return soloNumeros(event)" value="<?php echo $response['telefono'] ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">                          
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Sexo</label>
                              <div class="col-sm-8">
                                <input id="txtSexo" name="txtSexo" type="text" class="form-control form-control-sm" placeholder="Sexo" value="<?php echo $response['sexo'] ?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Anexo</label>
                              <div class="col-sm-8">
                                <input id="txtAnexo" name="txtAnexo" type="text" class="form-control form-control-sm" placeholder="Anexo" value="<?php echo $response['anexo'] ?>" />
                              </div>
                            </div>
                          </div>                          
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Dirección</label>
                              <div class="col-sm-8">
                                <input id="txtDireccion" name="txtDireccion" type="text" class="form-control form-control-sm" placeholder="Dirección" value="<?php echo $response['direccion'] ?>"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Modalidad Contractual</label>
                              <div class="col-sm-8">
                                <select class="form-control" id="cboModalidadContractual" name="cboModalidadContractual">
                                  <option value="0" >Seleccionar</option>
                                  <?php foreach ($modalidadContractual as $modalidad_contractual): ?>
                                    <?php if ($response['modalidadContractual'] != $modalidad_contractual->id_modalidad_contractual){ ?>
                                      <option value="<?php echo $modalidad_contractual->id_modalidad_contractual ?>" ><?php echo $modalidad_contractual->nombre_modalidad_contractual ?></option>
                                    <?php }else{  ?>   
                                      <option selected value="<?php echo $modalidad_contractual->id_modalidad_contractual ?>" ><?php echo $modalidad_contractual->nombre_modalidad_contractual ?></option>   
                                    <?php } ?>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div> 
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Fecha de Nac.</label>
                              <div class="col-sm-8">
                                <input id="txtFechaNacimiento" name="txtFechaNacimiento" class="form-control form-control-sm" placeholder="dd/mm/aaaa" value="<?php echo $response['fechnac'] ?>"/>
                              </div>
                            </div>
                          </div> 
                        </div> 
                        <div class="row">
                          <div class="col-md-5"></div>
                          <div class="col-md-3">
                            <button id="btnEditar" name="btnEditar" type="button"  class="btn btn-inverse-info btn-fw" onclick="EditarPerfil()">Editar</button>
                            <button id="btnGuardar" name="btnGuardar" hidden="true" type="button" class="btn btn-inverse-info btn-fw" onclick="GuardarPerfil()">Guardar</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- Fin de datos personales -->
                  </div>
                </div>
                <!-- Fin de tabs de perfil -->
              </div>
            </div>
          </div>
        </div>
        
        <?php require'view/general/vFooter.php' ?>        
      </div>
    </div>
  </div> 
  <?php require'view/general/lScript.php' ?>
  <script type="text/javascript" src="js/jPerfil.js"></script>
</body>

</html>
