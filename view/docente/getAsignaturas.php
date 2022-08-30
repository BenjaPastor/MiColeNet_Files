<?php
$cursoid = $_POST['curso'];   // department id

include_once "../../Model/Dbconnection.php";
$obj = new DbConnection();
$conn = $obj->dbConnect();

$sql = "SELECT id, nombre FROM asignatura WHERE curso=".$cursoid;
$prepare = $conn->prepare($sql);
$prepare->execute();
$asignaturas_select = $prepare->fetchAll(PDO::FETCH_ASSOC);

$asignaturas_arr = array();


foreach ($asignaturas_select as $asignatura) {
    $asignaturas_arr[] = array("id" => $asignatura['id'], "nombre" => $asignatura['nombre']);   
}


// encoding array to json format
echo json_encode($asignaturas_arr);

?>