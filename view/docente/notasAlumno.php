<?php
session_start();

if (isset($_SESSION['id'])) {
    include_once "../../url.php";
    include_once "../../Model/Usuario.php";

    include_once "../../Model/Docente.php";
    $docente = new docente();
    $allInfodocente = $docente->allInfodocente($_SESSION['id']);
    $isDocenteAdmin = $docente->isDocenteAdmin($_SESSION['id']);

    include_once "../../Model/Alumnos.php";
    $alumnos = new Alumnos();
    $allAlumnosByTutor = $alumnos->allAlumnosByTutor($_SESSION['id']);
    $choosenAlumno = $alumnos->choosenAlumno($_SESSION['notasAlumno']);

    // $addAlumnoByDocente = $alumnos->addAlumnoByDocente();

    include_once "../../Model/Curso.php";
    $curso = new Curso();
    $allCursosInfo = $curso->allCursosInfo();

    include_once "../../Model/Tutor.php";
    $tutor = new Tutor();
    $allTutores = $tutor->allTutores();

    include_once "../../Model/Aula.php";
    $aula = new Aula();
    // $allInfoAula = $aula->allInfoAula($_SESSION['aula_id']);

    ?>
<!DOCTYPE html>
<html lang="en">

<?php include_once "../template_layout/head.php"?>

<body class="fix-header fix-sidebar">



    <!-- header header  -->
    <?php include_once "template_lay/header.php"?>
    <!-- End header header -->
    <!-- Left Sidebar  -->
    <?php include_once "template_lay/sidebar.php"?>
    <!-- End Left Sidebar  -->
    <!-- Page wrapper  -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">Gestión Calificaciones Alumno:
                            <?php echo $choosenAlumno['nombre'] . " " . $choosenAlumno['apellido'] . " " . $choosenAlumno['apellido2'] ?>
                        </h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.header-contenido -->

        <!-- Contenido Principal -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-3">



                        <!-- Añadir Temario a Horario -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">


                                <h3 class="profile-username text-center">Añadir Calificacion
                                </h3>
                                <form
                                    action="../../Controller/perfilAlumnoCtrl.php?notasAlumno=<?php echo $_SESSION['notasAlumno'] ?>"
                                    method="post">
                                    <input type="hidden" name="notasAlumno"
                                        value="<?php echo $_SESSION['notasAlumno'] ?>">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <select id="sel_asigignatura" name="sel_asigignatura"
                                                class="form-control form-control mb-1">
                                                <option value="0">- Seleccione Asignatura -</option>
                                                <?php
// PIllo los cursos
    $obj = new DbConnection();
    $conn = $obj->dbConnect();

    $sql = "SELECT a.id AS aid, a.nombre AS anombre FROM asignatura AS a, alumno AS al WHERE a.curso = al.curso AND al.id = $_SESSION[notasAlumno]";
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    $asignatura_select = $prepare->fetchAll(PDO::FETCH_ASSOC);

    foreach ($asignatura_select as $asignatura) {
        echo "<option value='" . $asignatura['aid'] . "' >" . $asignatura['anombre'] . "</option>";

    }

    ?>
                                            </select>


                                        </li>
                                        <label for="fecha_examan" class="col-form-label">Fecha
                                            Examen:</label>
                                        <input type="date" class="form-control" name="fecha_examan" value="">

                                        <label for="NIF" class="col-form-label">Nota:</label>
                                        <input type="text" class="form-control" name="nota" value="">
                                        <li class="list-group-item">
                                            <button type="submit" class="btn btn-primary col-md-12" name="enviar"
                                                id="enviar" value="1">
                                                Añadir Calificacion
                                            </button>

                                        </li>
                                    </ul>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- /.col -->
                    <div class="col-md-9">
                        <?php

                        foreach ($asignatura_select as $asignatura) {
                        ?>
                        <div class="card card-primary card-outline col-md-3 float-left mr-3 ml-3">
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center"><?php echo $asignatura['anombre'] ?></h3>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <?php
                                        $calificacionAsignaturaByAlumno = $alumnos->calificacionAsignaturaByAlumno($asignatura['aid'], $_SESSION['notasAlumno']);
                                                foreach ($calificacionAsignaturaByAlumno as $nota) {
                                                    ?>
                                    <li class="list-group-item">
                                        <a
                                            href="../../Controller/perfilAlumnoCtrl.php?delNotaAsignatura=<?php echo $nota['IDASIGNATURA'] ?>&alumno_id=<?php echo $_SESSION['notasAlumno'] ?>&fecha=<?php echo $nota['fecha'] ?>"><i
                                                id="delNota" class="nav-icon fas fa-window-close text-danger"></i></a>
                                        <b>
                                            <?php echo $nota['fecha'] ?></b> <a
                                            class="float-right"><?php echo $nota['nota'] ?></a>

                                    </li>

                                    <?php }
                                    $notaFinalByAsignatura = $alumnos->notaFinalByAsignaturaAndAlumnoId($asignatura['aid'], $_SESSION['notasAlumno']);
                                    ?>

                                    <li class='list-group-item'><b>Calificacion Final</b><b><a
                                                class='float-right'><?php echo number_format($notaFinalByAsignatura['AVG(nota)'], 2) ?></a></b>
                                    </li>

                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <?php }?>


                    </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- End Wrapper -->
    <?php include_once "../template_layout/footer.php";
    include_once 'template_lay/script.php';
    include_once 'calendar_aula.php';?>



</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}?>