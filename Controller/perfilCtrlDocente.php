<?php
session_start();

//add new Docente
if (isset($_GET['addDocente'])) {
    if (isset($_FILES["img"]) && !empty($_FILES["img"]["name"])) {

        $target_dir = "../uploads/";
        $img = $target_dir . basename($_FILES["img"]["name"]);

        $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["img"]["tmp_name"], $img);
        $_POST['img'] = $img;
    } else {
        $_POST['img'] = $_POST['img'];

    }
    
    include_once "../Model/Docente.php";
    $docente = new Docente();
    $docente->addDocente($_POST);
    header('Location:../view/docente/allDocentes.php');

} else {

    if (isset($_GET['deleteDocente'])) {
        include_once "../Model/Docente.php";
        $docente = new Docente();
        $docente->delDocente($_GET['deleteDocente']);
        header('Location:../view/docente/allDocentes.php');

    } else {
        //Update Perfil Docente
        if (isset($_POST['enviar'])) {


            if (isset($_FILES['img']) && !empty($_FILES["img"]["name"])) {

                $target_dir = "../uploads/";
                $img = $target_dir . basename($_FILES["img"]["name"]);

                $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                move_uploaded_file($_FILES["img"]["tmp_name"], $img);
                $_POST['img'] = $img;
            } else {
                $_POST['img'] = $_POST['img'];
             
            }

            if (isset($_GET['updateFromDocente'])) {

                
                include_once "../Model/Docente.php";
                $docente = new Docente();
                $docente->updateFromDocente($_POST, $_GET['updateFromDocente']);
                header('Location:../view/docente/allDocentes.php');
                
            } else {
                
            include_once "../Model/Docente.php";
            $tutor = new Docente();
            $tutor->updatePerfil($_POST, $_SESSION['id']);
            header('Location:../view/docente/perfil.php');
        }
        } else {
            header('Location:../index.php');
        }

    }
}
