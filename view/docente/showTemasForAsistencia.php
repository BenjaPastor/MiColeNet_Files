<?php
//var_dump($_POST);
$idalumno = $_POST['idalumno'];   
$fecha = $_POST['fecha_asistencia']; //date conversion

include_once "../../Model/Dbconnection.php";
$obj = new DbConnection();
$conn = $obj->dbConnect();

$query = "SELECT
ta.ID as tid,
ta.nombre AS tanombre,
i.fecha AS ifecha,
i.hora AS ihora,
i.hora_fin AS ihora_fin, 
alas.asistencia AS alasasistencia, 
alas.IDALUMNO as alasIDALUMNO, 
alas.IDAULA as alasIDAULA
FROM
temaasignatura AS ta,
alumnoasisitetemaaula AS alas,
impartirtemaaula AS i
WHERE
ta.ID = i.IDTEMA AND
alas.IDTEMA = ta.ID AND
alas.IDALUMNO = ? AND
i.fecha = ?
";
$statement = $conn->prepare($query);
$statement->bindParam(1, $idalumno);
$statement->bindParam(2, $fecha);

$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode($result);
print_r($result);

?>