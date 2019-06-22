<!-- 1.- CGuerrero  04/04/2049 Menú -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    
    <li class="nav-item  <?php echo $miseventosactivo ?>">
      <a class="nav-link" href="index.php?page=inscripcion&action=listaeventos">
        <i class="mdi mdi-monitor-dashboard menu-icon"></i>
        <span class="menu-title">Mis Eventos</span>
      </a>
    </li>

    <li class="nav-item <?php echo evento_activo ?>">
      <a class="nav-link" data-toggle="collapse" href="#eventos" aria-expanded="false" aria-controls="eventos">
        <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
        <span class="menu-title">Eventos</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="eventos">
        <ul class="nav flex-column sub-menu">              
          <li class="nav-item"> <a class="nav-link" href="index.php?page=evento&action=registro">Registro</a></li>               
          <li class="nav-item"> <a class="nav-link" href="index.php?page=evento&action=lista">Lista</a></li>                
        </ul>
      </div>
    </li>
            
    <li class="nav-item <?php echo asistencia_activo  ?>">
      <a class="nav-link collapsed" data-toggle="collapse" href="#asistencia" aria-expanded="false" aria-controls="asistencia">
        <i class="mdi mdi-security-account-outline menu-icon"></i>
        <span class="menu-title">Asistencia</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="asistencia" style="">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?page=asistencia&action=control"> Control </a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=asistencia&action=detalle"> Detalle </a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item <?php echo $manteactivo ?>">
      <a class="nav-link collapsed" data-toggle="collapse" href="#mantenimiento" aria-expanded="false" aria-controls="mantenimiento">
        <i class="mdi mdi-robot menu-icon"></i>
        <span class="menu-title">Mantenimiento</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="mantenimiento" style="">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?page=lugar&action=registro"> Lugar </a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=organizador&action=registro"> Organizador </a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=publicoObjetivo&action=registro"> Público objetivo </a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=tipoEvento&action=registro"> Tipo Evento </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="collapse" href="#registromanual" aria-expanded="false" aria-controls="registromanual">
        <i class="mdi mdi-playlist-edit menu-icon"></i>
        <span class="menu-title">Registro</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="registromanual" style="">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?page=registroManual&action=form"> Usuario </a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=inscripcionManual&action=form"> Inscripción </a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>