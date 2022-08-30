<?php
session_start();

    //Update Perfil
    if (isset($_POST['enviar'])) {
     
        if (isset($_FILES['img']) && !empty($_FILES["img"]["name"])) {
         
            $target_dir = "../uploads/";
            $img = $target_dir . basename($_FILES["img"]["name"]);

            $imageFileType = strtolower(pathinfo($img,PATHINFO_EXTENSION));
            move_uploaded_file($_FILES["img"]["tmp_name"],$img);
            $_POST['img'] = $img;
        } else {
            $_POST['img'] = $_POST['img'];
         
        }
        include_once "../Model/Tutor.php";
        $tutor=new Tutor();
        $tutor->updatePerfil($_POST, $_SESSION['id']);

        header('Location:../view/tutor/perfil.php');


    } else {
    header('Location:../index.php');
    }





?>
