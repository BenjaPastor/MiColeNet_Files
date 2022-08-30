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
                        <h1 class="m-0 text-dark">Gestionar Contenido de las Secciones</h1>
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
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">

                                <div id="asdf" class="panel-collapse collapse in">
                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                        commodo consequat.</div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-1">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapse1">Gestión Sección <?php echo $infoFrontEnd['menu1'] ?>
                                        </h3>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0 panel-collapse collapse in" id="collapse1">

                                        <div class="table-responsive mailbox-messages">

                                            <form action="../../Controller/frontendCtrl.php?updateSeccion=1"
                                                method="post" enctype="multipart/form-data">
                                                <div class="col-md-12">
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>SubTítulo<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu1_subtitle'] ?>"
                                                                name="menu1_subtitle" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group w-50">
                                                            <label>Icono Bloque 1<span class="text-danger">*</span></label>
                                                            <input
                                                                class="form-control icp icono1 icp-auto iconpicker-input"
                                                                value="<?php echo $infoFrontEnd['menu1_icon1'] ?>"
                                                                type="text" name="menu1_icon1" required>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Título Bloque 1<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu1_icon1_title'] ?>"
                                                                name="menu1_icon1_title" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Texto Bloque 1<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu1_icon1_text'] ?>"
                                                                name="menu1_icon1_text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group w-50">
                                                            <label>Icono Bloque 2<span class="text-danger">*</span></label>
                                                            <input
                                                                class="form-control icp icono2 icp-auto iconpicker-input"
                                                                value="<?php echo $infoFrontEnd['menu1_icon2'] ?>"
                                                                type="text" name="menu1_icon2" required>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Título Bloque 2<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu1_icon2_title'] ?>"
                                                                name="menu1_icon2_title" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Texto Bloque 2<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu1_icon2_text'] ?>"
                                                                name="menu1_icon2_text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group w-50">
                                                            <label>Icono Bloque 3<span class="text-danger">*</span></label>
                                                            <input
                                                                class="form-control icp icono3 icp-auto iconpicker-input"
                                                                value="<?php echo $infoFrontEnd['menu1_icon3'] ?>"
                                                                type="text" name="menu1_icon3" required>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Título Bloque 3<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu1_icon3_title'] ?>"
                                                                name="menu1_icon3_title" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Texto Bloque 3<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu1_icon3_text'] ?>"
                                                                name="menu1_icon3_text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-primary" name="enviar"
                                                        id="enviar" href="">
                                                        Guardar Todo
                                                    </button>
                                                </div>
                                            </form>
                                            <!-- /.card-body -->

                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.row -->
                                </div>

                                <!-- Seccion 2-->
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapse2">Gestión Sección <?php echo $infoFrontEnd['menu2'] ?>
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0 panel-collapse collapse in" id="collapse2">

                                        <div class="table-responsive mailbox-messages">

                                            <form action="../../Controller/frontendCtrl.php?updateSeccion=2"
                                                method="post" enctype="multipart/form-data">
                                                <div class="col-md-12">
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Subtítulo<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu2_subtitle'] ?>"
                                                                name="menu2_subtitle">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Texto<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu2_text'] ?>"
                                                                name="menu2_text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Texto Top Icono 1<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu2_icon1_top'] ?>"
                                                                name="menu2_icon1_top">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Texto Icono 1<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu2_icon1_text'] ?>"
                                                                name="menu2_icon1_text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Texto Top Icono 2<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu2_icon2_top'] ?>"
                                                                name="menu2_icon2_top">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Texto Icono 2<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu2_icon2_text'] ?>"
                                                                name="menu2_icon2_text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Texto Top Icono 3<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu2_icon3_top'] ?>"
                                                                name="menu2_icon3_top">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Texto Icono 3<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu2_icon3_text'] ?>"
                                                                name="menu2_icon3_text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-primary" name="enviar"
                                                        id="enviar" href="">
                                                        Guardar Todo
                                                    </button>
                                                </div>
                                            </form>
                                            <!-- /.card-body -->

                                        </div>
                                        <!-- /.card -->




                                    </div>
                                    <!-- /.row -->
                                </div>
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapse4">Gestión Sección Dirección Del Centro
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0 panel-collapse collapse in" id="collapse4">

                                        <div class="table-responsive mailbox-messages">

                                            <form action="../../Controller/frontendCtrl.php?updateSeccion=4"
                                                method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="img1" value="<?php echo $infoFrontEnd['foto_direc1']; ?>">
                                                <input type="hidden" name="img2" value="<?php echo $infoFrontEnd['foto_direc2']; ?>">
                                                <input type="hidden" name="img3" value="<?php echo $infoFrontEnd['foto_direc3']; ?>">
                                                <div class="col-md-12">
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label for="img1">Imagen Dirección 1<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="img1" name="img1">
                                                                    <label class="custom-file-label" for="img1"></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="img2">Imagen Dirección 2<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="img2" name="img2">
                                                                    <label class="custom-file-label" for="img2"></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="img3">Imagen Dirección 3<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="img3" name="img3">
                                                                    <label class="custom-file-label" for="img3"></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-primary" name="enviar"
                                                        id="enviar" href="">
                                                        Guardar Todo
                                                    </button>
                                                </div>
                                            </form>
                                            <!-- /.card-body -->

                                        </div>
                                        <!-- /.card -->




                                    </div>
                                    <!-- /.row -->
                                </div>
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapse5">Gestión Sección Testimonios
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0 panel-collapse collapse in" id="collapse5">

                                        <div class="table-responsive mailbox-messages">

                                            <form action="../../Controller/frontendCtrl.php?updateSeccion=5"
                                                method="post" enctype="multipart/form-data">
                                                
                                                <div class="col-md-12">
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Datos Testimonio 1<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['testimonio1'] ?>"
                                                                name="testimonio1">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Texto Testimonio 1<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['testimonio1_text'] ?>"
                                                                name="testimonio1_text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Datos Testimonio 2<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['testimonio2'] ?>"
                                                                name="testimonio2">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Texto Testimonio 2<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['testimonio2_text'] ?>"
                                                                name="testimonio2_text">
                                                        </div>


                                                    </div>

                                                </div>
                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-primary" name="enviar"
                                                        id="enviar" href="">
                                                        Guardar Todo
                                                    </button>
                                                </div>
                                            </form>
                                            <!-- /.card-body -->

                                        </div>
                                        <!-- /.card -->




                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- Sección 3 -->
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapse3">Gestión Sección <?php echo $infoFrontEnd['menu3'] ?>
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0 panel-collapse collapse in" id="collapse3">

                                        <div class="table-responsive mailbox-messages">

                                            <form action="../../Controller/frontendCtrl.php?updateSeccion=3"
                                                method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="img1" value="<?php echo $infoFrontEnd['menu3_1_img']; ?>">
                                                <input type="hidden" name="img2" value="<?php echo $infoFrontEnd['menu3_2_img']; ?>">
                                                <input type="hidden" name="img3" value="<?php echo $infoFrontEnd['menu3_3_img']; ?>">
                                                <div class="col-md-12">
                                                    <div class="col-sm-12 m-2">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Subtitulo<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu3_subtitle'] ?>"
                                                                name="menu3_subtitle">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="img1">Imagen 1<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="img1" name="img1">
                                                                    <label class="custom-file-label" for="img1"></label>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <label>Titulo Imagen 1<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Descripción SEO también"
                                                                    value="<?php echo $infoFrontEnd['menu3_1_title'] ?>"
                                                                    name="menu3_1_title">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Texto Imagen 1<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu3_1_text'] ?>"
                                                                name="menu3_1_text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="img2">Imagen 2<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="img2" name="img2">
                                                                    <label class="custom-file-label" for="img2"></label>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <label>Titulo Imagen 2<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Descripción SEO también"
                                                                    value="<?php echo $infoFrontEnd['menu3_2_title'] ?>"
                                                                    name="menu3_2_title">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Texto Imagen 2<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu3_2_text'] ?>"
                                                                name="menu3_2_text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="img3">Imagen 3<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="img3" name="img3">
                                                                    <label class="custom-file-label" for="img3"></label>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <label>Titulo Imagen 3<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Descripción SEO también"
                                                                    value="<?php echo $infoFrontEnd['menu3_3_title'] ?>"
                                                                    name="menu3_3_title">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Texto Imagen 3<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Descripción SEO también"
                                                                value="<?php echo $infoFrontEnd['menu3_3_text'] ?>"
                                                                name="menu3_3_text">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-primary" name="enviar"
                                                        id="enviar" href="">
                                                        Editar
                                                    </button>
                                                </div>
                                        </div>

                                        </form>
                                    </div>

                                    <!-- /.card-body -->

                                </div>
                                <!-- /.card -->




                            </div>
                            <!-- /.row -->
                        </div>
                    </div> <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->


    <!-- End Wrapper -->
    <?php include_once "../template_layout/footer.php";
    include_once 'template_lay/script.php'?>
    <script>
/**
 *  FontAwesome Selector
 * ====================================================
 */

$('.icono1, .icono2, .icono3').iconpicker(

{placement: 'right', 
collision: 'none',
animation: true,
hideOnSelect: true, 
container: false, 
searchInFooter: false}
);
    </script>


</body>

</html>
<?php
} else {
    header('Location:../../index.php');
}?>