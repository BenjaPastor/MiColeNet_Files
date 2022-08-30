<?php
session_start();

if (isset($_SESSION['id'])) {
  
    include_once "../../url.php";
    include_once "../../Model/Usuario.php";

    include_once "../../Model/Alumnos.php";
    $alumnos = new Alumnos();
    $numOfAlumnos = $alumnos->numberOfAlumnos($_SESSION['id']);
    $allAlumnosBydocente = $alumnos->allAlumnosBydocente($_SESSION['id']);

    include_once "../../Model/Docente.php";
    $docente = new docente();
    $allInfodocente = $docente->allInfodocente($_SESSION['id']);

    if (isset($_SESSION['alumno_id']) && $_SESSION['alumno_id'] != '') {
        include_once "../../Model/Curso.php";
        $curso = new Curso();
        $cursoByAlumno = $curso->cursoByAlumno($_SESSION['alumno_id']);
        include_once "../../Model/Docente.php";
        $docente = new Docente();
        $docentedocenteCurso = $docente->docentedocenteCurso($_SESSION['alumno_id']);
        $numOfDocentes = $docente->numberOfDocentes();
        //elegir alumno
        $choosenAlumno = $alumnos->choosenAlumno($_SESSION['alumno_id']);
        include_once "../../Model/Asignatura.php";
        $asignatura = new Asignatura();
        $numberOfAsignaturas = $asignatura->numberOfAsignaturas($_SESSION['alumno_id']);
        $allAsignaturasByAlumno = $asignatura->allAsignaturasByAlumno($_SESSION['alumno_id']);

    }

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
                            <h1 class="m-0 text-dark">Calendario Personal Como Docente</h1>
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
    <?php include_once "../template_layout/footer.php";
    include_once 'template_lay/script.php'; 
    include("docente_calendar.php");?>


</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}?>