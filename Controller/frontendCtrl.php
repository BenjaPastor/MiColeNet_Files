<?php
session_start();
if (isset($_GET['option']) && $_GET['option'] == 'identidad') { //identidad

    header('Location:../view/docente/frontendIdentidad.php');
} else {

    if (isset($_GET['option']) && $_GET['option'] == 'menu') { //menu

        header('Location:../view/docente/frontendMenu.php');
    } else {
        if (isset($_GET['option']) && $_GET['option'] == 'slider') { //slider

            header('Location:../view/docente/frontendSlider.php');
        } else {

            if (isset($_GET['option']) && $_GET['option'] == 'contenido') { //contenido

                header('Location:../view/docente/frontendContenido.php');

            } else {

                if (isset($_GET['updateIdentidad'])) {

                    if (isset($_FILES["logo"]) && !empty($_FILES["logo"]["name"])) {
                        var_dump($_FILES);
                        $target_dir = "../uploads/";
                        $img = $target_dir . basename($_FILES["logo"]["name"]);

                        $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                        move_uploaded_file($_FILES["logo"]["tmp_name"], $img);
                        $_POST['logo'] = $img;
                    } else {

                        $_POST['logo'] = $_POST['logo'];

                    }

                    if (isset($_FILES["favicon"]) && !empty($_FILES["favicon"]["name"])) {

                        $target_dir = "../";
                        $img = $target_dir . 'favicon.ico';

                        $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                        move_uploaded_file($_FILES["favicon"]["tmp_name"], $img);
                        $_POST['favicon'] = $img;
                    } else {

                        $_POST['favicon'] = $_POST['favicon'];

                    }

                    include_once "../Model/FrontEnd.php";
                    $frontend = new FrontEnd();
                    $frontend->updateIdentidad($_POST);
                    header('Location:../view/docente/frontendIdentidad.php');
                } else {
                    if (isset($_GET['updateMenu'])) {

                        include_once "../Model/FrontEnd.php";
                        $frontend = new FrontEnd();
                        $frontend->updateMenu($_POST);
                        header('Location:../view/docente/frontendMenu.php');
                    } else {
                        if (isset($_GET['updateSeccion'])) {
                            $seccion = $_GET['updateSeccion'];

                            if ($seccion == '3' || $seccion == '4') { // Imagenes Dirección or Seccion3
                                if (isset($_FILES["img1"]) && !empty($_FILES["img1"]["name"])) {
                                    
                                    $target_dir = "../uploads/";
                                    $img = $target_dir . basename($_FILES["img1"]["name"]);

                                    $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                                    move_uploaded_file($_FILES["img1"]["tmp_name"], $img);
                                    $_POST['img1'] = $img;
                                } else {

                                    $_POST['img1'] = $_POST['img1'];

                                }
                                if (isset($_FILES["img2"]) && !empty($_FILES["img2"]["name"])) {
                                    $target_dir = "../uploads/";
                                    $img = $target_dir . basename($_FILES["img2"]["name"]);

                                    $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                                    move_uploaded_file($_FILES["img2"]["tmp_name"], $img);
                                    $_POST['img2'] = $img;
                                } else {

                                    $_POST['img2'] = $_POST['img2'];

                                }
                                if (isset($_FILES["img3"]) && !empty($_FILES["img3"]["name"])) {
                                    $target_dir = "../uploads/";
                                    $img = $target_dir . basename($_FILES["img3"]["name"]);

                                    $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                                    move_uploaded_file($_FILES["img3"]["tmp_name"], $img);
                                    $_POST['img3'] = $img;
                                } else {

                                    $_POST['img3'] = $_POST['img3'];

                                }
                            }

                            include_once "../Model/FrontEnd.php";
                            $frontend = new FrontEnd();
                            $frontend->updateSeccion($_POST, $seccion);
                             header('Location:../view/docente/frontendContenido.php');
                        } else {

                            if (isset($_GET['updateSlider'])) {

                                if (isset($_FILES["img"]) && !empty($_FILES["img"]["name"])) {
                                   // var_dump($_FILES);
                                    $target_dir = "../uploads/";
                                    $img = $target_dir . basename($_FILES["img"]["name"]);

                                    $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                                    move_uploaded_file($_FILES["img"]["tmp_name"], $img);
                                    $_POST['img'] = $img;
                                } else {

                                    $_POST['img'] = $_POST['img'];

                                }
                                include_once "../Model/FrontEnd.php";
                                $frontend = new FrontEnd();
                                $frontend->updateSlider($_POST);
                               header('Location:../view/docente/frontendSlider.php');
                            } else {

                                header('Location:../index.php');
                            }
                        }
                    }
                }
            }
        }
    }
}
