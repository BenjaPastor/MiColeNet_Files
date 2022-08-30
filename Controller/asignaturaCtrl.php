<?php
session_start();

if (isset($_GET['asignatura_id'])) {

    $_SESSION['asignatura_id'] = $_GET['asignatura_id'];
    header('Location:../view/tutor/asignatura.php');

} else {
    if (isset($_GET['asignatura_id_from_docente'])) {

        $_SESSION['asignatura_id'] = $_GET['asignatura_id_from_docente'];
        header('Location:../view/docente/asignatura.php');

    } else {
        if (isset($_GET['addAsignatura'])) {

            include_once "../Model/Asignatura.php";
            $asignatura = new Asignatura();

            $asignatura->addAsignaturaByDocente($_POST);
            header('Location:../view/docente/allAsignaturas.php');

        } else {
            if (isset($_GET['updateFromDocente'])) {
                include_once "../Model/Asignatura.php";
                $asignatura = new Asignatura();
                $asignatura->updateFromDocente($_POST, $_GET['updateFromDocente']);
                header('Location:../view/docente/allAsignaturas.php');

            } else {
                if (isset($_GET['deleteAsignatura'])) {
                    include_once "../Model/Asignatura.php";
                    $asignatura = new Asignatura();
                    $asignatura->delAsignatura($_GET['deleteAsignatura']);
                    header('Location:../view/docente/allAsignaturas.php');

                } else {
                    header('Location:../index.php');
                }
            }
        }
    }}
