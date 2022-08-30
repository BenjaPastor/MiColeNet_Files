<?php
include_once "Usuario.php";
include_once "Dbconnection.php";

class Tutor extends Usuario
{
    //  all tutores
    public function allTutores()
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT * FROM `tutor`";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }
    //  all info de Tutor by id
    public function allInfoTutor($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT * FROM `tutor` WHERE tutor.id='" . $id . "'";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);

        return $result;

    }

    //Update perfil
    public function updatePerfil($post, $id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "UPDATE `tutor` SET `contrasenya`=?,`img`=?, `nombre`=?,`apellido`=?,`apellido2`=?,`telefono`=?, `movil`=?, `calle`=?, `n_calle`=?, `CP`=?, `poblacion`=?, `provincia`=?, `xtra_direccion`=? WHERE `id`=?";
        $prepare = $conn->prepare($sql);
        $prepare->bindParam(1, $post['contrasenya']);
        $prepare->bindParam(2, $post['img']);
        $prepare->bindParam(3, $post['nombre']);
        $prepare->bindParam(4, $post['apellido']);
        $prepare->bindParam(5, $post['apellido2']);
        $prepare->bindParam(6, $post['telefono']);
        $prepare->bindParam(7, $post['movil']);
        $prepare->bindParam(8, $post['calle']);
        $prepare->bindParam(9, $post['n_calle']);
        $prepare->bindParam(10, $post['CP']);
        $prepare->bindParam(11, $post['poblacion']);
        $prepare->bindParam(12, $post['provincia']);
        $prepare->bindParam(13, $post['xtra_direccion']);
        $prepare->bindParam(14, $id);
        $prepare->execute();
    }

