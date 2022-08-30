<?php
$idaula = $_POST['idaula'];   //
$idtema = $_POST['idtema'];   //
$fecha = date("Y-m-d", $_POST['fecha']); //date conversion

include_once "../../Model/Dbconnection.php";
$obj = new DbConnection();
$conn = $obj->dbConnect();

$query = "DELETE FROM `impartirtemaaula` WHERE IDAULA = ? AND IDTEMA = ? AND fecha = ?";
$statement = $conn->prepare($query);
$statement->bindParam(1, $idaula);
$statement->bindParam(2, $idtema);
$statement->bindParam(3, $fecha);
$statement->execute();
?>