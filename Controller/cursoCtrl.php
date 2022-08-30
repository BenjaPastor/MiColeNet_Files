<?php
session_start();
//add new Docente
if (isset($_GET['addCurso'])) {

    include_once "../Model/Curso.php";
    $curso = new Curso();
    $curso->addCurso($_POST);
    header('Location:../view/docente/allCursos.php');

} else {
    if (isset($_GET['deleteCurso'])) {
        include_once "../Model/Curso.php";
        $curso = new Curso();
        $curso->delCurso($_GET['deleteCurso']);
        header('Location:../view/docente/allCursos.php');

    } else {
    if (isset($_GET['curso_id'])) {

        $_SESSION['curso_id'] = $_GET['curso_id'];
        header('Location:../view/docente/curso.php');

    } else {
        if (isset($_GET['updateFromDocente'])) {
            include_once "../Model/Curso.php";
            $curso = new Curso();
            $curso->updateFromDocente($_POST, $_GET['updateFromDocente']);
            header('Location:../view/docente/allCursos.php');

        } else {
            header('Location:../index.php');
        }

    }
}
}