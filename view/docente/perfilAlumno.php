<?php
session_start();
if (isset($_SESSION['id'])) {
    include_once "../../url.php";

    include_once "../../Model/Docente.php";
    $docente = new docente();
    $allInfodocente = $docente->allInfodocente($_SESSION['id']);

    include_once "../../Model/Alumnos.php";
    $alumnos = new Alumnos();
    $numOfAlumnos = $alumnos->numberOfAlumnos($_SESSION['id']);
    $allAlumnosBydocente = $alumnos->allAlumnosBydocente($_SESSION['id']);
    $alldocenteesByAlumno = $alumnos->alldocenteesByAlumno($_SESSION['id'], $_SESSION['alumno_id']);
    
    include_once "../../Model/Curso.php";
    $curso = new Curso();
    $cursoByAlumno = $curso->cursoByAlumno($_SESSION['alumno_id']);
    

  
      //elegir alumno
      $choosenAlumno = $alumnos->choosenAlumno($_SESSION['perfilAlumno']);

      include_once "../../Model/Asignatura.php";
      $asignatura = new Asignatura();
      $numberOfAsignaturas = $asignatura->numberOfAsignaturas($_SESSION['alumno_id']);
      $allAsignaturasByAlumno = $asignatura->allAsignaturasByAlumno($_SESSION['alumno_id']);
  

 
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
        <<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0 text-dark">Datos de <?php echo $choosenAlumno['nombre']." ".$choosenAlumno['apellido']?></h1>
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
                     src="/uploads/<?php
                     
                         echo $choosenAlumno['img'];
                   
                     ?>"
                     alt="Imagen de <?php echo $choosenAlumno['nombre']." ".$choosenAlumno['apellido']?>">
              </div>

              <h3 class="profile-username text-center"><?php echo $choosenAlumno['nombre']?></h3>

              <p class="text-muted text-center"><?php echo $choosenAlumno['apellido']." ".$choosenAlumno['apellido']?></p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Curso</b> <a class="float-right"><?php echo $cursoByAlumno['nombre']?></a>

                </li>
                <li class="list-group-item">
                  <b>Ciclo</b> <a class="float-right"><?php echo $cursoByAlumno['ciclo']?></a>

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
            <form role="form" action="/Controller/perfilAlumnoCtrl.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="nif">DNI/NIE/Pasaporte</label>
                  <input type="text" class="form-control" id="nif" name="nif" placeholder="<?php echo $choosenAlumno['NIF']?>" disabled>
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre"  name="nombre" value="<?php echo $choosenAlumno['nombre']?> ">
                </div>
                <div class="form-group">
                  <label for="apellido">Apellido</label>
                  <input type="text" class="form-control" id="apellido"  name="apellido" value="<?php echo $choosenAlumno['apellido']?> ">
                </div>
                <div class="form-group">
                  <label for="apellido2">Apellido2</label>
                  <input type="text" class="form-control" id="apellido2"  name="apellido2" value="<?php echo $choosenAlumno['apellido2']?> ">
                </div>
                <div class="form-group">
                  <label for="fecha_nacimiento">Fecha Nacimiento</label>
                  <input type="date" class="form-control" id="fecha_nacimiento" placeholder="Fecha Nacimiento"  name="fecha_nacimiento" value="<?php echo $choosenAlumno['fecha_nacimiento']?>">
                </div>
                <div class="form-group">
                  <label for="docentees">docentees</label>
                  <input type="text" class="form-control" id="docente" placeholder="docentees"  name="docente" value="<?php 
                  
                  
                    echo $alldocenteesByAlumno['nombre']." ".$alldocenteesByAlumno['apellido']." ".$alldocenteesByAlumno['apellido2'];
                                 
                  ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="img">Imagen Perfil</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="img" name="img">
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

    <?php include_once "../template_layout/footer.php";
     include_once 'template_lay/script.php' ?>


</body>

</html>
<?php
}else{
    header('Location:../../index.php');
}?>