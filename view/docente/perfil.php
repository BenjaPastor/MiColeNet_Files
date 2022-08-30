<?php
session_start();
if (isset($_SESSION['id'])) {
    include_once "../../url.php";
    include_once "../../Model/Usuario.php";


    include_once "../../Model/Docente.php";
    $docente = new docente();
    $allInfodocente = $docente->allInfodocente($_SESSION['id']);

    include_once "../../Model/Alumnos.php";
    $alumnos = new Alumnos();

    
    include_once "../../Model/Curso.php";
    $curso = new Curso();
 
     
    include_once "../../Model/Docente.php";
    $docente = new Docente();
    $allInfodocente = $docente->allInfoDocente($_SESSION['id']);

    include_once "../../Model/Asignatura.php";
    $asignatura = new Asignatura();
 
    ?>
<!DOCTYPE html>
<html lang="en">

<?php include_once "../template_layout/head.php" ?>

<body class="fix-header fix-sidebar">

 
    
        <!-- header header  -->
        <?php include_once "template_lay/header.php" ?>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <?php include_once "template_lay/sidebar.php" ?>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0 text-dark">Perfil</h1>
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
                                        <img class="profile-user-img img-fluid img-circle" src="/uploads/<?php echo $allInfodocente['img'];?>" alt="Imagen de <?php echo $allInfodocente['nombre'];?>">
                                    </div>

                                    <h3 class="profile-username text-center"><?php echo $allInfodocente['nombre'];?></h3>

                                    <p class="text-muted text-center"><?php echo $allInfodocente['apellido']." ".$allInfodocente['apellido2'];?></p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="float-right"><?php echo $allInfodocente['email'];?></a>
                                        </li>
            
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->


                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <!-- Editar Perfil -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Editar Datos</h3>
                                </div>

                                <!-- Start Formulario -->
                                <form role="form" action="/Controller/perfilCtrlDocente.php" method="post"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="img" value="<?php echo $allInfodocente['img'];?>">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nif">DNI/NIE/Pasaporte</label>
                                            <input type="text" class="form-control" id="cif" name="cif"
                                                placeholder="<?php echo $allInfodocente['CIF'];?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="<?php echo $allInfodocente['email'];?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                value="<?php echo $allInfodocente['nombre'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido">Apellido</label>
                                            <input type="text" class="form-control" id="apellido" name="apellido"
                                                value="<?php echo $allInfodocente['apellido'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido2">Apellido2</label>
                                            <input type="text" class="form-control" id="apellido2" name="apellido2"
                                                value="<?php echo $allInfodocente['apellido2'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="contrasenya">Contraseña</label>
                                            <input type="password" class="form-control" id="contrasenya"
                                                name="contrasenya" placeholder="Contraseña"
                                                value="<?php echo $allInfodocente['contrasenya'];?>">
                                        </div>
                                      
                                        <div class="form-group">
                                            <label for="img">Imagen Perfil</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="img" name="img">
                                                    <label class="custom-file-label" for="img"></label>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    
    <!-- End Wrapper -->
    <?php include_once "../template_layout/footer.php";
    include_once 'template_lay/script.php' ?>


</body>

</html>
<?php
}else{
    header('Location:../../index.php');
}?>