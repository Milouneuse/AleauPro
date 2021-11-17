<?php

//require_once __DIR__ . "/Classes/SQL/Connexion.php";
require_once "/home/Aleaupro2020/public_html/Classes/SQL/Connexion.php";


class ThreadTDG extends Connexion{

    static private $conn;
    static private $isInit = false;


    public static function init() {
        if(!self::$isInit)
        self::$conn = self::GetConnexion();
          
    }

    public static function get_all_threads($catid, $pinned){
        if($pinned == 1)
        {
            $query = "SELECT * FROM threads WHERE announcement = 1 order by lastupdate desc";
        }
        else if($catid == 0)
        {
            $query = "SELECT * FROM threads WHERE announcement = 0 order by lastupdate desc";
        }
        else
        {
            $query = "SELECT * FROM threads WHERE (categorieid = '$catid' and announcement = 0) order by lastupdate desc";
        }
        $rows = array();
        if($result = self::$conn->query($query)){
            while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $rows[] = $row;
            }
            $result->close();
            return $rows;
        }
    }

    public function get_by_ID($id){

        $rows = array();
                if($result = self::$conn->query("select * from threads where id=" . $id)){
                    while($row = $result->fetch_array(MYSQLI_ASSOC))
                    {
                      $rows[] = $row;
                    }
                    $result->close();
                    return $rows;
                }
    }
    public function get_by_title($title){

        $rows = array();
                if($result = self::$conn->query("select * from threads where title=" . $title)){
                    while($row = $result->fetch_array(MYSQLI_ASSOC))
                    {
                      $rows[] = $row;
                    }
                    $result->close();
                    return $rows;
                }
    }
    
    public function update($id,$title,$description,$categorieid){
        $titl = mysqli_real_escape_string(Connexion::getLink(), $title);
        $descriptio = mysqli_real_escape_string(Connexion::getLink(), $description);
        ThreadTDG::$conn->query("update threads set title = '$titl', descriptions = '$descriptio', categorieid = $categorieid where id = $id");
        $result = ThreadTDG::$conn->query("select last_insert_id()");
        return $result->fetch_row()[0];
    }

    public function delete($id){
        ThreadTDG::$conn->query("delete from threads where id = $id");
    }
    public function updatepin($id, $pin){
        ThreadTDG::$conn->query("update threads set announcement= $pin where id = $id");
    }
    public function updatelock($id, $lock){
        ThreadTDG::$conn->query("update threads set locked= $lock where id = $id");
    }
    public function updateupdate($id,$date){
        ThreadTDG::$conn->query("update threads set lastupdate= '$date' where id = $id");
    }

    public function add_thread($title,$authorID, $description, $categorieid, $locked, $announcement, $date){
        $lock = (int)$locked;
        $announce = (int)$announcement;
        $titl = mysqli_real_escape_string(Connexion::getLink(), $title);
        $descriptio = mysqli_real_escape_string(Connexion::getLink(), $description);
        ThreadTDG::$conn->query("insert into threads (title,authorID, descriptions, categorieid, locked, announcement, lastupdate, date) VALUES('$titl','$authorID','$descriptio','$categorieid',$lock,$announce, '$date', '$date')");
        $result = ThreadTDG::$conn->query("select last_insert_id()");
        return $result->fetch_row()[0];
    }



}



    ThreadTDG::init();

?>