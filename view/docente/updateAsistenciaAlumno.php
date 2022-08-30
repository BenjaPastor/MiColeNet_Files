<?php
$asistencia = $_POST['asistencia'];   
$alumno = $_POST['idalumno'];   
$aula = $_POST['idaula'];   
$tema = $_POST['idtema'];   


include_once "../../Model/Dbconnection.php";
$obj = new DbConnection();
$conn = $obj->dbConnect();

$sql = "UPDATE `alumnoasisitetemaaula` SET `asistencia`=? WHERE `IDALUMNO`=? AND IDAULA=? AND IDTEMA =?";
$prepare = $conn->prepare($sql);
$prepare->bindParam(1, $asistencia);
$prepare->bindParam(2, $alumno);
$prepare->bindParam(3, $aula);
$prepare->bindParam(4, $tema);
$prepare->execute();

?>