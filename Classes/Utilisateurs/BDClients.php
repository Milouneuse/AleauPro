<?php
 require_once "/home/Aleaupro2020/public_html/Classes/SQL/Connexion.php";
 
 class BDClients extends Connexion{

    static private $conn;
    static private $isInit = false;

    
    public static function init() {
				
        if (!self::$isInit)
            self::$conn = self::GetConnexion();
    }

    static protected function getByUsername($username) {
        if ($result = BDClients::$conn->query("Select * from clients where username = '$username'")) {
            $row = $result->fetch_array(MYSQLI_BOTH);
            $result->close();
            return $row;
        }
   }

    static protected function GetByidUser($idUser) {
        if ($result = BDClients::$conn->query("Select * from clients where id = $idUser")) {
            $row = $result->fetch_array(MYSQLI_BOTH);
            $result->close();
            return $row;
        }
   }
   static public function getUserByEmail($email)
    {
        $conn = connect();
        $sql = "SELECT * FROM clients WHERE email='$email'";
        $result = $conn->query($sql);
        $conn -> close();
        return $result;
    }
	
	static public function getUserByUsername($user)
    {
        $conn = connect();
        $sql = "SELECT * FROM clients WHERE username='$user'";
        $result = $conn->query($sql);
        $conn -> close();
        return $result;
    }

    static protected function getForm($id) {
        if ($result = BDClients::$conn->query("Select * from demandeEnCours where idClient = '$id'")) {
            $row = $result->fetch_array(MYSQLI_BOTH);
            $result->close();
            return $row;
        }
   }

    static public function getId($user)
    {
        if ($result = BDClients::$conn->query("SELECT id FROM clients WHERE username='$user'")) 
		$result = $conn->query($sql);
		return $result;
    }

    protected static function membre($id){
        BDClients::$conn->query("update clients set membre = 1 where id = $id");
    }
 }
 
 BDClients::init();
 
 
 
 
 
 
 
 
 
 
 ?>