<?php
session_start();
if (isset($_GET['delAula'])) {
    include_once "../Model/Aula.php";
    $aula = new Aula();
    $aula->delAula($_GET['delAula']);
    header('Location:../view/docente/allAulas.php');

} else {
    if (isset($_GET['addAula'])) {
        include_once "../Model/Aula.php";
        $aula = new Aula();
        $aula->addAula($_POST);
        header('Location:../view/docente/allAulas.php');

    } else {
        if (isset($_GET['updateAula'])) {
            include_once "../Model/Aula.php";
            $aula = new Aula();
            $aula->updateAula($_POST, $_GET['updateAula']);
            header('Location:../view/docente/allAulas.php');

        } else {
            if (isset($_POST['enviar'])) {

                include_once "../Model/Aula.php";
                $aula = new Aula();
                try {
       
                    $_SESSION['msg']=1;
                    $aula->addHorarioAAula($_POST);
                    header('Location:../view/docente/horarioAula.php');
                } catch (Exception $e) {
                    $_SESSION['msg']=2;
                    header('Location:../view/docente/horarioAula.php');
                }

               

            } else {
                if (isset($_GET['aula_id'])) {
                    $_SESSION['aula_id'] = $_GET['aula_id'];
                    header('Location:../view/docente/allAulas.php');

                } else {

                    header('Location:../index.php');
                }
            }
        }
    }
}
