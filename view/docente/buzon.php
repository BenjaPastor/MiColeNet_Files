<?php
session_start();
if (isset($_SESSION['id'])) {
    include_once "../../url.php";
    include_once "../../Model/Usuario.php";

    include_once "../../Model/Docente.php";
    $docente = new docente();
    $allInfodocente = $docente->allInfodocente($_SESSION['id']);
    $allReadMsgsByDocente = $docente->allReadMsgsByDocente($_SESSION['email']);
    
    $allUnReadMsgsBydocente = $docente->allUnReadMsgsBydocente($_SESSION['email']);

    include_once "../../Model/Alumnos.php";
    $alumnos = new Alumnos();
    $numOfAlumnos = $alumnos->numberOfAlumnos($_SESSION['id']);
    $allAlumnosBydocente = $alumnos->allAlumnosBydocente($_SESSION['id']);
    
    include_once "../../Model/Curso.php";
    $curso = new Curso();
    //$cursoByAlumno = $curso->cursoByAlumno($_SESSION['alumno_id']);
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
          <h1 class="m-0 text-dark">Buzón</h1>
        </div>

      </div>
    </div>
  </div>
  <!-- /.header-contenido -->

  <!-- Contenido Principal -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <?php include('mailboxes.php'); ?>
        <!-- /.col -->
        <div class="col-md-9">
          <!-- Editar Perfil -->
          <div class="card card-primary ">
            <div class="card-header">
              <h3 class="card-title">Bandeja Entrada</h3>
            </div>
  <div class="col-md-12 mt-1">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Nuevos </h3>


      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">

        <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <tbody>
              <tr>
              <th class="title_cell">Asunto</th>
              <th>Remitente</th>
              <th>Respuestas</th>
              <th>Fecha</th>
          </tr>
              <?php
              //Mostramos msgs
              
              foreach($allUnReadMsgsBydocente as $fila)
              {
                $countRespuestasById = $docente->countRespuestasById($fila['id']);

              ?>
                      <tr>
                        <td class="mailbox-subject"><a href="buzon_msg.php?id=<?php echo $fila['id']; ?>"><?php echo htmlentities($fila['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="mailbox-answers"><?php 
                          if ($fila['user1type'] == 'd') {
                            echo $fila['dnombre'] ." ". $fila['dapellido']; 
                          } else {
                            echo $fila['tnombre'] ." ". $fila['tapellido']; 
                          }

                          
                          ?>
                        </td>
                        <td class="mailbox-attachment"><?php echo $countRespuestasById; ?> Respuesta/s</td>
                        <td class="mailbox-date"><?php echo date('Y/m/d H:i:s' ,$fila['timestamp']); ?></td>

                  </tr>
              <?php
              }
              //Check ningun email nuevo
              if(empty($allUnReadMsgsBydocente))
              {
              ?>
                      <tr>
                      <td colspan="4" class="center">No tiene mesajes nuevos.</td>
                  </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
          <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
      </div>
      <!-- /.card-body -->

    </div>
      <!-- /.card -->

      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Leidos</h3>


        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">

          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tr>
              <th class="title_cell">Asunto</th>
              <th>Remitente</th>
              <th>Respuestas</th>
              <th>Fecha</th>
          </tr>
              <tbody>
                <?php
                //Mostramos msgs leidos
               
                foreach($allReadMsgsByDocente as $fila)
                {
                  $countRespuestasById = $docente->countRespuestasById($fila['id']);

                ?>
                        <tr>
                          <td class="mailbox-subject"><a href="buzon_msg.php?id=<?php echo $fila['id']; ?>"><?php echo htmlentities($fila['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                          <td class="mailbox-answers"><?php 
                          if ($fila['user1type'] == 'd') {
                            echo $fila['dnombre'] ." ". $fila['dapellido']; 
                          } else {
                            echo $fila['tnombre'] ." ". $fila['tapellido']; 
                          }
                          
                          
                          
                          
                          ?>
                          </td>
                          <td class="mailbox-attachment"><?php echo $countRespuestasById; ?> Respuesta/s</td>
                          <td class="mailbox-date"><?php echo date('Y/m/d H:i:s' ,$fila['timestamp']); ?></td>

                    </tr>
                <?php
                }
                //SI no hay msg.. notificamos
                if(empty($allReadMsgsByDocente))
                {
                ?>
                        <tr>
                        <td colspan="4" class="center">No tiene mesajes nuevos.</td>
                    </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.card-body -->

      </div>
  </div>



          </div>

      </div>

    </div>
  </section>


<!-- /.content-wrapper -->

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