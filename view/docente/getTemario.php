<?php
$asignaturaid = $_POST['asignatura'];   // asignatura id

include_once "../../Model/Dbconnection.php";
$obj = new DbConnection();
$conn = $obj->dbConnect();

$sql = "SELECT ID, nombre FROM temaasignatura WHERE asignatura=".$asignaturaid;
$prepare = $conn->prepare($sql);
$prepare->execute();
$temas_select = $prepare->fetchAll(PDO::FETCH_ASSOC);

$temas_arr = array();


foreach ($temas_select as $tema) {
    $temas_arr[] = array("id" => $tema['ID'], "nombre" => $tema['nombre']);   
}


// encoding array to json format
echo json_encode($temas_arr);

?>