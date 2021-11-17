<?php
 require_once "BDClients.php";
 
 class Clients extends BDClients{

    private $id;
    private $username;
    private $email;
    private $nom;
    private $prenom;
    private $sexe;
    private $dateNaissance;
    private $admin;
    private $entraineur;
    private $membre;

    public static function getByID($id) {
           
        $rows = BDClients::GetByidUser($id);
        if ($rows == null)
            printf("Erreur, retourne Null");
            
        else {
            $Clients = new BDClients();
            $Clients->id = $rows["id"];
            $Clients->username = $rows["username"];
            $Clients->email = $rows["email"];
            $Clients->nom = $rows["nom"];
            $Clients->prenom = $rows["prenom"];
            $Clients->sexe = $rows["sexe"];
            $Clients->dateNaissance = $rows["dateNaissance"];
            $Clients->entraineur = $rows["entraineur"];
            $Clients->membre = $rows["membre"];
        }
        return $Clients;
    }

    public static function GetByUsername($username) {
           
        $rows = BDClients::getByUsername($username);
        if ($rows == null)
            printf("Erreur, retourne Null");
            
        else {
            $Clients = new BDClients();
            $Clients->id = $rows["id"];
            $Clients->username = $rows["username"];
            $Clients->email = $rows["email"];
            $Clients->nom = $rows["nom"];
            $Clients->prenom = $rows["prenom"];
            $Clients->sexe = $rows["sexe"];
            $Clients->dateNaissance = $rows["dateNaissance"];
        }
        return $rows["id"];
    }

    public static function GetForm($id) {
           
        $rows = BDClients::getForm($id);
        if ($rows == null)
            return false;
        else {
            $Clients = new BDClients();
            $Clients->id = $rows["id"];
            $Clients->username = $rows["username"];
            $Clients->email = $rows["email"];
            $Clients->nom = $rows["nom"];
            $Clients->prenom = $rows["prenom"];
            $Clients->sexe = $rows["sexe"];
            $Clients->dateNaissance = $rows["dateNaissance"];
            return true;
        }
    }
    public static function GetId($username) {
        $rows = BDClients::getId($username);

        if($rows == null)
        printf("erreur");
        else 
        {
            $Clients = new BDClients();
            $Clients->id = $rows["id"];
        }

        return $rows["id"];


		
    }
    
    public function updatemembre($id){
        $TDG = new BDClients();
        $TDG->membre($id);
        $TDG = null;
    }
 }
 ?>