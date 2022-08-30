<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../tutor/index.php" class="brand-link">
        <img src="/Resource/images/backEnd/logo.png" alt="" class="brand-image " style="opacity: .8" />
        <span class="brand-text font-weight-light invisible ">MiCole.net</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Usuario -->
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/uploads/<?php echo $allInfoTutor['img'];?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">

                <a href="#" class="d-block">
                    <?php 
      echo "<p><a href='/view/tutor/perfil.php'>".$allInfoTutor['nombre']." ".$allInfoTutor['apellido']."</a></p>";  ?></a>
            </div>
        </div>

        <!-- Sidebar MenÃº -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="../tutor/index.php" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Panel Administración
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Alumnos
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"><?php echo $numOfAlumnos; ?></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php
          foreach ($allAlumnosByTutor as $alumno) {
            
            echo "<li class='nav-item'>
              <a data-seq='".$alumno['id']."' href='/Controller/perfilAlumnoCtrl.php?perfilAlumno=".$alumno['id']."' class='nav-link' >
                <i class='far fa-circle nav-icon'></i>
                 <p>".$alumno['nombre']."</p>
              </a>
            </li>";
          } ?>
                    </ul>
                </li>


                <li class="nav-item">
                    <a data-seq='<?php echo $cursoByAlumno['nombre']; ?>'
                        href='/view/tutor/curso.php?curso_id=<?php echo $cursoByAlumno['id']; ?>' class='nav-link'>
                        <i class="nav-icon fas fa-file"></i>
                        <p>Curso</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Asignaturas
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"><?php 
                            if (isset($numberOfAsignaturas)) {
                            echo $numberOfAsignaturas; }?></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php

          foreach ($allAsignaturasByAlumno as $asignatura) {
            echo "<li class='nav-item'>
              <a href='/Controller/asignaturaCtrl.php?asignatura_id=".$asignatura['id']."' class='nav-link'>
                <i class='far fa-circle nav-icon'></i>
                <p>".$asignatura['nombre']."</p>
              </a>
            </li>";
          } ?>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/view/tutor/calendario.php" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Calendario
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Buzón
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/view/tutor/buzon.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bandeja de Entrada</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/view/tutor/buzon_componer.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Componer Correo</p>
                            </a>
                        </li>

                    </ul>
                </li>


            </ul>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>