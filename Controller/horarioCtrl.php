<?php
session_start();
if (isset($_GET['aula_id'])) {
    $_SESSION['aula_id'] = $_GET['aula_id'];
    header('Location:../view/docente/horarioAula.php');

} else {
    header('Location:../index.php');
}
