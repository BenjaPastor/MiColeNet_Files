<?php
include_once "Dbconnection.php";

class Login
{
    
    //tutor Login
    public function tutorlogin($email,$pass){
       
        $obj=new DbConnection();
        $conn=$obj->dbConnect();

        $sql="SELECT * FROM `tutor` WHERE `email`=? AND `contrasenya`=?";
        $prepared=$conn->prepare($sql);
        $prepared->bindParam(1,$email);
        $prepared->bindParam(2,$pass);
        $prepared->execute();
        $result=$prepared->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    //docente Login
    public function docentelogin($email,$pass){
       
        $obj=new DbConnection();
        $conn=$obj->dbConnect();

        $sql="SELECT * FROM `docente` WHERE `email`=? AND `contrasenya`=?";
        $prepared=$conn->prepare($sql);
        $prepared->bindParam(1,$email);
        $prepared->bindParam(2,$pass);
        $prepared->execute();
        $result=$prepared->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    
}
