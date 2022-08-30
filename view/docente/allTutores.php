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
    <?php include_once "template_lay/sidebar.php";

    if (isset($_SESSION['msg']) && $_SESSION['msg'] === 1) {
        //echo "swal(\"Success\", \"New Students Added From Excel Sheet\", \"success\");";
        $_SESSION['msg'] = 0;
    } elseif (isset($_SESSION['msg']) && $_SESSION['msg'] === 2) {
        //echo "swal(\"Failed\", \"While,New Students Added From Excel Sheet\", \"error\");";
        $_SESSION['msg'] = 0;
    }?>

    <!-- End Left Sidebar  -->
    <!-- Page wrapper  -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">Gestionar Todos los Tutores Legales (Personas de Contacto)</h1>
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
                            data-target="#addModal">Nueva Persona de Contacto
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
                                            Añadir Persona de Contacto
                                        </h5>
                                        <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form
                                        action="../../Controller/tutorCtrl.php?addTutor=1"
                                        method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nif">DNI/NIE/Pasaporte<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nif" name="nif" required
                                               >
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" required
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Nombre<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required
                                               >
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido">Apellido<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="apellido" name="apellido" required
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido2">Apellido2</label>
                                            <input type="text" class="form-control" id="apellido2" name="apellido2" required
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="contrasenya">Contraseña<span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="contrasenya"
                                                name="pass" required
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono"
                                                name="telefono" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="movil">Móvil</label>
                                            <input type="text" class="form-control" id="movil"
                                                name="movil" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input type="text" class="form-control" id="calle"
                                                name="calle" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="n_calle">Número</label>
                                            <input type="text" class="form-control" id="n_calle"
                                                name="n_calle" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="CP">Código Postal</label>
                                            <input type="text" class="form-control" id="CP" name="CP"
                                            required>
                                        </div>
                                        <div class="form-group">
                                            <label for="poblacion">Población</label>
                                            <input type="text" class="form-control" id="poblacion"
                                                 name="poblacion"
                                                 required>
                                        </div>
                                        <div class="form-group">
                                            <label for="provincia">Provincia</label>
                                            <input type="text" class="form-control" id="provincia"
                                                name="provincia"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="xtra_direccion">Extra Dirección</label>
                                            <input type="text" class="form-control" id="xtra_direccion"
                                                 name="xtra_direccion"
                                                 required>
                                        </div>
                                        <div class="form-group">
                                            <label for="img">Imagen Perfil</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="img" name="img" required>
                                                    <label class="custom-file-label" for="img"></label>
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
                                        <h3 class="card-title">Personas de Contacto</h3>


                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">

                                        <div class="table-responsive mailbox-messages">
                                            <table class="table table-hover table-striped">
                                                <tbody>
                                                    <tr>
                                                    <th>NIF</th>

                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Apellido2</th>

                                                        <?php if ($isDocenteAdmin['is_admin'] == 1) {
        echo "<th>Editar Persona</th>";
        echo "<th>Borrar Persona</th>";
    }?>
                                                    </tr>
                                                    <?php
foreach ($allTutores as $tutor) {

        ?>
                                                    <tr>

                                                        <td class="mailbox-answers">
                                                            <?php echo htmlentities($tutor['NIF'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </td>
                                                        <td class="mailbox-answers">
                                                            <?php echo htmlentities($tutor['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </td>
                                                        <td class="mailbox-answers">
                                                            <?php echo htmlentities($tutor['apellido'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </td> <td class="mailbox-answers">
                                                            <?php echo htmlentities($tutor['apellido2'], ENT_QUOTES, 'UTF-8'); ?>
                                                        </td>

                                                        <?php if ($isDocenteAdmin['is_admin'] == 1) {?>
                                                        <td><button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#editarModal<?php echo $tutor['id'] ?>">
                                                                Editar
                                                            </button></td>

                                                        <td><button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal<?php echo $tutor['id'] ?>">
                                                                Eliminar
                                                            </button></td>
                                                        <?php
                                                            }?>
                                                    </tr>

                                                    <!-- Modal Editar -->
                                                    <div class="modal fade" id="editarModal<?php echo $tutor['id'] ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        Editar
                                                                        <?php echo $tutor['nombre'];
        ?>
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form
                                                                    action="../../Controller/tutorCtrl.php?updateTutor=<?php echo $tutor['id'] ?>"
                                                                    method="post" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                    <div class="form-group">
                                            <label for="nif">DNI/NIE/Pasaporte<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nif" name="nif"
                                                placeholder="<?php echo $tutor['NIF']; ?>" value="<?php echo $tutor['NIF']; ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="<?php echo $tutor['email']; ?>" value="<?php echo $tutor['email']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Nombre<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                value="<?php echo $tutor['nombre']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido">Apellido<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="apellido" name="apellido"
                                                value="<?php echo $tutor['apellido']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido2">Apellido2</label>
                                            <input type="text" class="form-control" id="apellido2" name="apellido2"
                                                value="<?php echo $tutor['apellido2']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="contrasenya">Contraseña</label>
                                            <input type="password" class="form-control" id="contrasenya"
                                                name="contrasenya" placeholder="Contraseña"
                                                value="<?php echo $tutor['contrasenya']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono" placeholder="Teléfono"
                                                name="telefono" value="<?php echo $tutor['telefono']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="movil">Móvil</label>
                                            <input type="text" class="form-control" id="movil" placeholder="movil"
                                                name="movil" value="<?php echo $tutor['movil']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input type="text" class="form-control" id="calle" placeholder="calle"
                                                name="calle" value="<?php echo $tutor['calle']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="n_calle">Número</label>
                                            <input type="text" class="form-control" id="n_calle" placeholder="n_calle"
                                                name="n_calle" value="<?php echo $tutor['n_calle']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="CP">Código Postal</label>
                                            <input type="text" class="form-control" id="CP" placeholder="CP" name="CP"
                                                value="<?php echo $tutor['CP']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="poblacion">Población</label>
                                            <input type="text" class="form-control" id="poblacion"
                                                placeholder="poblacion" name="poblacion"
                                                value="<?php echo $tutor['poblacion']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="provincia">Provincia</label>
                                            <input type="text" class="form-control" id="provincia"
                                                placeholder="provincia" name="provincia"
                                                value="<?php echo $tutor['provincia']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="xtra_direccion">Extra Dirección</label>
                                            <input type="text" class="form-control" id="xtra_direccion"
                                                placeholder="Extra Dirección" name="xtra_direccion"
                                                value="<?php echo $tutor['xtra_direccion']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="img">Imagen Perfil</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input value="<?php echo $tutor['img']; ?>" type="file" class="custom-file-input" id="img" name="img" >
                                                    <label class="custom-file-label" for="img"></label>
                                                </div>

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
                                        <div class="modal fade" id="deleteModal<?php echo $tutor['id'] ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar
                                                            <?php echo $tutor['nombre'] ?>?
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
                                                        <a href="../../Controller/tutorCtrl.php?delTutor=<?php echo $tutor['id'] ?>"
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