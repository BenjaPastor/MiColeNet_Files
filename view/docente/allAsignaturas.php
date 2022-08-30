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
    //$allAlumnos = $alumnos->allAlumnos();
    // $addAlumnoByDocente = $alumnos->addAlumnoByDocente();

    include_once "../../Model/Curso.php";
    $curso = new Curso();

    $allCursosInfo = $curso->allCursosInfo();

    include_once "../../Model/Docente.php";
    $docente = new Docente();
    $allInfodocente = $docente->allInfoDocente($_SESSION['id']);
    //$allInfodocentes = $docente->allInfodocentes();

    include_once "../../Model/Tutor.php";
    $tutor = new Tutor();
    //$allTutores = $tutor->allTutores();

    include_once "../../Model/Asignatura.php";
    $asignatura = new Asignatura();
    $allAsignaturasInfo = $asignatura->allAsignaturasInfo();
    $temarioByAsignatura = $asignatura->temarioByAsignatura($_SESSION['asignatura_id']);

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
                        <h1 class="m-0 text-dark">Gestionar Todas las Asignaturas</h1>
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
                        <button type="button" class="btn btn-primary btn-block mb-3" data-toggle="modal"
                            data-target="#addModal">Nueva Asignatura
                        </button>
                        <?php }?>
                        <!-- Modal Add -->
                        <div class="modal fade" id="addModal"
                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                            Añadir Asignatura
                                        </h5>
                                        <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form
                                        action="../../Controller/asignaturaCtrl.php?addAsignatura=1"
                                        method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nombre"
                                                    class="col-form-label">Nombre:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="nombre"
                                                    value="" required>

                                                <label for="descripcion"
                                                    class="col-form-label">Descripción:<span class="text-danger">*</span></label>
                                                <textarea class="form-control"
                                                    name="descripcion"
                                                    value="" required></textarea>
                                                <label for="curso"
                                                    class="col-form-label">Curso:<span class="text-danger">*</span></label>
                                                <select class="form-control form-control-sm"
                                                    id="curso" name="curso">
                                                    <?php foreach ($allCursosInfo as $curso) {
        echo "<option value='" . $curso['id'] . "'>" . $curso['nombre'] . " - " . $curso['ciclo'] . "</option>";
    }
    ?>
                                                </select>
                                                 </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</a>
                                                <button type="submit"
                                                    class="btn btn-primary" name="enviar"
                                                    id="enviar" href="">
                                                    Guardar
                                                </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            </div>

                        </div>
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
                                            <b>Email</b> <a
                                                class="float-right"><?php echo $allInfodocente['email']; ?></a>
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
                                        <h3 class="card-title">Asignaturas </h3>


                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">

                                        <div class="table-responsive mailbox-messages">
                                            <table class="table table-hover table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Descripcion</th>
                                                        <th>Curso</th>
                                                        <?php if ($isDocenteAdmin['is_admin'] == 1) {
        echo "<th>Editar Asignatura</th>";
        echo "<th>Borrar Asignatura</th>";
    }?>
                                                    </tr>
                                                    <?php
foreach ($allAsignaturasInfo as $asignatura) {

        ?>
                                                    <tr>

                                                        <td class="mailbox-answers">
                                                            <?php echo htmlentities($asignatura['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </td>
                                                        <td class="mailbox-attachment">
                                                            <?php echo $asignatura['descripcion']; ?></td>
                                                        <td class="mailbox-date">
                                                            <?php echo $asignatura['cnombre'] . " - " . $asignatura['cciclo']; ?></td>

                                                        <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                                                        <td><button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#editarModal<?php echo $asignatura['id'] ?>">
                                                                Editar
                                                            </button></td>

                                                        <td><button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal<?php echo $asignatura['id'] ?>">
                                                                Eliminar
                                                            </button></td>
                                                        <?php
}?>
                                                    </tr>

                                                    <!-- Modal Editar -->
                                                    <div class="modal fade" id="editarModal<?php echo $asignatura['id'] ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        Editar
                                                                        <?php echo $asignatura['nombre'] . ' ' . $asignatura['cnombre'] . $asignatura['cciclo'];
        ?>
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form
                                                                    action="../../Controller/asignaturaCtrl.php?updateFromDocente=<?php echo $asignatura['id'] ?>"
                                                                    method="post">
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="nombre"
                                                                                class="col-form-label">Nombre:<span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                name="nombre"
                                                                                value="<?php echo $asignatura['nombre'] ?>">

                                                                            <label for="descripcion"
                                                                                class="col-form-label">Descripción:<span class="text-danger">*</span></label>
                                                                            <textarea type="text" class="form-control"
                                                                                name="descripcion"
                                                                                value="<?php echo $asignatura['descripcion'] ?>"><?php echo $asignatura['descripcion'] ?></textarea>
                                                                                <label for="docente_tutor"
                                                                        class="col-form-label">Curso:<span class="text-danger">*</span></label>
                                                                        <select class="form-control form-control-sm"
                                                    id="curso" name="curso">
                                                    <?php foreach ($allCursosInfo as $curso) {
                                                        if ($asignatura['curso'] == $curso['id']) {

                                                            echo "<option selected='selected' value='" . $curso['id'] . "'>" . $curso['nombre'] . " - " . $curso['ciclo'] . "</option>";

                                                        } else {
                                                            echo "<option value='" . $curso['id'] . "'>" . $curso['nombre'] . " - " . $curso['ciclo'] . "</option>";

                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                                        </div>

                                                                     </div>
                                                                        <div class="modal-footer">
                                                                            <a class="btn btn-danger"
                                                                                data-dismiss="modal">Cancelar</a>
                                                                            <button type="submit"
                                                                                class="btn btn-primary" name="enviar"
                                                                                id="enviar" href="">
                                                                                Editar
                                                                            </button>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                        </div>


                                                    </div>

                                        </div>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal<?php echo $asignatura['id'] ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar
                                                            <?php echo $asignatura['nombre'] . ' ' . $asignatura['cnombre'] . $asignatura['cciclo'] ?>?
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
                                                        <a href="../../Controller/asignaturaCtrl.php?deleteAsignatura=<?php echo $asignatura['id'] ?>"
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