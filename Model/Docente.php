<?php
include_once "Usuario.php";
include_once "Dbconnection.php";
class Docente extends Usuario
{
    //Get tutor from curso by alumno id
    public function docenteTutorCurso($id){
        $obj=new DbConnection();
        $conn=$obj->dbConnect();

        $sql="SELECT c.docente_tutor AS cdocente_tutor, d.nombre AS dnombre, d.apellido as dapellido, d.apellido2 as dapellido2 FROM curso as c, docente AS d, alumno as al WHERE c.docente_tutor = d.id AND al.curso = c.id AND al.id = $id";
        $prepared=$conn->prepare($sql);
        $prepared->execute();
        $result=$prepared->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //Get all info de docente by id
    public function allInfoDocente($id){
        $obj=new DbConnection();
        $conn=$obj->dbConnect();

        $sql="SELECT * FROM docente AS d WHERE id = $id";
        $prepared=$conn->prepare($sql);
        $prepared->execute();
        $result=$prepared->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    //Get all info de docentes
    public function allInfodocentes(){
        $obj=new DbConnection();
        $conn=$obj->dbConnect();

        $sql="SELECT * FROM docente";
        $prepared=$conn->prepare($sql);
        $prepared->execute();
        $result=$prepared->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //Get all cursos where docente is tutor
    public function allCursosOfDocenteIsTutor($id){
        $obj=new DbConnection();
        $conn=$obj->dbConnect();

        $sql="SELECT curso.id, curso.nombre, curso.ciclo FROM curso, docente WHERE curso.docente_tutor = docente.id AND docente.id = $id";
        $prepared=$conn->prepare($sql);
        $prepared->execute();
        $result=$prepared->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //Update perfil docente
    public function updatePerfil($post, $id){
     
        $obj=new DbConnection();
        $conn=$obj->dbConnect();
        $sql="UPDATE `docente` SET `contrasenya`=?,`img`=?, `nombre`=?,`apellido`=?,`apellido2`=? WHERE `id`=?";
        $prepare=$conn->prepare($sql);
        $prepare->bindParam(1,$post['contrasenya']);
        $prepare->bindParam(2,$post['img']);
        $prepare->bindParam(3,$post['nombre']);
        $prepare->bindParam(4,$post['apellido']);
        $prepare->bindParam(5,$post['apellido2']);
        $prepare->bindParam(6,$id);
        $prepare->execute();
    }

    //Is Docente Admin
    public function isDocenteAdmin($id){
        $obj=new DbConnection();
        $conn=$obj->dbConnect();

        $sql="SELECT is_admin FROM docente WHERE docente.id = $id";
        $prepared=$conn->prepare($sql);
        $prepared->execute();
        $result = $prepared->fetch();
        return $result;
    }

    //Add Docente
    public function addDocente($docente_info)
    {
        $newPass = md5($docente_info['pass']);
        
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "INSERT INTO `docente`
              (`CIF`, `nombre`, `apellido`, `apellido2`,`img`, `email`, `contrasenya`, `is_admin`)
              VALUES (?,?,?,?,?,?,?,?)";
        $prepared = $conn->prepare($sql);
        $prepared->bindParam(1, $docente_info['CIF']);
        $prepared->bindParam(2, $docente_info['nombre']);
        $prepared->bindParam(3, $docente_info['apellido']);
        $prepared->bindParam(4, $docente_info['apellido2']);
        $prepared->bindParam(5, $docente_info['img']);
        $prepared->bindParam(6, $docente_info['email']);
        $prepared->bindParam(7, $newPass);
        $prepared->bindParam(8, $docente_info['is_admin']);

        $prepared->execute();
    }

        // delete Docente
        public function delDocente($id)
        {
            $db = new DbConnection();
            $conn = $db->dbConnect();
            $query = "DELETE FROM `docente` WHERE id = ?";
    
            $statement = $conn->prepare($query);
            $statement->bindParam(1, $id);
            $statement->execute();
        }

            //Update docente
    public function updateFromDocente($post, $docente_id)
    {
        print_r($post);
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "UPDATE `docente` SET `nombre`=?,`apellido`=?,`apellido2`=?,`img`=?,`email`=?, `is_admin`=? WHERE `id`=?";
        $prepare = $conn->prepare($sql);
        $prepare->bindParam(1, $post['nombre']);
        $prepare->bindParam(2, $post['apellido']);
        $prepare->bindParam(3, $post['apellido2']);
        $prepare->bindParam(4, $post['img']);
        $prepare->bindParam(5, $post['email']);
        $prepare->bindParam(6, $post['is_admin']);
        $prepare->bindParam(7, $docente_id);
        $prepare->execute();
    }
        

    ///////////////////////////////////////////

    
    //    contar todos docentes
    public function numberOfDocentes(){
        $obj=new DbConnection();
        $conn=$obj->dbConnect();

        $sql="SELECT COUNT(id) as allDocentes FROM docente";
        $prepare=$conn->prepare($sql);
        $prepare->execute();
        $result=$prepare->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    ////////Mensajería////////

        //  all unread messages from buzon
        public function allUnReadMsgsByDocente($email){
            
            $obj=new DbConnection();
            $conn=$obj->dbConnect();
    
            $sql="select m1.id, m1.title, m1.timestamp, m1.user1type, count(m2.id) as respuestas, d.nombre as dnombre, d.apellido as dapellido, t.nombre as tnombre, t.apellido AS tapellido
            from buzon as m1, buzon as m2, docente as d, tutor as t
            where (m1.user1='$email' and m1.user1read='no' or m1.user2='$email' and m1.user2read='no')
            and m1.id2='1' and m2.id=m1.id 
            and d.email = '$email' or t.email = '$email'
            group by m1.id order by m1.id desc";
            $prepare=$conn->prepare($sql);
            $prepare->execute();
            $result=$prepare->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        //  all read messages from buzon
        public function allReadMsgsByDocente($email){
            $obj=new DbConnection();
            $conn=$obj->dbConnect();
            
            $sql="select m1.id, m1.title, m1.timestamp, m1.user1type, count(m2.id) as respuestas, d.nombre as dnombre, d.apellido as dapellido, t.nombre as tnombre, t.apellido AS tapellido
            from buzon as m1, buzon as m2, docente as d, tutor as t
            where (m1.user1='$email' and m1.user1read='yes' or m1.user2='$email' and m1.user2read='yes')
            and m1.id2='1' and m2.id=m1.id 
            and (d.email = '$email' or t.email = '$email')
            group by m1.id order by m1.id desc";
            $prepare=$conn->prepare($sql);
            $prepare->execute();
            $result=$prepare->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }

        //  count respuestas of msg
        public function countRespuestasById($id){
            $obj=new DbConnection();
            $conn=$obj->dbConnect();
    
            $sql="select count(buzon.id2) as respuestas from buzon where id='.$id.'";
            $prepare=$conn->prepare($sql);
            $prepare->execute();
            
            $result=$prepare->fetch(PDO::FETCH_COLUMN);
            return $result;

        }

        //  count unread messages from buzon
        public function countUnreadMsgs($id){
            $obj=new DbConnection();
            $conn=$obj->dbConnect();
    
            $sql="select title, user1, user2 from buzon where id='.$id.' and id2='1'";
            $prepare=$conn->prepare($sql);
            $prepare->execute();
            $result=$prepare->fetch(PDO::FETCH_ASSOC);
            return $result;

        }



        ///////////////////////////////////////
}
