<?php
session_start();

if (isset($_SESSION['id'])) {
  
    include_once "../../url.php";
    
    include_once "../../Model/Usuario.php";
 
    include_once "../../Model/Alumnos.php";
    $alumnos = new Alumnos();
    $allAlumnosByDocente = $alumnos->allAlumnosByDocente($_SESSION['id']);
    
    
    include_once "../../Model/Docente.php";
    $docente = new Docente();
    $allInfodocente = $docente->allInfoDocente($_SESSION['id']);
    $allCursosOfDocenteIsTutor = $docente->allCursosOfDocenteIsTutor($_SESSION['id']);
    $isDocenteAdmin = $docente->isDocenteAdmin($_SESSION['id']);
  
    
    include_once "../../Model/Curso.php";
    $curso = new Curso();
    $cursosByDocente = $curso->cursosByDocente($_SESSION['id']);
  
    include_once "../../Model/Asignatura.php";
    $asignatura = new Asignatura();
    $numberOfAsignaturasByDocente = $asignatura->numberOfAsignaturasByDocente($_SESSION['id']);
    $allInfoOfAsignaturasByDocente = $asignatura->allInfoOfAsignaturasByDocente($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">

<?php include_once "../template_layout/head.php"?>

<body class="fix-header fix-sidebar">
    

    <!-- Main wrapper  -->
    
        <!-- header header  -->
        <?php include_once "template_lay/header.php"?>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <?php include_once "template_lay/sidebar.php"?>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0 text-dark">Panel de Administración</h1>
                        </div><!-- /.col -->
                        <!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.header-contenido -->

            <!-- Contenido Principal -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>
                                        <?php if (isset($allInfodocente)) {
                                            echo $allInfodocente['nombre'];
                                        }  ?>
                                    </h3>
                                    <p><?php if (isset($allInfodocente)) { 
                                        echo $allInfodocente['apellido'] . ', ' . $allInfodocente['apellido2']; }?> </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="/view/docente/perfil.php" class="small-box-footer">Ver Perfil <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>
                                      Alumnos
                                    </h3>
                                    <p>  Tiene un total de <?php
                                        if (isset($allAlumnosByDocente)) {
                                                echo $allAlumnosByDocente;
                                            }
                                            ?> 
                                    alumnos</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="/view/docente/alumnos.php" class="small-box-footer">Gestionar Alumnos <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">

                                    <h3>
                                        Asignaturas:
                                        <?php
                                      if (isset($numberOfAsignaturasByDocente)) {
                                              echo $numberOfAsignaturasByDocente;
                                          }?>
                                    </h3>
                                    <select class="form-control form-control-sm" id="asignaturas_id">
                                        <option value='0'>
                                            --Lista de Asignaturas--
                                        </option>
                                        <?php
                                          foreach ($allInfoOfAsignaturasByDocente as $asignatura) {
                                                  echo "<option value='" . $asignatura['id'] . "'>" . $asignatura['nombre'] . "</option>";
                                              }
                                              ?>


                                    </select>
                                    <p class="small-box-footer">
                                    </p>
                                </div>
                                
                                <p class="small-box-footer">
                                &nbsp; </p>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>
                                        Tutor: <?php if (isset($allCursosOfDocenteIsTutor)) {echo sizeof($allCursosOfDocenteIsTutor);}?>

                                     </h3>
                                     <select class="form-control form-control-sm" id="asignaturas">
                                        <option value='0'>
                                            --Lista de Cursos--
                                        </option>
                                        <?php
                                          foreach ($allCursosOfDocenteIsTutor as $curso) {
                                                  echo "<option value='" . $curso['id'] . "'>" . $curso['nombre'] . " - " . $curso['ciclo'] . "</option>";
                                              }
                                        ?>


                                    </select>
                                    <p>
                                    </p>
                                </div>
                                <p class="small-box-footer">
                                &nbsp; </p>
                                
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->

                    <div class="row">
                        <!-- Left col -->
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">

                                    <!-- /.col -->
                                    <div class="col-md-12">
                                        <div class="card card-primary">
                                            <div class="card-body p-0">
                                            <h3 class="mb-2 ml-1 text-dark text-left">Calendario del Docente</h3>

                                                <!-- THE CALENDAR -->
                                                <div id="calendar"></div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </section>

                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- End Page wrapper  -->
    
    <!-- End Wrapper -->
    <?php 
    include_once "../template_layout/footer.php";
    include_once 'template_lay/script.php'; 
    include_once 'docente_calendar.php';
    
    ?>


</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}?>