<?php

if (!isset($_SESSION)) session_start();

$objnot= new Tutor();
$allUnReadMsgsByTutor=$objnot->allUnReadMsgsByTutor($_SESSION['email']);
$unReadMsg = sizeof($allUnReadMsgsByTutor);

?>

<div class="wrapper">
     <!-- Btn IconMenu + breadcrumb -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

<ul class="navbar-nav">

  <li class="nav-item d-none d-sm-inline-block">
    <a href="/view/tutor/index.php" class="nav-link">Inicio</a>
  </li>

</ul>


<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
<!-- Cambiar Alumno links -->
<li class="nav-item ">
    <a class="nav-link"  href="/view/tutor/index.php?changeAlumno=1">
    <button type="button" class="btn btn-danger btn-xs">
				Cambiar Alumno
			</button>
    </a>
    
  </li>
  <!-- Msgs no leidos -->
  <li class="nav-item ">
    <a class="nav-link"  href="/view/tutor/buzon.php">
      <i class="far fa-comments"></i>
      <span class="badge badge-danger navbar-badge"><?php echo $unReadMsg; ?></span>
    </a>
    
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/Controller/logout.php">
      <i class="fas fa-power-off"></i>
    </a>
  </li>
</ul>
</nav>
<!-- /.navbar -->

