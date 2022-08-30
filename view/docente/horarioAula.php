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
    // $addAlumnoByDocente = $alumnos->addAlumnoByDocente();

    include_once "../../Model/Curso.php";
    $curso = new Curso();
    $allCursosInfo = $curso->allCursosInfo();

    include_once "../../Model/Tutor.php";
    $tutor = new Tutor();
    $allTutores = $tutor->allTutores();

    include_once "../../Model/Aula.php";
    $aula = new Aula();
    $allInfoAula = $aula->allInfoAula($_SESSION['aula_id']);

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
 
 <input type="hidden" id="eventID" name="eventID"/>
 <input type="hidden" id="idaula" name="idaula"/>
 <input type="hidden" id="idtema" name="idtema"/>
 <input type="hidden" id="fecha" name="fecha"/>

 <div class="modal-footer">
  <button type="button"
  class="btn btn-danger btn-rounded m-b-10 m-l-5"
  data-dismiss="modal">NO
  </button>
  <button type="submit" class="btn btn-primary" name="deleteButton" id="deleteButton" href="">SI</button>
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
                        <h1 class="m-0 text-dark">Gestión Horario Aula: <?php echo $allInfoAula['nombre'] ?></h1>
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


                                <h3 class="profile-username text-center">Añadir Temario
                                </h3>
                                <form action="../../Controller/aulaCtrl.php" method="post">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <select id="sel_curso" name="sel_curso" class="form-control form-control mb-1">
                                                <option value="0">- Seleccione Curso -</option>
                                                <?php
                                        // PIllo los cursos
                                        $obj = new DbConnection();
                                        $conn = $obj->dbConnect();
                                
                                        $sql = "SELECT * FROM curso";
                                        $prepare = $conn->prepare($sql);
                                        $prepare->execute();
                                        $cursos_select = $prepare->fetchAll(PDO::FETCH_ASSOC);
                            
                                         foreach ($cursos_select as $curso) {
                                            echo "<option value='" . $curso['id'] . "' >" . $curso['nombre'] . " - " .$curso['ciclo']. "</option>";
                                           
                                        }
                                       
                                            while ($row = mysqli_fetch_assoc($curso_select)) {
                                                $cid = $row['id'];
                                                $cciclo = $row['ciclo'];

                                                // Options
                                                echo "<option value='" . $cid . "' >" . $cciclo . "</option>";
                                            }
                                            ?>
                                            </select>
                                            <select id="sel_asignaturas" name="sel_asignaturas" class="form-control form-control mb-1">
                                                <option value="0">- Seleccione Asignatura -</option>
                                            </select>
                                            <select id="sel_tema" name="sel_tema" class="form-control form-control mb-1">
                                                <option value="0">- Seleccione Tema -</option>
                                            </select>
                                        </li>
                                        <li class="list-group-item">
                                        <label for="sel_docente" class="col-form-label">Docente:</label>

                                        <select id="sel_docente" name="sel_docente" class="form-control form-control mb-1">
                                                <option value="0">- Seleccione Docente -</option>
                                                <?php
                                        // PIllo los docnetes
                                        $obj = new DbConnection();
                                        $conn = $obj->dbConnect();
                                
                                        $sql = "SELECT * FROM docente";
                                        $prepare = $conn->prepare($sql);
                                        $prepare->execute();
                                        $docente_select = $prepare->fetchAll(PDO::FETCH_ASSOC);
                            
                                         foreach ($docente_select as $docente) {
                                            echo "<option value='" . $docente['id'] . "' >" . $docente['nombre'] . " - " .$docente['apellido']. "</option>";
                                           
                                        }
                                       
                                  
                                            ?>
                                            </select>
                                            </li>
                                        <li class="list-group-item">

                                            <label for="fecha" class="col-form-label">Fecha:<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="fecha" value="" required>
                                        </li>
                                        <li class="list-group-item">

                                            <label for="hora" class="col-form-label">Hora Comienzo:<span class="text-danger">*</span></label>
                                            <div class="input-group date" id="timepickerTema" 
                                                data-target-input="nearest">
                                                <input type="text" name="timepickerTema" class="form-control datetimepicker-input"
                                                    data-target="#timepickerTema" required>
                                                <div class="input-group-append" data-target="#timepickerTema"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <label for="hora" class="col-form-label">Hora Fin:<span class="text-danger">*</span></label>
                                            <div class="input-group date" id="timepickerTema2" name="timepickerTema2"
                                                data-target-input="nearest">
                                                <input type="text" name="timepickerTema2" class="form-control datetimepicker-input"
                                                    data-target="#timepickerTema2" required>
                                                <div class="input-group-append" data-target="#timepickerTema2"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <button type="submit" class="btn btn-primary col-md-12" name="enviar" id="enviar"
                                                href="">
                                                Añadir a Horario
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
    include_once 'calendar_aula.php';?>



</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}?>