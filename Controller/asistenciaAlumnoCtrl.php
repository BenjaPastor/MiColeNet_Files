<?php
session_start();

if (isset($_POST['enviar'])) {

    include_once "../Model/Alumno.php";
    $alumno = new Alumno();
    $alumno->updateAsistenciaAlummo($_POST);
    header('Location:../view/docente/horarioAula.php');

} else {

        header('Location:../index.php');
}
