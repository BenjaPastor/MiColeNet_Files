<?php
$idalumno = $_POST['idalumno']; 
$idaula = $_POST['idaula'];   //
$idtema = $_POST['idtema'];   //


include_once "../../Model/Dbconnection.php";
$obj = new DbConnection();
$conn = $obj->dbConnect();

$query = "DELETE FROM `alumnoasisitetemaaula` WHERE IDALUMNO = ? AND IDAULA = ? AND IDTEMA = ?";
$statement = $conn->prepare($query);
$statement->bindParam(1, $idalumno);
$statement->bindParam(2, $idaula);
$statement->bindParam(3, $idtema);
$statement->execute();
?>