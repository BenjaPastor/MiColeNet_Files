<?php

include_once "Dbconnection.php";

class FrontEnd
{
    //  all  info FrontEnd
    public function infoFrontEnd()
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();

        $sql = "SELECT * FROM `frontend` WHERE id = '1'";
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //Update identidad + seo
    public function updateIdentidad($post)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "UPDATE `frontend` SET `primary_color`=?,`seo_titulo`=?,`seo_descripcion`=?,`logo`=?,`favicon`=? WHERE `id`='1'";
        $prepare = $conn->prepare($sql);
        $prepare->bindParam(1, $post['color']);
        $prepare->bindParam(2, $post['seo_titulo']);
        $prepare->bindParam(3, $post['seo_descripcion']);
        $prepare->bindParam(4, $post['logo']);
        $prepare->bindParam(5, $post['favicon']);
        $prepare->execute();
    }
    //Update menu
    public function updateMenu($post)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "UPDATE `frontend` SET `menu1`=?,`menu2`=?,`menu3`=? WHERE `id`='1'";
        $prepare = $conn->prepare($sql);
        $prepare->bindParam(1, $post['menu1']);
        $prepare->bindParam(2, $post['menu2']);
        $prepare->bindParam(3, $post['menu3']);
        $prepare->execute();
    }

    //Update menu
    public function updateSlider($post)
    {

        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        $sql = "UPDATE `frontend` SET `slider_title`=?,`slider_subtitle`=?,`slider_texto`=? ,`slider_img`=? WHERE `id`='1'";
        $prepare = $conn->prepare($sql);
        $prepare->bindParam(1, $post['slider_titulo']);
        $prepare->bindParam(2, $post['slider_subtitlo']);
        $prepare->bindParam(3, $post['slider_text']);
        $prepare->bindParam(4, $post['img']);
        $prepare->execute();
    }

    //Update Secciones FrontEnd
    public function updateSeccion($post, $seccion)
    {
        $obj = new DbConnection();
        $conn = $obj->dbConnect();
        //CASE
        switch ($seccion) {
            case 1:
                $sql = "UPDATE `frontend` SET `menu1_subtitle`=?,`menu1_icon1`=?,`menu1_icon1_title`=?,`menu1_icon1_text`=?,`menu1_icon2`=?,`menu1_icon2_title`=?,`menu1_icon2_text`=?,`menu1_icon3`=?,`menu1_icon3_title`=?,`menu1_icon3_text`=? WHERE `id`='1'";
                $prepare = $conn->prepare($sql);
                $prepare->bindParam(1, $post['menu1_subtitle']);
                $prepare->bindParam(2, $post['menu1_icon1']);
                $prepare->bindParam(3, $post['menu1_icon1_title']);
                $prepare->bindParam(4, $post['menu1_icon1_text']);
                $prepare->bindParam(5, $post['menu1_icon2']);
                $prepare->bindParam(6, $post['menu1_icon2_title']);
                $prepare->bindParam(7, $post['menu1_icon2_text']);
                $prepare->bindParam(8, $post['menu1_icon3']);
                $prepare->bindParam(9, $post['menu1_icon3_title']);
                $prepare->bindParam(10, $post['menu1_icon3_text']);
                $prepare->execute();
                break;
            case 2:
                $sql = "UPDATE `frontend` SET `menu2_subtitle`=?,`menu2_text`=?,`menu2_icon1_top`=?,`menu2_icon1_text`=?,`menu2_icon2_top`=?,`menu2_icon2_text`=?,`menu2_icon3_top`=?,`menu2_icon3_text`=? WHERE `id`='1'";
                $prepare = $conn->prepare($sql);
                $prepare->bindParam(1, $post['menu2_subtitle']);
                $prepare->bindParam(2, $post['menu2_text']);
                $prepare->bindParam(3, $post['menu2_icon1_top']);
                $prepare->bindParam(4, $post['menu2_icon1_text']);
                $prepare->bindParam(5, $post['menu2_icon2_top']);
                $prepare->bindParam(6, $post['menu2_icon2_text']);
                $prepare->bindParam(7, $post['menu2_icon3_top']);
                $prepare->bindParam(8, $post['menu2_icon3_text']);
                $prepare->execute();
                break;
            case 3:
                $sql = "UPDATE `frontend` SET `menu3_subtitle`=?,`menu3_1_img`=?,`menu3_1_title`=?,`menu3_1_text`=?,`menu3_2_img`=?,`menu3_2_title`=?,`menu3_2_text`=?,`menu3_3_img`=?,`menu3_3_title`=?,`menu3_3_text`=? WHERE `id`='1'";
                $prepare = $conn->prepare($sql);
                $prepare->bindParam(1, $post['menu3_subtitle']);
                $prepare->bindParam(2, $post['img1']);
                $prepare->bindParam(3, $post['menu3_1_title']);
                $prepare->bindParam(4, $post['menu3_1_text']);
                $prepare->bindParam(5, $post['img2']);
                $prepare->bindParam(6, $post['menu3_2_title']);
                $prepare->bindParam(7, $post['menu3_2_text']);
                $prepare->bindParam(8, $post['img3']);
                $prepare->bindParam(9, $post['menu3_3_title']);
                $prepare->bindParam(10, $post['menu3_3_text']);

                $prepare->execute();
                break;
            case 4:
                
                $sql = "UPDATE `frontend` SET `foto_direc1`=?,`foto_direc2`=?,`foto_direc3`=? WHERE `id`='1'";
                $prepare = $conn->prepare($sql);
                $prepare->bindParam(1, $post['img1']);
                $prepare->bindParam(2, $post['img2']);
                $prepare->bindParam(3, $post['img3']);

                $prepare->execute();
                break;

            case 5:
                $sql = "UPDATE `frontend` SET `testimonio1`=?,`testimonio1_text`=?,`testimonio2`=?,`testimonio2_text`=? WHERE `id`='1'";
                $prepare = $conn->prepare($sql);
                $prepare->bindParam(1, $post['testimonio1']);
                $prepare->bindParam(2, $post['testimonio1_text']);
                $prepare->bindParam(3, $post['testimonio2']);
                $prepare->bindParam(4, $post['testimonio2_text']);

                $prepare->execute();
                break;
        }

    }

}
