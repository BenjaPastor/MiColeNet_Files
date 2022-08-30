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
                                        <img class="profile-user-img img-fluid img-circle" src="/uploads/<?php echo $allInfoTutor['img'];?>" alt="Imagen de <?php echo $allInfoTutor['nombre'];?>">
                                    </div>

                                    <h3 class="profile-username text-center"><?php echo $allInfoTutor['nombre'];?></h3>

                                    <p class="text-muted text-center"><?php echo $allInfoTutor['apellido']." ".$allInfoTutor['apellido2'];?></p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="float-right"><?php echo $allInfoTutor['email'];?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Teléfono</b> <a class="float-right"><?php echo $allInfoTutor['telefono'];?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Móvil</b> <a class="float-right"><?php echo $allInfoTutor['movil'];?></a>
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

                                <!-- Edit Perfil -->
                                <form role="form" action="/Controller/perfilCtrl.php" method="post"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="img" value="<?php echo $allInfoTutor['img'];?>">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nif">DNI/NIE/Pasaporte</label>
                                            <input type="text" class="form-control" id="nif" name="nif"
                                                placeholder="<?php echo $allInfoTutor['NIF'];?>" disabled required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="<?php echo $allInfoTutor['email'];?>" disabled required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Nombre<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                value="<?php echo $allInfoTutor['nombre'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido">Apellido<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="apellido" name="apellido"
                                                value="<?php echo $allInfoTutor['apellido'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido2">Apellido2</label>
                                            <input type="text" class="form-control" id="apellido2" name="apellido2"
                                                value="<?php echo $allInfoTutor['apellido2'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="contrasenya">Contraseña</label>
                                            <input type="password" class="form-control" id="contrasenya"
                                                name="contrasenya" placeholder="Contraseña"
                                                value="<?php echo $allInfoTutor['contrasenya'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono">Teléfono<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="telefono" placeholder="Teléfono"
                                                name="telefono" value="<?php echo $allInfoTutor['telefono'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="movil">Móvil</label>
                                            <input type="text" class="form-control" id="movil" placeholder="movil"
                                                name="movil" value="<?php echo $allInfoTutor['movil'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input type="text" class="form-control" id="calle" placeholder="calle"
                                                name="calle" value="<?php echo $allInfoTutor['calle'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="n_calle">Número</label>
                                            <input type="text" class="form-control" id="n_calle" placeholder="n_calle"
                                                name="n_calle" value="<?php echo $allInfoTutor['n_calle'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="CP">Código Postal</label>
                                            <input type="text" class="form-control" id="CP" placeholder="CP" name="CP"
                                                value="<?php echo $allInfoTutor['CP'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="poblacion">Población</label>
                                            <input type="text" class="form-control" id="poblacion"
                                                placeholder="poblacion" name="poblacion"
                                                value="<?php echo $allInfoTutor['poblacion'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="provincia">Provincia</label>
                                            <input type="text" class="form-control" id="provincia"
                                                placeholder="provincia" name="provincia"
                                                value="<?php echo $allInfoTutor['provincia'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="xtra_direccion">Extra Dirección</label>
                                            <input type="text" class="form-control" id="xtra_direccion"
                                                placeholder="Extra Dirección" name="xtra_direccion"
                                                value="<?php echo $allInfoTutor['xtra_direccion'];?>" >
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