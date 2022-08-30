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
    //$allAlumnosByTutor = $alumnos->allAlumnosByDocente($_SESSION['id']);
    // $addAlumnoByDocente = $alumnos->addAlumnoByDocente();

    include_once "../../Model/Curso.php";
    $curso = new Curso();
    $allCursosInfo = $curso->allCursosInfo();

    include_once "../../Model/Docente.php";
    $docente = new Docente();
    $allInfodocente = $docente->allInfoDocente($_SESSION['id']);
    $allAlumnosByDocenteId = $alumnos->allAlumnosByDocenteId($_SESSION['id']);

    include_once "../../Model/Tutor.php";
    $tutor = new Tutor();
    $allTutores = $tutor->allTutores();

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
                        <h1 class="m-0 text-dark">Gestión Alumnos Asignados</h1>
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
                        <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                        <a href="/view/docente/allAlumnos.php" class="btn btn-primary btn-block mb-3"
                            role="button">Gestionar Todos los Alumnos</a>
                        <?php }?>


                        <!-- Imagen Perfil -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="/uploads/<?php echo $allInfodocente['img']; ?>"
                                        alt="Imagen de <?php echo $allInfodocente['nombre']; ?>">
                                </div>

                                <h3 class="profile-username text-center"><?php echo $allInfodocente['nombre']; ?>
                                </h3>

                                <p class="text-muted text-center">
                                    <?php echo $allInfodocente['apellido'] . " " . $allInfodocente['apellido2']; ?>
                                </p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Email</b> <a class="float-right"><?php echo $allInfodocente['email']; ?></a>
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
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Alumnos </h3>


                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">

                                    <div class="table-responsive mailbox-messages">
                                        <table class="table table-hover table-striped">
                                            <tbody>
                                                <tr>
                                                    <th class="title_cell">Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Apellido2</th>
                                                    <th>Fecha Nacimiento</th>
                                                    <?php if ($isDocenteAdmin['is_admin'] == 1) {
        echo "<th>Editar Alumno</th>";
        echo "<th>Borrar Alumno</th>";

    }?>
                                                    <th>Horario/Asistencia</th>
                                                    <th>Calificaciones</th>
                                                </tr>
                                                <?php
