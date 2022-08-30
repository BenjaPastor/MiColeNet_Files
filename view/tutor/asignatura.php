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
    $calificacionAsignaturaByAlumno = $alumnos->calificacionAsignaturaByAlumno($_SESSION['asignatura_id'],$_SESSION['alumno_id']);
    $notaFinalByAsignatura = $alumnos->notaFinalByAsignatura($_SESSION['asignatura_id'], $_SESSION['alumno_id']);
    
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
      $asignaturaInfoById = $asignatura->asignaturaInfoById($_SESSION['asignatura_id']);
      $temarioByAsignatura = $asignatura->temarioByAsignatura($_SESSION['asignatura_id']);
   }

 
    ?>
<!DOCTYPE html>
<html lang="en">

<?php include_once "../template_layout/head.php" ?>

<body class="fix-header fix-sidebar">

    <!-- Main wrapper  -->
    <div id="main-wrapper">
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
          <h1 class="m-0 text-dark">Datos de <?php echo $asignaturaInfoById['nombre'];?></h1>
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
              <h3 class="profile-username text-center"><?php echo $asignaturaInfoById['nombre'];?></h3>
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Nombre</b> <a class="float-right"><?php echo $asignaturaInfoById['nombre'];?></a>
                </li>
                <li class="list-group-item">
                  <strong><i class="fas fa-book mr-1"></i>Descripción</strong>
                  <p class="text-muted">
                  <?php echo $asignaturaInfoById['descripcion'];?>
                </p>

                </li>

              </ul>
            </div>
            <!-- /.card-body -->
          </div>

          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <h3 class="profile-username text-center">Calificaciones</h3>
              <ul class="list-group list-group-unbordered mb-3">

              <?php
                foreach ($calificacionAsignaturaByAlumno as $examen) {
                  echo "<li class='list-group-item'><b>".$examen['fecha']."</b><a class='float-right'>".$examen['nota']."</a>
                  </li>";
              }
               ?>
               <li class='list-group-item'><b>Nota Final</b><b><a class='float-right'><?php echo number_format($notaFinalByAsignatura['AVG(nota)'], 2) ?></a></b></li>
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
                Temario Asignatura

                </h3>
                  <ul class="list-group list-group-unbordered mb-3">
                <?php
       
                foreach ($temarioByAsignatura as $tema) {
                    echo "<li class='list-group-item'><b>".$tema['tnombre']."</b><p>
                    ".$tema['tdescripcion']."
                    </p></li>";
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
    <?php include_once 'template_lay/script.php';
    include_once "../template_layout/footer.php"; ?>
    


</body>

</html>
<?php
}else{
    header('Location:../../index.php');
}?>