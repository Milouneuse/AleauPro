<?php

include_once __DIR__ . "/postTDG.php";
include_once "/home/Aleaupro2020/public_html/Classes/Utilisateurs/Clients.php";

class Post{

    private $id;
    private $content;
    private $date;
    private $authorID;
    private $threadID;

    public function __construct(){

    }

    public function get_id(){
        return $this->id;
    }

    public function get_Content()
    {
        return $this->content;
    }

    public function get_authorID()
    {
        return $this->authorID;
    }

    public function get_Date()
    {
        return $this->date;
    }

    public function set_id($id){
        $this->id = $id;
    }

    public function set_authorID($authorID)
    {
        $this->authorID = $authorID;
    }

    public function set_Date($date)
    {
        $this->date = $date;
    }

    public function set_Content($content)
    {
        $this->content = $content;
    }


    public static function getAll($threadid)
        {
            $array=array();
            $rows=PostTDG::get_all_posts($threadid);
            
            foreach($rows as $value)
                    {   $Post = new Post();
                        foreach($value as $key=>$values)
                            $Post->$key = $values;
                        array_push($array, $Post);
                    }
                    return $array;
        }

    public function add_post($authorID,$content, $threadid, $date){
        $TDG = new PostTDG();
        $res = $TDG->add_post($authorID,$content, $threadid, $date);
        $TDG = null;
        if(!$res)
        {
            return false;
        }
        return true;
    }

    public function update($id,$content){
        $TDG = new PostTDG();
        $res = $TDG->update($id,$content);
        $TDG = null;
        if(!$res)
        {
            return false;
        }
        return true;
    }

    public function delete($id){
        $TDG = new PostTDG();
        $TDG->delete($id);
        $TDG = null;
    }

    public function deletethread($id){
        $TDG = new PostTDG();
        $TDG->deletethread($id);
        $TDG = null;
    }


    public function display_post($userid, $admin){

        $id = $this->id;
        $content= $this->content;
        $date= $this->date;
        $authorID = $this->authorID;
        $author = new Clients();
        $authordata = $author->getByID($authorID);
        $name = $authordata->username;
        echo "<div style='text-align: center; font-weight: bold; padding-top: 5%; width: 90%'>";
        echo "<h4>PAR $name</h4>";
        echo "<h5>Publié $date</h5>";
        echo "</div>";
        echo "<div style='padding-top: 25px; width: 90%; text-align: center;'>";
        echo "<div class='card-header' ><span style='white-space: pre-line;'>$content</span></div>";

        if($userid == $authorID){
            echo"<a href='#form$id' class='btn btn-default' data-toggle='collapse'>Modifier</a>";
            echo "<div id='form$id' class='collapse'>";
            echo"<form method='post' action='forms/processPost.php'>";
            echo "<div class='input-group'>";
            echo "<input name='id' id='id' type='hidden' value='$id'/>";
            echo "<input name='switch' id='switch' type='hidden' value='edit'/>";
            echo "<textarea name='texte' id='texte'>$content</textarea><br>";
            echo "</div>";
            echo "<div class='input-group'>";
            echo "<button type='submit'>Modifier</button>";
            echo "</div>";
            echo "</form>";
            echo "</div>";
        }
        if($userid == $authorID || $admin){
            echo"<a href='#delete$id' class='btn btn-default' data-toggle='collapse'>Supprimer</a>";
            echo "<div id='delete$id' class='collapse'>";
            echo"<form method='post' action='forms/processPost.php'>";
            echo "<div class='input-group'>";
            echo "<input name='id' id='id' type='hidden' value='$id'/>";
            echo "<input name='switch' id='switch' type='hidden' value='delete'/>";
            echo "<button type='submit'>Êtes-vous sûr de vouloir supprimer ce commentaire?</button>";
            echo "</div>";
            echo "</form>";
            echo "</div>";
        }


        echo "</div>";


    }


}

?>