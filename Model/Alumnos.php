<?php
include_once "Usuario.php";
include_once "Dbconnection.php";

class Alumnos extends Usuario
{

    //    all info  alumnos
    public function allAlumnos()
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT * FROM `alumno`";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //    count all alumnos by tutor
    public function numberOfAlumnos($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT COUNT(alumno.id) as numberOfAlumnos FROM `alumno`, `tutor` WHERE tutor.id='" . $id . "' AND (tutor.id = alumno.tutor1 OR tutor.id = alumno.tutor2)";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    //  all alumnos by tutor legal
    public function allAlumnosByTutor($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT alumno.id, alumno.NIF, alumno.nombre, alumno.apellido, alumno.apellido2, alumno.fecha_nacimiento, alumno.img, alumno.tutor1, alumno.tutor2, alumno.curso FROM `alumno`, `tutor` WHERE tutor.id='" . $id . "' AND (tutor.id = alumno.tutor1 OR tutor.id = alumno.tutor2)";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //  choosen alumno by tutor
    public function choosenAlumno($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT * FROM `alumno` WHERE id='" . $id . "'";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //  all tutores (padre, madres..) by alumno
    public function allTutoresByAlumno($alumno_id)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "SELECT t.nombre, t.apellido, t.apellido2 FROM `tutor` AS t, `alumno` WHERE (alumno.tutor1 = t.id OR alumno.tutor2 = t.id ) AND alumno.id='" . $alumno_id . "'";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //  calificaciones alumno by id asignatura
    public function calificacionAsignaturaByAlumno($asignatura_id, $alumno_id)
    {
      
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "SELECT * FROM examen WHERE IDALUMNO = $alumno_id AND IDASIGNATURA = $asignatura_id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //  nota Final By Asignatura id
    public function notaFinalByAsignatura($asignatura_id, $alumno_id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "SELECT AVG(nota) FROM examen WHERE IDASIGNATURA = $asignatura_id AND IDALUMNO = $alumno_id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //  nota Final By Asignatura id and Alumno id
    public function notaFinalByAsignaturaAndAlumnoId($asignatura_id, $alumno_id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "SELECT AVG(nota) FROM examen WHERE IDASIGNATURA = $asignatura_id AND IDALUMNO = $alumno_id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //Update perfil alumno
    public function updateAlumnoPerfil($post, $alumno_id)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "UPDATE `alumno` SET `img`=?, `nombre`=?,`apellido`=?,`apellido2`=?,`fecha_nacimiento`=?, `tutor1`=?,`tutor2`=?, `curso`=? WHERE `id`=?";
        $prepare = $conn->prepare($sql);
       
        $prepare->bindParam(1, $post['img']);
        $prepare->bindParam(2, $post['nombre']);
        $prepare->bindParam(3, $post['apellido']);
        $prepare->bindParam(4, $post['apellido2']);
        $prepare->bindParam(5, $post['fecha_nacimiento']);
        $prepare->bindParam(6, $post['tutor1']);
        $prepare->bindParam(7, $post['tutor2']);
        $prepare->bindParam(8, $post['curso']);
        $prepare->bindParam(9, $alumno_id);
        $prepare->execute();
    }

    //AreaDocente
    //  count all alumnos by docente
    public function allAlumnosByDocente($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT COUNT(alumno.id) as numberOfAlumnos FROM `alumno`, `docente`, `curso` WHERE docente.id='" . $id . "' AND docente.id = curso.docente_tutor AND alumno.curso = curso.id";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_COLUMN);
        return $result;

        return $result;
    }

        //  all alumnos by docente id
        public function allAlumnosByDocenteId($id)
        {
            $obj = new DbConnection();
            $conn = $obj->dbConnect();
    
            $sql = "SELECT alumno.id, alumno.NIF, alumno.nombre, alumno.apellido, alumno.apellido2, alumno.fecha_nacimiento, alumno.img, alumno.tutor1, alumno.tutor2, alumno.curso FROM `alumno`, `docente`, `curso` WHERE docente.id='" . $id . "' AND docente.id = curso.docente_tutor AND alumno.curso = curso.id";
            $prepare = $conn->prepare($sql);
            $prepare->execute();
            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        }

    // delete Alumno
    public function delAlumno($id)
    {
        $db = new DbConnection();
        $conn = $db->dbConnect();
        $query = "DELETE FROM `alumno` WHERE id = ?";

        $statement = $conn->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
    }

    //Add Alumno
    public function addAlumnoByDocente($alumno_info)
    {
        print_r($alumno_info);
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "INSERT INTO `alumno`
              (`NIF`, `img`,`nombre`, `apellido`, `apellido2`, `fecha_nacimiento`, `tutor1`,`tutor2`, `curso`)
              VALUES (?,?,?,?,?,?,?,?,?)";
        $prepared = $conn->prepare($sql);

        $prepared->bindParam(1, $alumno_info['NIF']);
        $prepared->bindParam(2, $alumno_info['img']);
        $prepared->bindParam(3, $alumno_info['nombre']);
        $prepared->bindParam(4, $alumno_info['apellido']);
        $prepared->bindParam(5, $alumno_info['apellido2']);
        $prepared->bindParam(6, $alumno_info['fecha_nacimiento']);
        $prepared->bindParam(7, $alumno_info['tutor1']);
        $prepared->bindParam(8, $alumno_info['tutor2']);
        $prepared->bindParam(9, $alumno_info['curso']);

        $prepared->execute();
    }

    //Add Tema a Alumno
    public function addAlumnoHorario($info_tema_alumno, $aula_id)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "INSERT INTO `alumnoasisitetemaaula`
                      (`IDALUMNO`, `IDAULA`, `IDTEMA`)
                      VALUES (?,?,?)";
        $prepared = $conn->prepare($sql);

        $prepared->bindParam(1, $_SESSION['horarioAlumno']);
        $prepared->bindParam(2, $aula_id);
        $prepared->bindParam(3, $info_tema_alumno['sel_tema']);

        $prepared->execute();
    }

    //  choosen aula by temarioId
    public function aulaIdByTemario($id_tema)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT a.id AS aid , a.nombre AS anombre FROM `aula` AS a, impartirtemaaula AS ita WHERE ita.IDAULA = a.id AND ita.IDTEMA='" . $id_tema . "'";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //Add Nota a Alumno (examen)
    public function addNotaAlumno($info_examen, $alumno_id)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "INSERT INTO `examen`
                      (`IDALUMNO`, `IDASIGNATURA`, `FECHA`, `NOTA`)
                      VALUES (?,?,?,?)";
        $prepared = $conn->prepare($sql);

        $prepared->bindParam(1, $info_examen['notasAlumno']);
        $prepared->bindParam(2, $info_examen['sel_asigignatura']);
        $prepared->bindParam(3, $info_examen['fecha_examan']);
        $prepared->bindParam(4, $info_examen['nota']);

        $prepared->execute();
    }

    // delete nota de alumno
    public function delNotaAsignatura($alumno_id, $asignatura_id, $fecha)
    {
        $db = new DbConnection();
        $conn = $db->dbConnect();
        $query = "DELETE FROM `examen` WHERE IDALUMNO = ? AND IDASIGNATURA = ? AND fecha = ?";

        $statement = $conn->prepare($query);
        $statement->bindParam(1, $alumno_id);
        $statement->bindParam(2, $asignatura_id);
        $statement->bindParam(3, $fecha);
        $statement->execute();
    }


    
        // update asistencia alumno
        public function updateAsistenciaAlummo($alumno_id, $asignatura_id, $fecha)
        {
            $db = new DbConnection();
            $conn = $db->dbConnect();
            $query = "DELETE FROM `examen` WHERE IDALUMNO = ? AND IDASIGNATURA = ? AND fecha = ?";
    
            $statement = $conn->prepare($query);
            $statement->bindParam(1, $alumno_id);
            $statement->bindParam(2, $asignatura_id);
            $statement->bindParam(3, $fecha);
            $statement->execute();
        }
    ///////////////////////////////////////
}
