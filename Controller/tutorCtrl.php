<?php
session_start();
//add new Docente
if (isset($_GET['addTutor'])) {

    if (isset($_FILES['img']) && !empty($_FILES["img"]["name"])) {

        $target_dir = "../uploads/";
        $img = $target_dir . basename($_FILES["img"]["name"]);

        $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["img"]["tmp_name"], $img);
        $_POST['img'] = $img;
    } else {
        $_POST['img'] = $_POST['img'];
        
    }
    include_once "../Model/Tutor.php";
    $tutor = new Tutor();
    try {
       
        $_SESSION['msg']=1;
        $tutor->addTutor($_POST);
        header('Location:../view/docente/allTutores.php');
    } catch (Exception $e) {
        $_SESSION['msg']=2;
        print_r($e);
        //header('Location:../view/docente/allTutores.php');
    }
  

} else {
    if (isset($_GET['delTutor'])) {
        include_once "../Model/Tutor.php";
        $tutor = new Tutor();
        $tutor->delTutor($_GET['delTutor']);
        header('Location:../view/docente/allTutores.php');

    } else {
    if (isset($_GET['tutor_id'])) {

        $_SESSION['tutor_id'] = $_GET['tutor_id'];
        header('Location:../view/docente/tutor.php');

    } else {
        if (isset($_GET['updateTutor'])) {
           
            if (isset($_FILES['img']) && !empty($_FILES["img"]["name"])) {

                $target_dir = "../uploads/";
                $img = $target_dir . basename($_FILES["img"]["name"]);
        
                $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                move_uploaded_file($_FILES["img"]["tmp_name"], $img);
                $_POST['img'] = $img;
            } 
            include_once "../Model/Tutor.php";
            $tutor = new Tutor();
            $tutor->updateTutor($_POST, $_GET['updateTutor']);
           header('Location:../view/docente/allTutores.php');

        } else {
            header('Location:../index.php');
        }

    }
}
}