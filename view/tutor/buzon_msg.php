<?php
session_start();
if (isset($_SESSION['id'])) {
    include_once "../../url.php";
    include_once "../../Model/Usuario.php";

    include_once "../../Model/Tutor.php";
    $tutor = new Tutor();
    $allInfoTutor = $tutor->allInfoTutor($_SESSION['id']);

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
                        <h1 class="m-0 text-dark">Buzón</h1>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.header-contenido -->

        <!-- Contenido Principal -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php include 'mailboxes.php';?>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <!-- Mostrar Email -->
                        <?php

    if (isset($_GET['id'])) {
        $email = $_SESSION['email'];
        $id = intval($_GET['id']);

        //Titulo y participantes
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $req1 = $conn->query('select title, user1, user2, user1type, user2type from buzon where id=' . $id . ' and id2="1"');

        //Hay filas
        $rows = $req1->rowCount();

        if ($rows == 1) {

            while ($fila = $req1->fetch(PDO::FETCH_ASSOC)) {
                $title = $fila['title'];
                $user1 = $fila['user1'];
                $user2 = $fila['user2'];
                $user1type = $fila['user1type'];
                $user2type = $fila['user2type'];
            }
            //Comrobamos si es partícipe
            if ($user1 == $_SESSION['email'] or $user2 == $_SESSION['email']) {

                //Actualizamos estado lectura
                if ($user1 == $_SESSION['email']) {

                    $sql = "UPDATE buzon SET
                                    user1read = ?
                                    WHERE id = ? AND id2 = ?";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute(['yes', $id, '1']);
                    $user_partic = 2;
                } else {
                    $sql = "UPDATE buzon SET
                                    user2read = ?
                                    WHERE id = ? AND id2 = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(['yes', $id, '1']);
                    $user_partic = 1;
                }
                //Lista mensajes

                $req2 = $conn->query('select buzon.timestamp, buzon.message, buzon.user1type, buzon.user2type, tutor.id as userid, tutor.nombre, tutor.img, tutor.email AS temail, docente.email as email
                                  from buzon, tutor, docente
                                  where (buzon.user2=tutor.email or buzon.user1=tutor.email) and (buzon.user1 = "' . $email . '" OR buzon.user2 = "' . $email . '") AND (buzon.user2=docente.email or buzon.user1=docente.email) AND buzon.id="' . $id . '" order by buzon.id2');
                $rowsReq2 = $req2->rowCount()+1;

                while ($fila = $req2->fetch(PDO::FETCH_ASSOC)) {
                    $timestamp = $fila['timestamp'];
                    $message = $fila['message'];
                    $userid = $fila['userid'];
                    $nombre = $fila['nombre'];
                    $img = $fila['img'];
                    $demail = $fila['email'];
                    $temail = $fila['temail'];
                  
                }
                //If set post
                if (isset($_POST['message']) and $_POST['message'] != '') {
                    $message = $_POST['message'];
                    //Remove slashes
                    if (get_magic_quotes_gpc()) {
                        $message = stripslashes($message);
                    }
                    //añado saltos de carro;
                    $message = nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8'));

                    //Cutremente ejectuamos insert y update...
                    $newbuzon = $conn->query('insert into 
                    buzon (id, id2, title, user1, user2, user1type, user2type, message, timestamp, user1read, user2read)
                    values("' . $id . '", "' . $rowsReq2 . '", "", "' . $user1 . '", "' . $user2 . '", "t", "d", "' . $message . '", "' . time() . '", "", "")');

                    $updateRead = $conn->query('update buzon set user' . $user_partic . 'read="yes" where id="' . $id . '" and id2="1"');

                    if ($newbuzon && $updateRead) {
                        ?>
                        <div class="message">Su mensaje se ha enviado con éxito.<br />

                            <?php
} else {
                        ?>
                            <div class="message">Ha ocurrido un error.<br />
                                <a href="/?id=<?php echo $id; ?>">Volver al mensaje</a></div>
                            <?php
}
                }

//Mostramos msgs
                ?>
                            <div class="content">
                                <?php
$req3 = $conn->query('select buzon.id, buzon.timestamp, buzon.message, buzon.user1type, tutor.id as tutorid, tutor.nombre as tnombre, tutor.apellido AS tapellido, tutor.img as timg, docente.id as docenteid, docente.img AS dimg, docente.nombre as dnombre, docente.apellido AS dapellido
from buzon, tutor, docente
where (buzon.user1 = "' . $email . '" OR buzon.user2 = "' . $email . '") AND buzon.id="' . $id . '" AND (buzon.user2=docente.email or buzon.user1=docente.email) AND tutor.email = "' . $email . '"  order by buzon.id2');
                ?>
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                    
                                    <h2 class="card-title">Asunto: <?php echo $title ?></h2><br />
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <div class="mailbox-read-info">

                                            <?php
                                        while ($fila = $req3->fetch(PDO::FETCH_ASSOC)) {

                                            ?>
                                            <h6>De: <?php
                                            if ($fila['user1type'] == 't') {
                                                if ($fila['timg'] != '') {
                                                    echo '<img src="/uploads/' . htmlentities($fila['timg']) . '" alt="Img Ususario" style="max-width:25px;max-height:25px;" />';
                                                }
                                                echo $fila['tnombre']." ".$fila['dapellido'];
                                                
                                            } else {
                                                if ($fila['dimg'] != '') {
                                                echo '<img src="/uploads/' . htmlentities($fila['dimg']) . '" alt="Img Ususario" style="max-width:25px;max-height:25px;" />';
                                            }
                                            echo $fila['dnombre']." ".$fila['dapellido'];
                                          
                                        }
                                            ?>

                                                <span
                                                    class="mailbox-read-time float-right"><?php echo date('m/d/Y H:i:s', $fila['timestamp']); ?></span>
                                            </h6>
                                            <div class="mailbox-read-message border-bottom">
                                                <?php echo $fila['message']; ?>
                                            </div>

                                            <?php
}
                ?>

                                        </div>

                                        <div class="card card-primary card-outline">
                                            <div class="card-header">
                                                Añadir a la conversación
                                            </div>
                                            <div class="card-body p-0">
                                                <form action="?id=<?php echo $id; ?>" method="post">
                                                    <label for="message" class="center">Mensaje</label><br />
                                                    <textarea class="form-control" cols="40" rows="5" name="message"
                                                        id="message"></textarea><br />
                                                    <input class="btn btn-primary" type="submit" value="Enviar" />
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.card-footer -->
                                </div>
                            </div>
                            <?php

            } else {
                echo '<div class="message">No tiene permisos</div>';
            }
        } else {
            echo '<div class="message">Este mensaje no existe.</div>';
        }
    } else {
        echo '<div class="message">El id del msg falla en algo...</div>';
    }

    ?>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <!-- End Wrapper -->
    <?php include_once 'template_lay/script.php';
    include_once "../template_layout/footer.php";
    ?>


</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}?>