    //Add tutor
    public function addTutor($tutor_info)
    {
        $newPass = md5($tutor_info['pass']);

        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "INSERT INTO `tutor`
              (`NIF`, `email`, `contrasenya`, `img`, nombre, apellido, apellido2, telefono, movil, calle, n_calle, CP, poblacion, provincia, xtra_direccion, rol)
              VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'tutor')";
        $prepare = $conn->prepare($sql);
        $prepare->bindParam(1, $tutor_info['nif']);
        $prepare->bindParam(2, $tutor_info['email']);
        $prepare->bindParam(3, $newPass);
        $prepare->bindParam(4, $tutor_info['img']);
        $prepare->bindParam(5, $tutor_info['nombre']);
        $prepare->bindParam(6, $tutor_info['apellido']);
        $prepare->bindParam(7, $tutor_info['apellido2']);
        $prepare->bindParam(8, $tutor_info['telefono']);
        $prepare->bindParam(9, $tutor_info['movil']);
        $prepare->bindParam(10, $tutor_info['calle']);
        $prepare->bindParam(11, $tutor_info['n_calle']);
        $prepare->bindParam(12, $tutor_info['CP']);
        $prepare->bindParam(13, $tutor_info['poblacion']);
        $prepare->bindParam(14, $tutor_info['provincia']);
        $prepare->bindParam(15, $tutor_info['xtra_direccion']);
        $prepare->execute();
    }

    //Update tutor
    public function updateTutor($tutor_info, $tutor_id)
    {
        $newPass = md5($tutor_info['contrasenya']);

        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        if (isset($tutor_info['img'])) {
            $sql = "UPDATE `tutor` SET `NIF`=?,`email`=?,`contrasenya`=?,`img`=?,`nombre`=?, `apellido`=? , `apellido2`=?, `telefono`=?, `movil`=?, `calle`=?, `n_calle`=?, `CP`=?, `poblacion`=?, `provincia`=?, `xtra_direccion`=?, `rol`='tutor' WHERE `id`=?";
            $prepare = $conn->prepare($sql);
            $prepare->bindParam(1, $tutor_info['nif']);
            $prepare->bindParam(2, $tutor_info['email']);
            $prepare->bindParam(3, $newPass);
            $prepare->bindParam(4, $tutor_info['img']);
            $prepare->bindParam(5, $tutor_info['nombre']);
            $prepare->bindParam(6, $tutor_info['apellido']);
            $prepare->bindParam(7, $tutor_info['apellido2']);
            $prepare->bindParam(8, $tutor_info['telefono']);
            $prepare->bindParam(9, $tutor_info['movil']);
            $prepare->bindParam(10, $tutor_info['calle']);
            $prepare->bindParam(11, $tutor_info['n_calle']);
            $prepare->bindParam(12, $tutor_info['CP']);
            $prepare->bindParam(13, $tutor_info['poblacion']);
            $prepare->bindParam(14, $tutor_info['provincia']);
            $prepare->bindParam(15, $tutor_info['xtra_direccion']);
            $prepare->bindParam(16, $tutor_id);
            $prepare->execute();
        } else {
            $sql = "UPDATE `tutor` SET `NIF`=?,`email`=?,`contrasenya`=?,`nombre`=?, `apellido`=? , `apellido2`=?, `telefono`=?, `movil`=?, `calle`=?, `n_calle`=?, `CP`=?, `poblacion`=?, `provincia`=?, `xtra_direccion`=?, `rol`='tutor' WHERE `id`=?";
            $prepare = $conn->prepare($sql);
            $prepare->bindParam(1, $tutor_info['nif']);
            $prepare->bindParam(2, $tutor_info['email']);
            $prepare->bindParam(3, $newPass);

            $prepare->bindParam(4, $tutor_info['nombre']);
            $prepare->bindParam(5, $tutor_info['apellido']);
            $prepare->bindParam(6, $tutor_info['apellido2']);
            $prepare->bindParam(7, $tutor_info['telefono']);
            $prepare->bindParam(8, $tutor_info['movil']);
            $prepare->bindParam(9, $tutor_info['calle']);
            $prepare->bindParam(10, $tutor_info['n_calle']);
            $prepare->bindParam(11, $tutor_info['CP']);
            $prepare->bindParam(12, $tutor_info['poblacion']);
            $prepare->bindParam(13, $tutor_info['provincia']);
            $prepare->bindParam(14, $tutor_info['xtra_direccion']);
            $prepare->bindParam(15, $tutor_id);
            $prepare->execute();
        }

    }

    // delete tutor
    public function delTutor($id)
    {
        $db = new DbConnection();
        $conn = $db->dbConnect();
        $query = "DELETE FROM `tutor` WHERE id = ?";

        $statement = $conn->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
    }

    ////////Mensajería////////

    // select all available destinatarios by tuto id
    public function allDestinatariosByDocenteId($email)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT d.id AS did, d.email AS demail, d.nombre AS dnombre, d.apellido AS dapellido, d.apellido2 AS dapellido2 FROM docente AS d";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }
    public function allDestinatariosTutoresByDocenteId($email)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT t.id AS tid, t.email AS temail, t.nombre AS tnombre, t.apellido AS tapellido, t.apellido2 AS tapellido2 FROM tutor AS t";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    //  all unread messages from buzon
    public function allUnReadMsgsByTutor($email)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql="select m1.id, m1.title, m1.timestamp, m1.user1type, count(m2.id) as respuestas, d.nombre as dnombre, d.apellido as dapellido, t.nombre as tnombre, t.apellido AS tapellido
        from buzon as m1, buzon as m2, docente as d, tutor as t
        where (m1.user1='$email' and m1.user1read='no' or m1.user2='$email' and m1.user2read='no')
        and m1.id2='1' and m2.id=m1.id 
        and (d.email = '$email' or t.email = '$email')
        group by m1.id order by m1.id desc";

        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        $unReadMsg = $prepare->rowCount();

        return $result;

    }
    //  all read messages from buzon
    public function allReadMsgsByTutor($email)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
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
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

        //  get remitente from msg
        public function getRemitenteByMsg($id)
        {
            $obj = new DbConnection();
            $conn = $obj->dbConnect();
    
            $sql = "SELECT d.nombre AS dnombre, d.apellido AS dapellido FROM `buzon` AS b, docente AS d WHERE b.id='" . $id . "' AND b.id2 = '1' AND b.user1 = d.email";
            $prepare = $conn->prepare($sql);
            $prepare->execute();
            $result = $prepare->fetch(PDO::FETCH_COLUMN);
    
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
    public function countUnreadMsgs($id)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "select title, user1, user2 from buzon where id='.$id.' and id2='1'";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    ///////////////////////////////////////

}
