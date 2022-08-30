<?php

include_once "Dbconnection.php";
include_once "Asignatura.php";

class Tema extends Asignatura
{
    //    info all temas and asignatura
    public function allTemasInfo()
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT t.ID AS tid, t.nombre, t.descripcion, t.asignatura, a.id, a.nombre AS anombre FROM `temaasignatura` AS t, asignatura AS a WHERE t.asignatura = a.id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

        //Update tema
        public function updateFromDocente($post, $tema_id)
        {
            print_r($post);
            $obj = new DbConnection();
            $conn = $obj->dbConnect();
            $sql = "UPDATE `temaasignatura` SET `nombre`=?,`descripcion`=?,`asignatura`=? WHERE `id`=?";
            $prepare = $conn->prepare($sql);
            $prepare->bindParam(1, $post['nombre']);
            $prepare->bindParam(2, $post['descripcion']);
            $prepare->bindParam(3, $post['asignatura']);
            $prepare->bindParam(4, $tema_id);
            $prepare->execute();
        }
        

    //Add TEma
    public function addTemaByDocente($tema_info)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "INSERT INTO `temaasignatura` (`nombre`, `descripcion`, `asignatura`)
                VALUES (?,?,?)";
        $prepared = $conn->prepare($sql);

        $prepared->bindParam(1, $tema_info['nombre']);
        $prepared->bindParam(2, $tema_info['descripcion']);
        $prepared->bindParam(3, $tema_info['asignatura']);
        $prepared->execute();
    }

    // delete tema
    public function delTema($id)
    {
        $db = new DbConnection();
        $conn = $db->dbConnect();
        $query = "DELETE FROM `temaasignatura` WHERE id = ?";

        $statement = $conn->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
    }
    ///////////////////////////////////////

}
