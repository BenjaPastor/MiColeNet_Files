<?php
session_start();
if (isset($_SESSION['id'])) {
    include_once "../../url.php";
    include_once "../../Model/Usuario.php";

    include_once "../../Model/Tutor.php";
    $tutor = new Tutor();
    $allInfoTutor = $tutor->allInfoTutor($_SESSION['id']);
    $allDestinatariosByDocenteId = $tutor->allDestinatariosByDocenteId($_SESSION['id']);
    $allDestinatariosTutoresByDocenteId = $tutor->allDestinatariosTutoresByDocenteId($_SESSION['id']);

    include_once "../../Model/Alumnos.php";
    $alumnos = new Alumnos();
    $numOfAlumnos = $alumnos->numberOfAlumnos($_SESSION['id']);
    $allAlumnosByTutor = $alumnos->allAlumnosByTutor($_SESSION['id']);

    include_once "../../Model/Curso.php";
    $curso = new Curso();
    $cursoByAlumno = $curso->cursoByAlumno($_SESSION['alumno_id']);

    if (isset($_SESSION['alumno_id']) || $_SESSION['alumno_id'] == '') {

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
<?php

    if (isset($_SESSION['email'])) {

        $form = true;
        $otitle = '';
        $odestinatario = '';
        $omessage = '';
        //Check envio form
        if (isset($_POST['title'], $_POST['email_destinatario'], $_POST['message'])) {
            $title = $_POST['title'];
            $destinatario = $_POST['email_destinatario'];
            $omessage = $_POST['message'];
            //Eliminación de slashes
            if (get_magic_quotes_gpc()) {
                $title = stripslashes($title);
                $destinatario = stripslashes($destinatario);
                $omessage = stripslashes($omessage);
            }
            //Validacion no vacio
            if ($_POST['title'] != '' and $_POST['email_destinatario'] != '' and $_POST['message'] != '') {

                //saltos de carro
                $message = nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8'));

                //comprobación si existe destinatario
                $obj = new DbConnection();
                $conn = $obj->dbConnect();
                $dn1 = $conn->query('select count(id) as destinatario, id as destinatarioid, email AS destinatatioemail, (select count(*) from buzon) as npm from docente where email="' . $destinatario . '"');
                $dn1 = $dn1->fetch(PDO::FETCH_ASSOC);

                //Hay filas

                if ($dn1) {
                    // Comprobamos que no se mandad a si mismo
                    if ($dn1['destinatarioid'] != $_SESSION['email']) {
                        $id = $dn1['npm'] + 1;
                        //Insertamos
                        if ($conn->query('insert into buzon (id, id2, title, user1, user2, user1type, user2type, message, timestamp, user1read, user2read)values("' . $id . '", "1", "' . $title . '", "' . $_SESSION['email'] . '", "' . $dn1['destinatatioemail'] . '","t", "d", "' . $message . '", "' . time() . '", "yes", "no")')) {

                            $form = false;
                            header('Location:/view/tutor/buzon.php');
                        } else {
                            //Error
                            $msg = 'Ha ocurrido un error';
                        }
                    } else {
                        //Control que no me mando a mi mismo
                        $msg = 'A ti mismo no puede ser.';
                    }
                } else {
                    //No destinatario
                    $msg = 'No existe el destinatario.';
                }
            } else {
                //Validación
                $msg = 'Validación Fallida. Rellene todos los campos';
            }
        } elseif (isset($_GET['destinatario'])) {
            //Pillamos el user if set
            $odestinatario = $_GET['destinatario'];
        }

    } else {
        echo '<div class="message">Session inválida</div>';
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<?php include_once "../template_layout/head.php"?>

<body class="fix-header fix-sidebar">

    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <?php include_once "template_lay/header.php"?>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <?php include_once "template_lay/sidebar.php"?>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nuevo Mensaje</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Nuevo Mensaje</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <?php include 'destinatarios.php';?>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Nuevo Mensaje</h3>
              </div>
              <!-- /.card-header -->
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
              <input type="hidden" name="email_destinatario" id="email_destinatario" value="">

              <div class="card-body">
                <div class="form-group">
                  <input class="form-control" id="destinatario"  name="destinatario" placeholder="Para:">
                </div>
                <div class="form-group">
                  <input class="form-control" id="title" name="title" placeholder="Asunto:">
                </div>
                <div class="form-group">
                    <textarea id="message" name="message"  class="form-control" style="height: 300px">

                    </textarea>
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <?php if ($form) {
        //ECho error
        if (isset($msg)) {
            echo '<div class="message float-left">' . $msg . '</div>';
        }

    }?>
                <div class="float-right">

                  <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Enviar</button>
                </div>

              </div>
              <!-- /.card-footer -->
            </div>
            </form>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
    <!-- End Wrapper -->
    <?php include_once 'template_lay/script.php';
    include_once "../template_layout/footer.php";?>


</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}?>