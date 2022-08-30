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
    $numOfAlumnos = $alumnos->numberOfAlumnos($_SESSION['id']);
    $allAlumnosBydocente = $alumnos->allAlumnosBydocente($_SESSION['id']);
    
    include_once "../../Model/Curso.php";
    $curso = new Curso();
    $cursoById = $curso->cursoById($_SESSION['curso_id']);
    
    include_once "../../Model/Asignatura.php";
    $asignatura = new Asignatura();
    $numberOfAsignaturasByCursoId = $asignatura->numberOfAsignaturasByCursoId($_SESSION['curso_id']);
    $allInfoOfAsignaturasByCursoId = $asignatura->allInfoOfAsignaturasByCursoId($_SESSION['curso_id']);
 
  

 
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
          <h1 class="m-0 text-dark">Datos de <?php echo $cursoById['nombre']." de ".$cursoById['ciclo']?></h1>
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
                            <a href="/view/docente/allCursos.php" class="btn btn-primary btn-block mb-3" role="button">Gestionar Todos los Cursos</a>
                        <?php }?>

          <div class="card card-primary card-outline">
            <div class="card-body box-profile">


              <h3 class="profile-username text-center"><?php echo $cursoById['nombre']?></h3>



              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Curso</b> <a class="float-right"><?php echo $cursoById['nombre']?></a>

                </li>
                <li class="list-group-item">
                  <b>Ciclo</b> <a class="float-right"><?php echo $cursoById['ciclo']?></a>

                </li>
                <li class="list-group-item">
                  <strong><i class="fas fa-book mr-1"></i>Descripción</strong>
                  <p class="text-muted">
                  <?php echo $cursoById['descripcion']?>
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
                echo $numberOfAsignaturasByCursoId; ?>
                </h3>
                  <ul class="list-group list-group-unbordered mb-3">
                <?php
               
               
                foreach ($allInfoOfAsignaturasByCursoId as $asignatura) {
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