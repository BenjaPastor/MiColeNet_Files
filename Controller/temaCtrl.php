<?php
session_start();

if (isset($_GET['tema_id'])) {

    $_SESSION['tema_id'] = $_GET['tema_id'];
    header('Location:../view/tutor/allTema.php');
} else {
    if (isset($_GET['addTema'])) {

        include_once "../Model/Tema.php";
        $tema = new Tema();

        $tema->addTemaByDocente($_POST);
        header('Location:../view/docente/allTemas.php');

    } else {
        if (isset($_GET['deleteTema'])) {
            include_once "../Model/Tema.php";
            $tema = new Tema();
            $tema->delTema($_GET['deleteTema']);
            header('Location:../view/docente/allTemas.php');

        } else {
            if (isset($_GET['updateFromDocente'])) {
                include_once "../Model/Tema.php";
                $tema = new Tema();
                $tema->updateFromDocente($_POST, $_GET['updateFromDocente']);
                header('Location:../view/docente/allTemas.php');

            } else {
                header('Location:../index.php');
            }
        }
    }
}
