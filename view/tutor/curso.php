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
          <h1 class="m-0 text-dark">Datos de <?php echo $cursoByAlumno['nombre']." de ".$cursoByAlumno['ciclo']?></h1>
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


          <div class="card card-primary card-outline">
            <div class="card-body box-profile">


              <h3 class="profile-username text-center"><?php echo $cursoByAlumno['nombre']?></h3>



              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Curso</b> <a class="float-right"><?php echo $cursoByAlumno['nombre']?></a>

                </li>
                <li class="list-group-item">
                  <b>Ciclo</b> <a class="float-right"><?php echo $cursoByAlumno['ciclo']?></a>

                </li>
                <li class="list-group-item">
                  <strong><i class="fas fa-book mr-1"></i>Descripción</strong>
                  <p class="text-muted">
                  <?php echo $cursoByAlumno['descripcion']?>
                </p>

                </li>

              </ul>
            </div>
            <!-- /.card-body -->
          </div>


          <!-- /.card -->


        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">


              <h3>
                Asignaturas:
                <?php
                echo $numberOfAsignaturas; ?>
                </h3>
                  <ul class="list-group list-group-unbordered mb-3">
                <?php
               
               
                foreach ($allAsignaturasByAlumno as $asignatura) {
                  $asig = $asignatura['nombre'];
                    $desc = $asignatura['descripcion'];
                    echo "<li class='list-group-item'><b>$asig</b><br />";
                    echo "$desc <a class='float-right'></a></li>";
                } ?>
                   </ul>
            </div>
            <!-- /.card-body -->

          </div>
        </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->


    </div>
    <!-- End Wrapper -->
    <?php include_once "../template_layout/footer.php";
    include_once 'template_lay/script.php' ?>


</body>

</html>
<?php
}else{
    header('Location:../../index.php');
}?>