 <?php
 
 require_once "Classes/SQL/Connexion.php";

    

 
 class BDCategories extends Connexion{
            
            static private $conn;
            static private $isInit = false;


            public static function init() {
                if(!self::$isInit)
                self::$conn = self::GetConnexion();
          
            }


            protected static function getAllCategories()
            {
                
                $rows = array();
                if($result = self::$conn->query("select * from categorie")){
                    while($row = $result->fetch_array(MYSQLI_ASSOC))
                    {
                      $rows[] = $row;
                    }
                    $result->close();
                    return $rows;
                }
                
            }
        }


        BDCategories::init();
?>