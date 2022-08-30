<?php
session_start();

if (isset($_SESSION['id'])) {

    include_once "../../url.php";
    include_once "../../Model/Usuario.php";

    include_once "../../Model/Alumnos.php";
    $alumnos = new Alumnos();
    $numOfAlumnos = $alumnos->numberOfAlumnos($_SESSION['id']);
    $allAlumnosByTutor = $alumnos->allAlumnosByTutor($_SESSION['id']);

    include_once "../../Model/Tutor.php";
    $tutor = new Tutor();
    $allInfoTutor = $tutor->allInfoTutor($_SESSION['id']);

    if (isset($_SESSION['alumno_id']) && $_SESSION['alumno_id'] != '') {
        include_once "../../Model/Curso.php";
        $curso = new Curso();
        $cursoByAlumno = $curso->cursoByAlumno($_SESSION['alumno_id']);
        include_once "../../Model/Docente.php";
        $docente = new Docente();
        $docenteTutorCurso = $docente->docenteTutorCurso($_SESSION['alumno_id']);
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
    <?php

    if (!isset($_SESSION['alumno_id']) || $_SESSION['alumno_id'] == '' || isset($_GET['changeAlumno'])) {?>

    <div class="modal fade show" id="modal-default" role="dialog" style="padding-right: 17px; display:    block;"
        aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seleccione Alumno</h4>
                </div>
                <div class="modal-body">
                    <?php

        foreach ($allAlumnosByTutor as $alumno) {
            echo "<p><a href='../../Controller/chooseAlumnoCtrl.php?alumno_id=" . $alumno['id'] . "' data-seq='1'>" . $alumno['nombre'] . "</a></p>";
        }

        ?>
                </div>
            </div>
        </div>
    </div>



    <?php }

    ?>

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
                                    <?php if (isset($choosenAlumno)) {
        echo $choosenAlumno['nombre'];
    }?>
                                </h3>
                                <p><?php if (isset($choosenAlumno)) {
        echo $choosenAlumno['apellido'] . ', ' . $choosenAlumno['apellido2'];}?> </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="/Controller/perfilAlumnoCtrl.php?perfilAlumno=<?php
if (isset($choosenAlumno)) {
        echo $choosenAlumno['id'];
    }
    ?>" class="small-box-footer">Ver Datos <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    <?php
if (isset($cursoByAlumno)) {
        echo $cursoByAlumno['nombre'];
    }
    ?>
                                </h3>
                                <p><?php
if (isset($cursoByAlumno)) {
        echo $cursoByAlumno['ciclo'];
    }
    ?>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="/view/tutor/curso.php" class="small-box-footer">Más Info <i
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
if (isset($numberOfAsignaturas)) {
        echo $numberOfAsignaturas;
    }?>
                                </h3>
                                <select class="form-control form-control-sm" id="asignaturas">
                                    <option value='0'>
                                        --Seleccione una asignatura--
                                    </option>
                                    <?php
foreach ($allAsignaturasByAlumno as $asignatura) {
        echo "<option value='" . $asignatura['id'] . "'>" . $asignatura['nombre'] . "</option>";
    }
    ?>


                                </select>
                                <p></p>
                            </div>

                            <a href="#" class="small-box-footer">Más Info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    Tutor:
                                    <?php

    if (isset($docenteTutorCurso)) {echo $docenteTutorCurso['dnombre'];}?>
                                </h3>

                                <p><?php if (isset($docenteTutorCurso)) {echo $docenteTutorCurso['dapellido'] . " " . $docenteTutorCurso['dapellido2'];}?>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/view/tutor/buzon_componer.php" class="small-box-footer">Contactar <i
                                    class="fas fa-arrow-circle-right"></i></a>
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
                                <div class="col-md-3">
                                     <h3 class="mb-2 text-dark text-center">Calificaciones</h3>


                                        <?php
                                        // PIllo los cursos
                                        if (isset($_SESSION['alumno_id'])) {
                                        
                                        $obj = new DbConnection();
                                        $conn = $obj->dbConnect();

                                        $sql = "SELECT a.id AS aid, a.nombre AS anombre FROM asignatura AS a, alumno AS al WHERE a.curso = al.curso AND al.id = $_SESSION[alumno_id]";
                                        $prepare = $conn->prepare($sql);
                                        $prepare->execute();
                                        $asignatura_select = $prepare->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($asignatura_select as $asignatura) {
                                            ?>
                                        <div class="card card-primary card-outline col-md-11 float-left mr-3 ml-3">
                                            <div class="card-body box-profile">
                                            <h3 class="profile-username text-center">
                                                <?php echo $asignatura['anombre'] ?>
                                            </h3>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <?php
                                                    $calificacionAsignaturaByAlumno = $alumnos->calificacionAsignaturaByAlumno($asignatura['aid'], $_SESSION['alumno_id']);
                                                            foreach ($calificacionAsignaturaByAlumno as $nota) {
                                                                ?>
                                                <li class="list-group-item">

                                                    <b>
                                                        <?php echo $nota['fecha'] ?></b> <a
                                                        class="float-right"><?php echo $nota['nota'] ?></a>

                                                </li>

                                                <?php }
                                                $notaFinalByAsignatura = $alumnos->notaFinalByAsignaturaAndAlumnoId($asignatura['aid'], $_SESSION['alumno_id']);
                                                ?>

                                                <li class='list-group-item'><b>Calificacion Final</b><b><a
                                                            class='float-right'><?php echo number_format($notaFinalByAsignatura['AVG(nota)'], 2) ?></a></b>
                                                </li>

                                            </ul>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <?php }    # code...
                                        }?>
                                    
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-9">
                                        <div class="card card-primary">
                                            <div class="card-body p-0">
                                                <!-- THE CALENDAR -->
                                                <h3 class="mb-2 text-dark text-center">Calendario del Alumno</h3>

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
    include_once 'tutor_calendar.php';

    ?>


</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}?>