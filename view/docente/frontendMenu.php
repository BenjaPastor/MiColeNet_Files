<?php
session_start();
if (isset($_SESSION['id'])) {
    include_once "../../url.php";
    include_once "../../Model/Usuario.php";

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

    $isDocenteAdmin = $docente->isDocenteAdmin($_SESSION['id']);

    include_once "../../Model/FrontEnd.php";
    $infoFrontEnd = new FrontEnd();

    $infoFrontEnd = $infoFrontEnd->infoFrontEnd();

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
                        <h1 class="m-0 text-dark">Gestionar Menú y Secciones del FrontEnd</h1>
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
                                    <h3 class="card-title">Gestión Secciones </h3>


                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">

                                    <div class="table-responsive mailbox-messages">

                                    <form action="../../Controller/frontendCtrl.php?updateMenu=1" method="post" enctype="multipart/form-data">
                                        <div class="col-md-12">
                                            <div class="col-sm-12 m-2">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Nombre Sección Nº1<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Descripción SEO también"
                                                        value="<?php echo $infoFrontEnd['menu1'] ?>" name="menu1" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 m-2">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Nombre Sección Nº2<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Descripción SEO también"
                                                        value="<?php echo $infoFrontEnd['menu2'] ?>" name="menu2" required>
                                                </div>
                                            </div>                          <div class="col-sm-12 m-2">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Nombre Sección Nº3<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Descripción SEO también"
                                                        value="<?php echo $infoFrontEnd['menu3'] ?>" name="menu3" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                           
                                            <button type="submit" class="btn btn-primary" name="enviar" id="enviar"
                                                href="">
                                                Editar
                                            </button>
                                        </div>
                                    </form>
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