<?php

include_once "Dbconnection.php";

class Curso
{

    //    select Curso por Alumno
    public function cursoByAlumno($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "SELECT c.nombre, c.ciclo, c.id, c.descripcion FROM curso AS c, alumno AS a WHERE a.id = $id AND a.curso = c.id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //    select all cursos
    public function allCursosInfo()
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "SELECT * FROM curso AS c";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //    select all cursos and tutor
    public function allCursosInfoAndTutor()
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "SELECT c.id, c.nombre, c.ciclo, c.descripcion, c.docente_tutor, d.nombre AS dnombre, d.apellido AS dapellido FROM curso AS c, docente AS d WHERE c.docente_tutor = d.id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //Docente

    // select cursos by docente

    public function cursosByDocente($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "SELECT c.nombre, c.ciclo, c.id, c.descripcion FROM curso AS c, docente  WHERE docente.id = $id AND c.docente_tutor = docente.id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //    select Curso por ID
    public function cursoById($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "SELECT c.nombre, c.ciclo, c.id, c.descripcion FROM curso AS c WHERE c.id = $id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //Add Curso
    public function addCurso($curso_info)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "INSERT INTO `curso`
              (`nombre`, `ciclo`, `descripcion`, `docente_tutor`)
              VALUES (?,?,?,?)";
        $prepared = $conn->prepare($sql);
        $prepared->bindParam(1, $curso_info['nombre']);
        $prepared->bindParam(2, $curso_info['ciclo']);
        $prepared->bindParam(3, $curso_info['descripcion']);
        $prepared->bindParam(4, $curso_info['docente_tutor']);
        $prepared->execute();
    }

    //Update curso
    public function updateFromDocente($post, $curso_id)
    {
        print_r($post);
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "UPDATE `curso` SET `nombre`=?,`ciclo`=?,`descripcion`=?,`docente_tutor`=? WHERE `id`=?";
        $prepare = $conn->prepare($sql);
        $prepare->bindParam(1, $post['nombre']);
        $prepare->bindParam(2, $post['ciclo']);
        $prepare->bindParam(3, $post['descripcion']);
        $prepare->bindParam(4, $post['docente_tutor']);
        $prepare->bindParam(5, $curso_id);
        $prepare->execute();
    }

    
        // delete curso
        public function delCurso($id)
        {
            $db = new DbConnection();
            $conn = $db->dbConnect();
            $query = "DELETE FROM `curso` WHERE id = ?";
    
            $statement = $conn->prepare($query);
            $statement->bindParam(1, $id);
            $statement->execute();
        }

    ///////////////////////////////////////

}
