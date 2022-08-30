<?php
session_start();

if (isset($_GET['addAlumno'])) {
    if (isset($_FILES["img"]) && !empty($_FILES["img"]["name"])) {

        $target_dir = "../uploads/";
        $img = $target_dir . basename($_FILES["img"]["name"]);

        $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["img"]["tmp_name"], $img);
        $_POST['img'] = $img;
    } 

    include_once "../Model/Alumnos.php";
    $alumnos = new Alumnos();
    
    try {
       
        $_SESSION['msg']=1;
        $alumnos->addAlumnoByDocente($_POST);
        header('Location:../view/docente/allAlumnos.php');
    } catch (Exception $e) {
        $_SESSION['msg']=2;
        header('Location:../view/docente/allAlumnos.php');
    }
    

} else {
    
    if (isset($_GET['deleteAlumno'])) {
        include_once "../Model/Alumnos.php";
        $alumnos = new Alumnos();
        $alumnos->delAlumno($_GET['deleteAlumno']);
        
        header('Location:../view/docente/alumnos.php');
    
    } else {
        if (isset($_GET['updateFromDocente'])) {

            $_SESSION['perfilAlumno'] = $_GET['updateFromDocente'];
        
            if (isset($_POST['enviar'])) {
        
                if (isset($_FILES["img"]) && !empty($_FILES["img"]["name"])) {
        
                    $target_dir = "../uploads/";
                    $img = $target_dir . basename($_FILES["img"]["name"]);
        
                    $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                    move_uploaded_file($_FILES["img"]["tmp_name"], $img);
                    $_POST['img'] = $img;
                } else {
                    $_POST['img'] = $_POST['img'];
        
                }
        
                include_once "../Model/Alumnos.php";
                $alumnos = new Alumnos();
                $alumnos->updateAlumnoPerfil($_POST, $_SESSION['perfilAlumno']);
                if (isset($_GET['allAlumnos'])) {
                    header('Location:../view/docente/allAlumnos.php');
                } else {
                    header('Location:../view/docente/alumnos.php');
                }
            }
        
        } else {
        
            if (isset($_GET['perfilAlumno'])) {
        
                $_SESSION['perfilAlumno'] = $_GET['perfilAlumno'];
                header('Location:../view/tutor/perfilAlumno.php');
        
            } else {
        
                if (isset($_GET['notasAlumno']) && isset($_POST['enviar'])) {
        
                    $_SESSION['notasAlumno'] = $_GET['notasAlumno'];
        
                    include_once "../Model/Alumnos.php";
                    $alumnos = new Alumnos();
                    try {
                        $alumnos->addNotaAlumno($_POST, $_SESSION['notasAlumno']);
                        header('Location:../view/docente/notasAlumno.php');
                    } catch (Exception $e) {
                        $_SESSION['msg']=2;
                        header('Location:../view/docente/notasAlumno.php');
                    }

              
        
                } else {
                    if (isset($_GET['notasAlumno'])) {
                        $_SESSION['notasAlumno'] = $_GET['notasAlumno'];
                        header('Location:../view/docente/notasAlumno.php');
                    } else {
        
                        if (isset($_GET['horarioAlumno'])) {
        
                            $_SESSION['horarioAlumno'] = $_GET['horarioAlumno'];
                            header('Location:../view/docente/horarioAlumno.php');
        
                        } else {
        
                            //Update Horario Almno
                            if (isset($_POST['enviar']) && isset($_SESSION['horarioAlumno'])) {
        
                                include_once "../Model/Alumnos.php";
                                $alumnos = new Alumnos();
                                $alumnos2 = new Alumnos();
                                try {
       
                                    $_SESSION['msg']=1;
                                    $alumnos2->aulaIdByTemario($_POST['sel_tema']); //get aula ID
                                    $aula_id = json_decode(json_encode($alumnos2->aulaIdByTemario($_POST['sel_tema'])), true);
                                // print_r($aula_id['aid']);
        
                                $alumnos->addAlumnoHorario($_POST, $aula_id['aid']); //add horario to alumno
                                header('Location:../view/docente/horarioAlumno.php');
                                } catch (Exception $e) {
                                    $_SESSION['msg']=2;
                                    header('Location:../view/docente/horarioAlumno.php');
                                }

                                
        
                            } else {
                                //Update Alumno
                                if (isset($_POST['enviar']) && $_POST['enviar'] == 'updateAlumnoFromTutor') {
        
                                    if (isset($_FILES["img"]) && !empty($_FILES["img"]["name"])) {
        
                                        $target_dir = "../uploads/";
                                        $img = $target_dir . basename($_FILES["img"]["name"]);
        
                                        $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                                        move_uploaded_file($_FILES["img"]["tmp_name"], $img);
                                        $_POST['img'] = $img;
                                    } else {
                                        $_POST['img'] = $_POST['img'];
        
                                    }
                                    include_once "../Model/Alumnos.php";
                                    $alumnos = new Alumnos();
                                    $alumnos->updateAlumnoPerfil($_POST, $_SESSION['perfilAlumno']);
        
                                    header('Location:../view/tutor/perfilAlumno.php');
        
                                } else {
                                    if (isset($_GET['delNotaAsignatura'])) {
                                        include_once "../Model/Alumnos.php";
                                        $alumnos = new Alumnos();
                                        $alumnos->delNotaAsignatura($_GET['alumno_id'], $_GET['delNotaAsignatura'], $_GET['fecha']);
                                        header('Location:../view/docente/notasAlumno.php');
        
                                    } else {
                                       // header('Location:../index.php');
                                    }
                                }
                            }
                        }
                    }
                }
            }
    }
}




}
