<?php

include_once "Dbconnection.php";

class Aula
{
    //    info all aulas
    public function allInfoAulas()
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT * FROM `aula`";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    //    numberOfAulas
    public function numberOfAulas()
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT COUNT(aula.id) AS numberOfAulas FROM `aula`";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    //    info all aula by id
    public function allInfoAula($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT * FROM `aula` WHERE aula.id = $id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //Add Tema a Aula
    public function addHorarioAAula($info_aula_tema)
    {

        print_r($_POST);
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "INSERT INTO `impartirtemaaula`
              (`IDAULA`, `IDTEMA`, `IDDOCENTE`, `fecha`, `hora`, `hora_fin`)
              VALUES (?,?,?,?,?,?)";
        $prepared = $conn->prepare($sql);

        $prepared->bindParam(1, $_SESSION['aula_id']);
        $prepared->bindParam(2, $info_aula_tema['sel_tema']);
        $prepared->bindParam(3, $info_aula_tema['sel_docente']);
        $prepared->bindParam(4, $info_aula_tema['fecha']);
        $prepared->bindParam(5, $info_aula_tema['timepickerTema']);
        $prepared->bindParam(6, $info_aula_tema['timepickerTema2']);
        $prepared->execute();
        return $result;
    }

    //Add Aula
    public function addAula($aula_info)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "INSERT INTO `aula`
                  (`nombre`, `centro`)
                  VALUES (?,'1')";
        $prepared = $conn->prepare($sql);
        $prepared->bindParam(1, $aula_info['nombre']);
        $prepared->execute();
    }

    //Update aula

    public function updateAula($post, $aula_id)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "UPDATE `aula` SET `nombre`=?,`centro`='1' WHERE `id`=?";
        $prepare = $conn->prepare($sql);
        $prepare->bindParam(1, $post['nombre']);
        $prepare->bindParam(2, $aula_id);
        $prepare->execute();
    }

        // delete aula
        public function delAula($id)
        {
            $db = new DbConnection();
            $conn = $db->dbConnect();
            $query = "DELETE FROM `aula` WHERE id = ?";
    
            $statement = $conn->prepare($query);
            $statement->bindParam(1, $id);
            $statement->execute();
        }

}
