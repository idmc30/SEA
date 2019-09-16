<?php

session_start(); 
require_once 'model/mMenu.php';
 $rol= $_SESSION['idperfil'];
   $menu = new Menu();
   $lmenu = $menu->listarMenuNavegacion($rol);
   $total_sub_menu=0;
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    
  <?php foreach ($lmenu as $menunav): ?>

  <?php if (($menunav->referencia_menu)==null): ?>

  <?php $contarSubMenu= $menu->consultarTotalSubMenu($menunav->id_menu) ?>

    <li class="nav-item ">
 
      <?php if ($contarSubMenu==$total_sub_menu): ?>
          <a class="nav-link" href="<?php echo $menunav->link_menu?>">
              <i class="<?php  echo $menunav->icono_menu ?>"></i>
              <span class="menu-title"><?php echo $menunav->nombre_menu?></span>
          </a>
      <?php endif ?>

      <?php if ($contarSubMenu!=$total_sub_menu): ?>
            <a class="nav-link" data-toggle="collapse" href="#<?php echo $menunav->id_menu?>" aria-expanded="false" aria-controls="eventos">
              <i class="<?php  echo $menunav->icono_menu ?>"></i>
              <span class="menu-title"><?php echo $menunav->nombre_menu?></span>
              <i class="menu-arrow"></i>
            </a>
      
            <div class="collapse" id="<?php echo $menunav->id_menu ?>">
              <ul class="nav flex-column sub-menu">   
               
                <?php foreach ($lmenu as $submenu): ?>
                
                     <?php if (($submenu->referencia_menu) == ($menunav->id_menu)): ?>
                            <li class="nav-item"> <a class="nav-link" href="<?php echo $submenu->link_menu?>"><?php echo $submenu->nombre_menu?></a></li>               
                      
                     <?php endif ?>
                          
                <?php endforeach ?>
            </ul>
          </div>
  
     <?php endif ?>

    </li>
  <?php endif ?>        
  <?php endforeach ?> 
  </ul>
</nav>