<?php

include_once "Dbconnection.php";
include_once "Curso.php";

class Asignatura extends Curso
{

    //    count all asignatura by alumno
    public function numberOfAsignaturas($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT COUNT(asignatura.id) as numberOfAsignatura FROM `asignatura`, `curso`, `alumno` WHERE alumno.curso = curso.id AND asignatura.curso = curso.id AND alumno.id = $id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    //  all Asignaturas by Alumno
    public function allAsignaturasByAlumno($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT asignatura.nombre, asignatura.id, asignatura.descripcion FROM `asignatura`, `curso`, `alumno` WHERE alumno.curso = curso.id AND asignatura.curso = curso.id AND alumno.id = $id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //  info asignatura by Id
    public function asignaturaInfoById($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT * FROM `asignatura` WHERE asignatura.id = $id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //  all temario by asignatura id
    public function temarioByAsignatura($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT t.nombre AS tnombre, t.descripcion AS tdescripcion FROM temaasignatura AS t WHERE t.asignatura = $id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //Area Docente

    //    count all asignatura by Id Curso
    public function numberOfAsignaturasByCursoId($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT COUNT(asignatura.id) as numberOfAsignatura FROM `asignatura`, `curso` WHERE curso.id = $id AND asignatura.curso = curso.id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    //     all  info asignatura by Id Curso
    public function allInfoOfAsignaturasByCursoId($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT asignatura.nombre, asignatura.id, asignatura.descripcion FROM `asignatura`, `curso` WHERE curso.id = $id AND asignatura.curso = $id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //    count all asignatura by alumno
    public function numberOfAsignaturasByDocente($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT COUNT(asignatura.id) as numberOfAsignatura FROM `asignatura`, `curso`, `docente` WHERE docente.id = curso.docente_tutor  AND asignatura.curso = curso.id AND docente.id = $id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    //   all info from asignatura by alumno
    public function allInfoOfAsignaturasByDocente($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT asignatura.id, asignatura.nombre FROM  `asignatura`, `curso`, `docente` WHERE docente.id = curso.docente_tutor  AND asignatura.curso = curso.id AND docente.id = $id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //    select all info asignatura and Curso
    public function allAsignaturasInfo()
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "SELECT a.id, a.nombre, a.descripcion, a.curso, c.nombre AS cnombre, c.ciclo AS cciclo FROM asignatura AS a, curso AS c WHERE a.curso = c.id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //Add Alumno
    public function addAsignaturaByDocente($asignatura_info)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "INSERT INTO `asignatura` (`nombre`, `descripcion`, `curso`)
              VALUES (?,?,?)";
        $prepared = $conn->prepare($sql);

        $prepared->bindParam(1, $asignatura_info['nombre']);
        $prepared->bindParam(2, $asignatura_info['descripcion']);
        $prepared->bindParam(3, $asignatura_info['curso']);
        $prepared->execute();
    }

    //Update asignatura
    public function updateFromDocente($post, $asignatura_id)
    {
        print_r($post);
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "UPDATE `asignatura` SET `nombre`=?,`descripcion`=?,`curso`=? WHERE `id`=?";
        $prepare = $conn->prepare($sql);
        $prepare->bindParam(1, $post['nombre']);
        $prepare->bindParam(2, $post['descripcion']);
        $prepare->bindParam(3, $post['curso']);
        $prepare->bindParam(4, $asignatura_id);
        $prepare->execute();
    }
    
        // delete asignatura
        public function delAsignatura($id)
        {
            $db = new DbConnection();
            $conn = $db->dbConnect();
            $query = "DELETE FROM `asignatura` WHERE id = ?";
    
            $statement = $conn->prepare($query);
            $statement->bindParam(1, $id);
            $statement->execute();
        }

    ///////////////////////////////////////

}
