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
    $allCursosInfoAndTutor = $curso->allCursosInfoAndTutor();

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
                        <h1 class="m-0 text-dark">Gestiónar Todos los Cursos</h1>
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
                            data-target="#addModal">Nuevo Curso
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
                                            Añadir Curso
                                        </h5>
                                        <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form
                                        action="../../Controller/cursoCtrl.php?addCurso=1"
                                        method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nombre"
                                                    class="col-form-label">Nombre:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="nombre"
                                                    value="" required>
                                                <label for="ciclo"
                                                    class="col-form-label">Ciclo:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="ciclo"
                                                    value="" required>
                                                <label for="descripcion"
                                                    class="col-form-label">Descripción:<span class="text-danger">*</span></label>
                                                <textarea class="form-control"
                                                    name="descripcion"
                                                    value="" required></textarea>
                                                <label for="docente_tutor"
                                                    class="col-form-label">Tutor:<span class="text-danger">*</span></label>
                                                <select class="form-control form-control-sm"
                                                    id="docente_tutor" name="docente_tutor">
                                                    <?php foreach ($allInfodocentes as $docente) {
        echo "<option value='" . $docente['id'] . "'>" . $docente['nombre'] . " " . $docente['apellido'] . " " . $docente['apellido2'] . "</option>";
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
                                        <h3 class="card-title">Cursos </h3>


                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">

                                        <div class="table-responsive mailbox-messages">
                                            <table class="table table-hover table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th class="title_cell">Ciclo</th>
                                                        <th>Descripcion</th>
                                                        <th>Docente Tutor</th>
                                                        <?php if ($isDocenteAdmin['is_admin'] == 1) {
        echo "<th>Editar Curso</th>";
        echo "<th>Borrar Curso</th>";
    }?>
                                                    </tr>
                                                    <?php
foreach ($allCursosInfoAndTutor as $curso) {

        ?>
                                                    <tr>

                                                        <td class="mailbox-answers">
                                                            <?php echo htmlentities($curso['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </td>
                                                        <td class="mailbox-attachment">
                                                            <?php echo $curso['ciclo']; ?></td>
                                                            <td class="mailbox-attachment">
                                                            <?php echo $curso['descripcion']; ?></td>
                                                        <td class="mailbox-date">
                                                            <?php echo $curso['dnombre'] . " " . $curso['dapellido']; ?></td>

                                                        <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                                                        <td><button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#editarModal<?php echo $curso['id'] ?>">
                                                                Editar
                                                            </button></td>

                                                        <td><button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal<?php echo $curso['id'] ?>">
                                                                Eliminar
                                                            </button></td>
                                                        <?php
}?>
                                                    </tr>

                                                    <!-- Modal Editar -->
                                                    <div class="modal fade" id="editarModal<?php echo $curso['id'] ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        Editar
                                                                        <?php echo $curso['nombre'] . ' ' . $curso['ciclo'];
                                                                       ?>
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form
                                                                    action="../../Controller/cursoCtrl.php?updateFromDocente=<?php echo $curso['id'] ?>"
                                                                    method="post">
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="nombre"
                                                                                class="col-form-label">Nombre:</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nombre"
                                                                                value="<?php echo $curso['nombre'] ?>">
                                                                            <label for="apellido"
                                                                                class="col-form-label">Ciclo:</label>
                                                                            <input type="text" class="form-control"
                                                                                name="ciclo"
                                                                                value="<?php echo $curso['ciclo'] ?>">
                                                                            <label for="descripcion"
                                                                                class="col-form-label">Descripción:</label>
                                                                            <textarea type="text" class="form-control"
                                                                                name="descripcion"
                                                                                value="<?php echo $curso['descripcion'] ?>"><?php echo $curso['descripcion'] ?></textarea>
                                                                                <label for="docente_tutor"
                                                                    class="col-form-label">Tutor:</label>
                                                                <select class="form-control form-control-sm"
                                                                    id="docente_tutor" name="docente_tutor">
                                                                    <?php foreach ($allInfodocentes as $docente) {
                                                                        if ($curso['docente_tutor'] = $docente['id']) {
                                                                            
                                                                            echo "<option selected='selected' value='" . $docente['id'] . "'>" . $docente['nombre'] . " " . $docente['apellido'] . " " . $docente['apellido2'] . " </option>";
                                                                        }  else {
                                                                            echo "<option  value='" . $docente['id'] . "'>" . $docente['nombre'] . " " . $docente['apellido'] . " " . $docente['apellido2'] . " </option>";
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
                                        <div class="modal fade" id="deleteModal<?php echo $curso['id'] ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar
                                                            <?php echo $curso['nombre'] . ' ' . $curso['ciclo'] ?>?
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
                                                        <a href="../../Controller/cursoCtrl.php?deleteCurso=<?php echo $curso['id'] ?>"
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