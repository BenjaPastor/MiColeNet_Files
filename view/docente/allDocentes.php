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
    $allInfodocentes = $docente->allInfodocentes();

    include_once "../../Model/Tutor.php";
    $tutor = new Tutor();
    //$allTutores = $tutor->allTutores();

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
                        <h1 class="m-0 text-dark">Gestiónar Todos los Docentes</h1>
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
                            data-target="#addModal">Nuevo Docente
                        </button>
                        <?php }?>

                        <div class="modal fade" id="addModal"
                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                            Añadir Docente
                                        </h5>
                                        <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form
                                        action="../../Controller/perfilCtrlDocente.php?addDocente=1"
                                        method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="CIF"
                                                    class="col-form-label">CIF:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="CIF"
                                                    value="" required>
                                                <label for="nombre"
                                                    class="col-form-label">Nombre:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="nombre"
                                                    value="" required>
                                                <label for="apellido"
                                                    class="col-form-label">Apellido:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="apellido"
                                                    value="" required>
                                                <label for="apellido2"
                                                    class="col-form-label">Apellido2:</label>
                                                <input type="text" class="form-control"
                                                    name="apellido2"
                                                    value="" required>
                                                <label for="email"
                                                    class="col-form-label">Email:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="email"
                                                    value="" required>
                                                <label for="pass"
                                                    class="col-form-label">Contrseña:<span class="text-danger">*</span></label>
                                                <input type="password" class="form-control"
                                                    name="pass"
                                                    value="" required>
                                                    <label for="img">Imagen Perfil</label>

                                                    <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file"
                                                                                    class="custom-file-input" id="img"
                                                                                    name="img" required>
                                                                                <label class="custom-file-label"
                                                                                    for="img"></label>
                                                                            </div>

                                                                        </div>
                                                    <label for="is_admin"
                                                    class="col-form-label">Admin?<span class="text-danger">*</span></label>
                                                    <div class="form-group">

                                                        <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="is_Admin1add" name="is_admin" value="1">
                                                        <label for="is_Admin1add" class="custom-control-label">Sí</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" checked= "" type="radio" id="is_Admin2add" name="is_admin" value="0">
                                                        <label for="is_Admin2add" class="custom-control-label">No </label>
                                                        </div>


                                                    </div>

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
                                        <h3 class="card-title">Docentes </h3>


                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">

                                        <div class="table-responsive mailbox-messages">
                                            <table class="table table-hover table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>CIF</th>
                                                        <th class="title_cell">Nombre</th>
                                                        <th>Apellido</th>
                                                        <th>Apellido2</th>
                                                        <th>email</th>
                                                        <?php if ($isDocenteAdmin['is_admin'] == 1) {
        echo "<th>Editar Docente</th>";
        echo "<th>Borrar Docente</th>";
    }?>
                                                    </tr>
                                                    <?php
foreach ($allInfodocentes as $docente) {

        ?>
                                                    <tr>
                                                        <td class="mailbox-subject">
                                                            <?php echo htmlentities($docente['CIF'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </td>
                                                        <td class="mailbox-answers">
                                                            <?php echo htmlentities($docente['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </td>
                                                        <td class="mailbox-attachment">
                                                            <?php echo $docente['apellido']; ?></td>
                                                            <td class="mailbox-attachment">
                                                            <?php echo $docente['apellido2']; ?></td>
                                                        <td class="mailbox-date">
                                                            <?php echo $docente['email']; ?></td>

                                                        <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                                                        <td><button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#editarModal<?php echo $docente['id'] ?>">
                                                                Editar
                                                            </button></td>

                                                        <td><button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal<?php echo $docente['id'] ?>">
                                                                Eliminar
                                                            </button></td>
                                                        <?php
}?>
                                                    </tr>

                                                    <!-- Modal Editar -->
                                                    <div class="modal fade" id="editarModal<?php echo $docente['id'] ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        Editar
                                                                        <?php echo $docente['nombre'] . ' ' . $docente['apellido'] . ' ' . $docente['apellido2'] ?>
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form
                                                                    action="../../Controller/perfilCtrlDocente.php?updateFromDocente=<?php echo $docente['id'] ?>"
                                                                    method="post" enctype="multipart/form-data">
                                                                    <input type="hidden" name="img"
                                                                value="<?php echo $docente['img']; ?>">
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="nombre"
                                                                                class="col-form-label">Nombre: <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                name="nombre"
                                                                                value="<?php echo $docente['nombre'] ?>">
                                                                            <label for="apellido"
                                                                                class="col-form-label">Apellido:<span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                name="apellido"
                                                                                value="<?php echo $docente['apellido'] ?>">
                                                                            <label for="apellido2"
                                                                                class="col-form-label">Apellido2:</label>
                                                                            <input type="text" class="form-control"
                                                                                name="apellido2"
                                                                                value="<?php echo $docente['apellido2'] ?>">
                                                                            <label for="email"
                                                                                class="col-form-label">Email:<span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                name="email"
                                                                                value="<?php echo $docente['email'] ?>">
                                                                                <label for="img">Imagen Perfil</label>

                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file"
                                                                                    class="custom-file-input" id="img"
                                                                                    name="img">
                                                                                <label class="custom-file-label"
                                                                                    for="img"></label>
                                                                            </div>

                                                                        </div>
                                                                                <div class="form-group">
                                                                                <label for="is_admin"
                                                                                class="col-form-label">Admin?</label>
                                                                                <div class="custom-control custom-radio">

                                                                                <input class="custom-control-input" type="radio" id="is_Admin1-<?php echo $docente['id'] ?>" name="is_admin" value="1" <?php
                                                                                if ($docente['is_admin'] == '1') {
                                                                                    echo "checked = ''";
                                                                                } ?>>
                                                                                <label for="is_Admin1-<?php echo $docente['id'] ?>" class="custom-control-label">Sí</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio">
                                                                                <input class="custom-control-input"  type="radio" id="is_Admin2-<?php echo $docente['id'] ?>" name="is_admin" value="0" <?php
                                                                                if ($docente['is_admin'] == '0') {
                                                                                    echo "checked = ''";
                                                                                } ?>>
                                                                                <label for="is_Admin2-<?php echo $docente['id'] ?>" class="custom-control-label">No </label>
                                                                                </div>


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
                                        <div class="modal fade" id="deleteModal<?php echo $docente['id'] ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar
                                                            <?php echo $docente['nombre'] . ' ' . $docente['apellido'] . ' ' . $docente['apellido2'] ?>?
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
                                                        <a href="../../Controller/perfilCtrlDocente.php?deleteDocente=<?php echo $docente['id'] ?>"
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