<?php

include_once __DIR__ . "/threadTDG.php";
include_once "/home/Aleaupro2020/public_html/Classes/Utilisateurs/Clients.php";
include  "/home/Aleaupro2020/public_html/Classes/Posts/Post.php";

class Thread{

    private $id;
    private $title;
    private $categorieid;
    private $locked;
    private $announcement;
    //description
    private $description;
    
    //autheur id
    private $authorID;
    public function __construct(){
      
    }

    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_title(){
        return $this->title;
    }

    public function get_categorieid(){
        return $this->categorieid;
    }
    public function get_Description()
    {
        return $this->description;
    }
    public function get_authorID()
    {
        return $this->authorID;
    }

    public function get_locked()
    {
        return $this->locked;
    }
    public function get_announcement()
    {
        return $this->announcement;
    }

    //setters
    public function set_id($id){
        $this->id = $id;
    }

    public function set_title($title){
        $this->title = $title;
    }

    public function set_categorieid($cat){
        $this->categorieid = $cat;
    }
    public function set_description($description){
        $this->description = $description;
    }
    public function set_authorID($authorID)
    {
        $this->authorID = $authorID;
    }
    public function set_locked($locked)
    {
        $this->locked = $locked;
    }
    public function set_announcement($announcement)
    {
        $this->announcement = $announcement;
    }

    public static function load_thread_by_id($id){
        $TDG = new ThreadTDG();
        $res = $TDG->get_by_ID($id);
        $array= array();
        if(!$res){
            return false;
        }
        array_push($array, $res[0]["id"]);
        array_push($array, $res[0]["title"]);
        array_push($array, $res[0]["categorieid"]);
        array_push($array, $res[0]["authorID"]);
        array_push($array, $res[0]["descriptions"]);
        array_push($array, $res[0]["locked"]);
        array_push($array, $res[0]["announcement"]);
        array_push($array, $res[0]["date"]);
        return $array;
    }

    public static function getAll($catid, $pinned)
        {
            $array=array();
            $rows=ThreadTDG::get_all_threads($catid, $pinned);
            
            foreach($rows as $value)
                    {   $Thread = new Thread();
                        foreach($value as $key=>$values)
                            $Thread->$key = $values;
                        array_push($array, $Thread);
                    }
                    return $array;
        }

    public function load_thread_by_title($title){
        $TDG = new ThreadTDG();
        $res = $TDG->get_by_title($title);

        if(!$res){
            return false;
        }

        $this->id = $res["id"];
        $this->title = $res["title"];
        $this->description = $res["descriptions"];
        $this->categorieid = $res["categorieid"];
        $this->authorID = $res["authorID"];
        return true;
    }

    public function add_thread($title,$authorID,$description, $categorieid, $locked, $announcement, $date){
        $TDG = new ThreadTDG();
        $res = $TDG->add_thread($title,$authorID, $description, $categorieid, $locked, $announcement, $date);
        $TDG = null;
        if(!$res)
        {
            return false;
        }
        return true;
    }

    public function update($id, $title,$description, $categorieid){
        $TDG = new ThreadTDG();
        $res = $TDG->update($id, $title, $description, $categorieid);
        $TDG = null;
        if(!$res)
        {
            return false;
        }
        return true;
    }

    public function delete($id){
        $TDG = new ThreadTDG();
        $TDG->delete($id);
        $TDG = null;
    }

    public function updatepin($id, $pin){
        $TDG = new ThreadTDG();
        $TDG->updatepin($id, $pin);
        $TDG = null;
    }

    public function updatelock($id, $lock){
        $TDG = new ThreadTDG();
        $TDG->updatelock($id, $lock);
        $TDG = null;
    }
    public function updateupdate($id,$date){
        $TDG = new ThreadTDG();
        $TDG->updateupdate($id, $date);
        $TDG = null;
    }

    public function display_thread(){
        $title = $this->title;
        $id = $this->id;
        $description = $this->description;
        $categorieid = $this->categorieid;
        $authorID = $this->authorID;
        $author = new Clients();
        $authordata = $author->getByID($authorID);
        $name = $authordata->username;
        $locked = $this->locked;
        $date = $this->date;
        $lastupdate = $this->lastupdate;
        $post_list = Post::getAll($id);
        $nbcomments = count($post_list);
        echo "<div style='padding-top: 25px; width: 90%'>";
        if($locked == 1)
        {
            echo "<div class='card-header' ><a href='displaythread.php?threadID=$id&author=$name'><h5 style='color: orange;'>$title</h5><h5 style='color: orange'>PAR $name</h5><h6 style='color: orange'>PUBLIÉ $date</h6><h6 style='color: orange'>Dernière activitée $lastupdate     $nbcomments commentaires</h6></a>";
        }
        else
        {
            echo "<div class='card-header' ><a href='displaythread.php?threadID=$id&author=$name'><h5 style='text-left'>$title</h5><h5 style=''>PAR $name</h5><h6>PUBLIÉ $date</h6><h6>Dernière activitée $lastupdate     $nbcomments commentaires</h6></a>";
        }
        echo "</div>";
        //echo "<div class='col-sm-8 mb-4 card-header text-right'><h5>Par AUTHEUR</h5></div>";
        echo "</div>";
    }







}




?>