<?php
session_start();

if(isset($_GET['alumno_id'])){

    $_SESSION['alumno_id'] = $_GET['alumno_id'];
    header('Location:../view/tutor/index.php');

} else{
    header('Location:../index.php');
}



?>
