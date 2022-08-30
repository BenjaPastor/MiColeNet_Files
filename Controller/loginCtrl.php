<?php
session_start();
include_once "../Model/Login.php";
$obj=new Login();

if(isset($_POST['email'],$_POST['pass'])){
    $password=md5($_POST['pass']);

    $tutordatamatch=$obj->tutorlogin($_POST['email'],$password); //tutor
    
    $docentedatamatch=$obj->docentelogin($_POST['email'],$password); //docente
 
 if ($_POST['role']=='Tutor'){
        if ($tutordatamatch!=null){
            //Tutor login Data
            $_SESSION['id']=$tutordatamatch['id'];
            $_SESSION['email']=$tutordatamatch['email'];
            $_SESSION['nombre']=$tutordatamatch['nombre'];
        header('Location:../view/tutor/index.php');
        }
        else{
    

            header('Location:../index.php');
        }
    }
    elseif ($_POST['role']=='Docente'){
        if ($docentedatamatch!=null){
            //docente login Data
            $_SESSION['id']=$docentedatamatch['id'];
            $_SESSION['nombre']=$docentedatamatch['name'];
            $_SESSION['email']=$docentedatamatch['email'];
            header('Location:../view/docente/index.php');
        }
        else{
            
            header('Location:../index.php');
        }
    }
    
}

?>
