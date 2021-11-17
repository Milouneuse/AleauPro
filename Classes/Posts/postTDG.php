<?php

require_once "/home/Aleaupro2020/public_html/Classes/SQL/Connexion.php";

class PostTDG extends Connexion{

    static private $conn;
    static private $isInit = false;


    public static function init() {
        if(!self::$isInit)
        self::$conn = self::GetConnexion();
          
    }

    public static function get_all_posts($threadid){
        $query = "SELECT * FROM posts WHERE threadid = '$threadid'";
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

    public function add_post($authorID,$content, $threadid, $date){
        $conten = mysqli_real_escape_string(Connexion::getLink(), $content);
        $query = "insert into posts (authorID, content, threadID, date) VALUES('$authorID','$conten','$threadid','$date')";
        PostTDG::$conn->query($query);
        $result = PostTDG::$conn->query("select last_insert_id()");
        return $result->fetch_row()[0];
    }

    public function update($id, $content) {
        $conten = mysqli_real_escape_string(Connexion::getLink(), $content);
        $query = "update posts set content = '$conten' where id = $id";
        PostTDG::$conn->query($query);
        $result = PostTDG::$conn->query("select last_insert_id()");
        return $result->fetch_row()[0];
    }

    public function delete($id){
        PostTDG::$conn->query("delete from posts where id = $id");
    }

    public function deletethread($id){
        PostTDG::$conn->query("delete from posts where threadID = $id");
    }


}

PostTDG::init();

?>