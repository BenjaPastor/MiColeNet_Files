<?php
$sel_tema = $_POST['sel_tema'];   // tema id
echo $sel_tema;
include_once "../../Model/Dbconnection.php";
$obj = new DbConnection();
$conn = $obj->dbConnect();

$sql = "SELECT id, nombre FROM aula WHERE id=".$sel_tema;
$prepare = $conn->prepare($sql);
$prepare->execute();
$temas_select = $prepare->fetchAll(PDO::FETCH_ASSOC);

$temas_arr = array();


foreach ($temas_select as $tema) {
    $temas_arr[] = array("id" => $tema['id'], "nombre" => $tema['nombre']);  

}


// encoding array to json format
echo json_encode($temas_arr);

?>