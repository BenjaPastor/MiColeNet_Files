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
    $choosenAlumno = $alumnos->choosenAlumno($_SESSION['horarioAlumno']);
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

    <!-- Modal Delete Event -->
    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog">


            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Del Calendario?</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>

                </div>
                <div id="modalBody" class="modal-body">
                    <h4 id="modalTitle" class="modal-title"></h4>
                    <div id="modalWhen" style="margin-top:5px;"></div>
                </div>

                <input type="hidden" id="idalumno" name="idalumno" />
                <input type="hidden" id="idaula" name="idaula" />
                <input type="hidden" id="idtema" name="idtema" />
                

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-rounded m-b-10 m-l-5" data-dismiss="modal">NO
                    </button>
                    <button type="submit" class="btn btn-primary" name="deleteButtonFromAlumno" id="deleteButtonFromAlumno"
                        href="">SI</button>
                </div>
            </div>

        </div>
    </div>
    <!--Modal-->

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
                        <h1 class="m-0 text-dark">Gestión Horario Alumno:
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


                                <h3 class="profile-username text-center">Añadir a Horario
                                </h3>
                                <form action="../../Controller/perfilAlumnoCtrl.php" method="post">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <select id="sel_asig_alumno" name="sel_asig_alumno"
                                                class="form-control form-control mb-1">
                                                <option value="0">- Seleccione Asignatura -</option>
                                                <?php
                                        // PIllo los cursos
                                        $obj = new DbConnection();
                                        $conn = $obj->dbConnect();
                                
                                        $sql = "SELECT a.id AS aid, a.nombre AS anombre FROM asignatura AS a, alumno AS al WHERE a.curso = al.curso AND al.id = $_SESSION[horarioAlumno]";
                                        $prepare = $conn->prepare($sql);
                                        $prepare->execute();
                                        $asignatura_select = $prepare->fetchAll(PDO::FETCH_ASSOC);
                            
                                         foreach ($asignatura_select as $asignatura) {
                                            echo "<option value='" . $asignatura['aid'] . "' >" . $asignatura['anombre'] ."</option>";
                                           
                                        }
                           
                                            ?>
                                            </select>

                                            <select id="sel_tema" name="sel_tema"
                                                class="form-control form-control mb-1">
                                                <option value="0">- Seleccione Tema -</option>
                                            </select>

                                            <input type="hidden" id="IDAULA" name="IDAULA" value="">
                                        </li>

                                        <li class="list-group-item">
                                            <button type="submit" class="btn btn-primary col-md-12" name="enviar"
                                                id="enviar" href="">
                                                Añadir a Horario
                                            </button>

                                        </li>
                                    </ul>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- Control Asistencia Alumno -->

                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">


                                <h3 class="profile-username text-center">Control Asistencia
                                </h3>
                                <input type="hidden" id="idalumno_asistencia" value="<?php echo $_SESSION['horarioAlumno'] ?>">
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">

                                        <label for="fecha_asistencia" class="col-form-label">Fecha:</label>
                                        <input type="date" class="form-control" id="fecha_asistencia"
                                            name="fecha_asistencia" value="">
                                    </li>
                                    <li class="list-group-item">
                                        <!-- El div para control asistencia -->
                                        <div id="control_asistencia"></div>
                                    </li>

                                </ul>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- /.col -->

                    <div class="col-md-9">
                        <div class="col-md-12 mt-1">
                            <div class="card card-primary">
                                <div class="card-body p-0">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar"></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- End Wrapper -->
    <?php include_once "../template_layout/footer.php";
    include_once 'template_lay/script.php';
    include_once 'calendar_alumno.php';?>


    <div class="modal fade" id="modalOk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Guardado con Éxito
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
        </div>

        <!-- /.table -->

        <!-- /.mail-box-messages -->
    </div>
</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}?>