foreach ($allAlumnosByDocenteId as $alumno) {

        ?>
                                                <tr>
                                                    <td class="mailbox-subject">
                                                        <?php echo htmlentities($alumno['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </td>
                                                    <td class="mailbox-answers">
                                                        <?php echo htmlentities($alumno['apellido'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </td>
                                                    <td class="mailbox-attachment">
                                                        <?php echo $alumno['apellido2']; ?></td>
                                                    <td class="mailbox-date">
                                                        <?php echo $alumno['fecha_nacimiento']; ?></td>

                                                    <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                                                    <td><button type="button" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#editarModal<?php echo $alumno['id'] ?>">
                                                            Editar
                                                        </button></td>

                                                    <td><button type="button" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal<?php echo $alumno['id'] ?>">
                                                            Eliminar
                                                        </button></td>

                                                    <?php
}?>
                                                    <td><a href="/Controller/perfilAlumnoCtrl.php?horarioAlumno=<?php echo $alumno['id'] ?>"
                                                            class="btn btn-primary btn-block mb-3"
                                                            role="button">Horario/Asistencia</a></td>
                                                    <td><a href="/Controller/perfilAlumnoCtrl.php?notasAlumno=<?php echo $alumno['id'] ?>"
                                                            class="btn btn-primary btn-block mb-3"
                                                            role="button">Calificaciones</a></td>
                                                </tr>

                                                <!-- Modal Editar -->
                                                <div class="modal fade" id="editarModal<?php echo $alumno['id'] ?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                                    Editar
                                                                    <?php echo $alumno['nombre'] . ' ' . $alumno['apellido'] . ' ' . $alumno['apellido2'] ?>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="../../Controller/perfilAlumnoCtrl.php?updateFromDocente=<?php echo $alumno['id'] ?>"
                                                                method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="img"
                                                                    value="<?php echo $alumno['img']; ?>">

                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                    <label for="nombre"
                                                                            class="col-form-label">NIF:<span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            name="nif"
                                                                            value="<?php echo $alumno['NIF'] ?>" required>
                                                                        <label for="nombre"
                                                                            class="col-form-label">Nombre:<span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            name="nombre"
                                                                            value="<?php echo $alumno['nombre'] ?>" required>
                                                                        <label for="apellido"
                                                                            class="col-form-label">Apellido:<span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            name="apellido"
                                                                            value="<?php echo $alumno['apellido'] ?>" required>
                                                                        <label for="apellido2"
                                                                            class="col-form-label">Apellido2:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="apellido2"
                                                                            value="<?php echo $alumno['apellido2'] ?>">
                                                                        <label for="fecha_nacimiento"
                                                                            class="col-form-label">Fecha
                                                                            Nacimiento:<span class="text-danger">*</span></label>
                                                                        <input type="date" class="form-control"
                                                                            name="fecha_nacimiento"
                                                                            value="<?php echo $alumno['fecha_nacimiento'] ?>" required>
                                                                        <div class="form-group">
                                                                            <label for="img">Imagen Perfil</label>
                                                                            <div class="input-group">
                                                                                <div class="custom-file">
                                                                                    <input type="file"
                                                                                        class="custom-file-input"
                                                                                        id="img" name="img">
                                                                                    <label class="custom-file-label"
                                                                                        for="img"></label>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <label for="tutor1"
                                                                            class="col-form-label">Persona de
                                                                            Contacto:<span class="text-danger">*</span></label>

                                                                        <select class="form-control form-control-sm"
                                                                            id="tutor1" name="tutor1">
                                                                            <option>- Seleccione - </option>
                                                                            <?php foreach ($allTutores as $tutor) {
            if ($alumno['tutor1'] == $tutor['id']) {
                echo "<option selected='selected' value='" . $tutor['id'] . "'>" . $tutor['nombre'] . " " . $tutor['apellido'] . " " . $tutor['apellido2'] . "</option>";
            } else {
                echo "<option value='" . $tutor['id'] . "'>" . $tutor['nombre'] . " " . $tutor['apellido'] . " " . $tutor['apellido2'] . "</option>";
            }

        }
        ?>
                                                                        </select>
                                                                        <label for="tutor2"
                                                                            class="col-form-label">Persona de Contacto
                                                                            Alternativa:</label>
                                                                        <select class="form-control form-control-sm"
                                                                            id="tutor2" name="tutor2">
                                                                            <option>- Seleccione - </option>

                                                                            <?php foreach ($allTutores as $tutor) {
            if ($alumno['tutor2'] == $tutor['id']) {
                echo "<option selected='selected' value='" . $tutor['id'] . "'>" . $tutor['nombre'] . " " . $tutor['apellido'] . " " . $tutor['apellido2'] . "</option>";
            } else {
                echo "<option value='" . $tutor['id'] . "'>" . $tutor['nombre'] . " " . $tutor['apellido'] . " " . $tutor['apellido2'] . "</option>";
            }
        }
        ?>
                                                                        </select>
                                                                        <label for="curso"
                                                                            class="col-form-label">Curso:<span class="text-danger">*</span></label>
                                                                        <select class="form-control form-control-sm"
                                                                            id="curso" name="curso">
                                                                            <?php foreach ($allCursosInfo as $curso) {
                                                                            if ($alumno['curso'] == $curso['id']) {
                                                                                echo "<option selected='selected' value='" . $curso['id'] . "'>" . $curso['nombre'] . " - " . $curso['ciclo'] . "</option>";
                                                                            } else {
                                                                                echo "<option value='" . $curso['id'] . "'>" . $curso['nombre'] . " - " . $curso['ciclo'] . "</option>";
                                                                            }

                                                                        }
                                                                        ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a class="btn btn-danger"
                                                                            data-dismiss="modal">Cancelar</a>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            name="enviar" id="enviar" href="">
                                                                            Editar
                                                                        </button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>


                                                </div>

                                    </div>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteModal<?php echo $alumno['id'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabe2" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar
                                                        <?php echo $alumno['nombre'] . ' ' . $alumno['apellido'] . ' ' . $alumno['apellido2'] ?>?
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-danger btn-rounded m-b-10 m-l-5"
                                                        data-dismiss="modal">NO
                                                    </button>
                                                    <a href="../../Controller/perfilAlumnoCtrl.php?deleteAlumno=<?php echo $alumno['id'] ?>"
                                                        class="btn btn-primary btn btn-rounded m-b-10 m-l-5">SI</a>
                                                </div>
                                            </div>
                                        </div>



                                        <?php
}
    ?>
                                        </tbody>
                                        </table>
                                        <!-- /.table -->

                                        <!-- /.mail-box-messages -->
                                    </div>


                                    <!-- /.card-body -->

                                </div>
                                <!-- /.card -->




                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- End Wrapper -->
    <?php include_once "../template_layout/footer.php";
    include_once 'template_lay/script.php'?>



</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}?>