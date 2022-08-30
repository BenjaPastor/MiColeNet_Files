<?php
include_once "../../Model/Docente.php";
$docente = new Docente();
$allInfodocente = $docente->allInfodocente($_SESSION['id']);
$isDocenteAdmin = $docente->isDocenteAdmin($_SESSION['id']);

include_once "../../Model/Curso.php";
$curso = new Curso();
$cursosByDocente = $curso->cursosByDocente($_SESSION['id']);

include_once "../../Model/Asignatura.php";
$asignatura = new Asignatura();
$numberOfAsignaturasByDocente = $asignatura->numberOfAsignaturasByDocente($_SESSION['id']);
$allInfoOfAsignaturasByDocente = $asignatura->allInfoOfAsignaturasByDocente($_SESSION['id']);

include_once "../../Model/Aula.php";
$aula = new Aula();
$allInfoAulas = $aula->allInfoAulas();
$numberOfAulas = $aula->numberOfAulas();

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../docente/index.php" class="brand-link">
        <img src="/Resource/images/backEnd/logo.png" alt="MiCole.net" class="brand-image "
            style="opacity: .8" />
        <span class="brand-text font-weight-light invisible ">MiCole.net</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Usuario -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/uploads/<?php echo $allInfodocente['img']; ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">

                <a href="#" class="d-block">
                    <?php
echo "<p><a href='/view/docente/perfil.php'>" . $allInfodocente['nombre'] . " " . $allInfodocente['apellido'] . "</a></p>"; ?></a>
            </div>
        </div>

        <!-- Sidebar MenÃº -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="../docente/index.php" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Panel Administración
                        </p>
                    </a>
                </li>
                <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                <li class="nav-item">
                    <a href='/view/docente/allTutores.php' class='nav-link'>
                        <i class="nav-icon fas fa-users"></i>
                        <p>Tutores Legales</p>
                    </a>
                </li>
                <?php }?>
                <li class="nav-item">
                    <a href='/view/docente/alumnos.php' class='nav-link'>
                        <i class="nav-icon fas fa-child"></i>
                        <p>Alumnos</p>
                    </a>
                </li>

                <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                <li class="nav-item">
                    <a href='/view/docente/allDocentes.php' class='nav-link'>
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Docentes</p>
                    </a>
                </li>
                <?php }?>
                <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                <li class="nav-item">
                    <a href='/view/docente/allAulas.php' class='nav-link'>
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>Aulas</p>
                    </a>
                </li>
                <?php }?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>Cursos
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"><?php
if (isset($cursosByDocente)) {
    echo sizeof($cursosByDocente);}?></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php

foreach ($cursosByDocente as $curso) {
    echo "<li class='nav-item'>
                            <a href='/Controller/cursoCtrl.php?curso_id=" . $curso['id'] . "' class='nav-link'>
                                <i class='far fa-circle nav-icon'></i>
                                <p>" . $curso['nombre'] . "-" . $curso['ciclo'] . "</p>
                            </a>
                            </li>";
}?>

                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Asignaturas
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"><?php
if (isset($numberOfAsignaturasByDocente)) {
    echo $numberOfAsignaturasByDocente;}?></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php

foreach ($allInfoOfAsignaturasByDocente as $asignatura) {
    echo "<li class='nav-item'>
                            <a href='/Controller/asignaturaCtrl.php?asignatura_id_from_docente=" . $asignatura['id'] . "' class='nav-link'>
                                <i class='far fa-circle nav-icon'></i>
                                <p>" . $asignatura['nombre'] . "</p>
                            </a>
                            </li>";
}?>

                    </ul>
                </li>

                <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                <li class="nav-item">
                    <a href="/view/docente/allTemas.php" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Temario
                        </p>
                    </a>
                </li>
                <?php }?>

                <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-clock"></i>
                        <p>Horario
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"><?php
if (isset($numberOfAulas)) {
    echo $numberOfAulas;}?></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php

    foreach ($allInfoAulas as $aula) {
        echo "<li class='nav-item'>
                            <a href='/Controller/horarioCtrl.php?aula_id=" . $aula['id'] . "' class='nav-link'>
                                <i class='far fa-circle nav-icon'></i>
                                <p>" . $aula['nombre'] . "</p>
                            </a>
                            </li>";
    }?>

                    </ul>
                </li>
                <?php }?>




                <li class="nav-item ">
                    <a href="/view/docente/calendario.php" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Calendario Docente
                        </p>
                    </a>
                </li>
                <li class=" user-panel nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Buzón
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/view/docente/buzon.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bandeja de Entrada</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/view/docente/buzon_componer.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Componer Correo</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                <li class=" nav-item has-treeview  mt-3">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solar-panel"></i>
                        <p>
                            FrontEnd
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/Controller/frontendCtrl.php?option=identidad" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Identidad y SEO</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/Controller/frontendCtrl.php?option=slider" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gestión Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/Controller/frontendCtrl.php?option=menu" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gestión Secciones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/Controller/frontendCtrl.php?option=contenido" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gestión Contenido</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <?php }?>
            </ul>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>