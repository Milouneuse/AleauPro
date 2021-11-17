<?php
 require_once "Classes/SQL/Connexion.php";

     


        class BDSpectacles extends Connexion{
            
            static private $conn;
            static private $isInit = false;


            public static function init() {
                if(!self::$isInit)
                self::$conn = self::GetConnexion();
          
            }

            static protected function ajouterSpectacle($nomSpectacle,$Description,$idCategorie,$prix_de_base,$nomArtiste,$nomImage)
            {
              echo 'pppp';
			  echo $nomSpectacle;
              BDSpectacles::$conn->query("INSERT INTO spectacles (idSpectacle, nomSpectacle, Description, idCategorie, prix_de_base, nomArtiste, nomImage) VALUES(null,'$nomSpectacle','$Description','$idCategorie','$prix_de_base','$nomArtiste','$nomImage')");
              $result = BDSpectacles::$conn->query("Select last_insert_id()");
              return $result->fetch_row()[0];
            }

            static protected function ajouterRepresenationSpectacle($idSpectacle,$idSalle,$Date)
            {
              
            
              $result = BDSpectacles::$conn->query("INSERT INTO representations (idRepresentation,idSpectacle,Date,idSalle)
              VALUES(null,$idSpectacle,'$Date',$idSalle)");
              
              $result = BDSpectacles::$conn->query("Select last_insert_id()");
              $idRep = $result->fetch_row()[0];
            

              $result = BDSpectacles::$conn->query("Select prix_de_base from spectacles where idSpectacle = $idSpectacle");
              $prix_de_base = $result->fetch_row()[0];
             
              $result = BDSpectacles::$conn->query("Select * from sections where idSalle = $idSalle ");
              $insertionQuery = "";
              while($row = $result->fetch_array(MYSQLI_ASSOC)){
                for ($i=0; $i < $row["Capacite"]; $i++) { 
                 
                  $prix = (float)$row["fm_Prix"]*(float)$prix_de_base;
                 
                  $idSection = $row["idSection"];

                  $insertionQuery=$insertionQuery."(null, $prix,$idRep,$idSpectacle,$idSection,$idSalle) |";
                }
              }
              $result->close();

              
              $array = array();
              $array= explode("|",$insertionQuery);
              // La raison pour laquel je fais une boucle pour ajouter tout les billets : 
              //  Limite d'insertion par Query
              foreach ($array as $value) {
                if(!empty($value))
                {
               
                $stmt = "INSERT INTO billet (idBillet, prix_de_base,idRepresentation, idSpectacle, idSection, idSalle) VALUES ".$value;
                $result = BDSpectacles::$conn->query($stmt);
             
               
              }
              
             

            }
          }

           protected static function GetAll(){
               if($result = BDSpectacles::$conn->query("Select * from spectacles")){
                   
                while($row = $result->fetch_array(MYSQLI_ASSOC))
                {
                  $rows[] = $row;
                }

                $result->close();
                return $rows;
               }
           }

           static protected function getByidSpectacle($idSpectacle){
                if($result = BDSpectacles::$conn->query("Select * from spectacles where idSpectacle = $idSpectacle")){
                    $row = $result->fetch_array(MYSQLI_BOTH);
                    $result->close();
                    return $row;
                }
           }

           static protected function getByNomSpectacle($nomSpectacle)
           {
               $rows = array();
            if($result = BDSpectacles::$conn->query("Select * from spectacles where UPPER(nomSpectacle) LIKE UPPER('%$nomSpectacle%')")){
                while($row = $result->fetch_array(MYSQLI_ASSOC))
                {
                  $rows[] = $row;
                }
                $result->close();
                return $rows;
            }
           }

           static protected function getByCostumeWhere($CostumeWhereQuery)
           {

             $rows = array();

              if($result = BDSpectacles::$conn->query("Select * from spectacles $CostumeWhereQuery")){

                while($row = $result->fetch_array(MYSQLI_ASSOC))
                {
                  $rows[] = $row;
                }
               
                $result->close();
                return $rows;
           }

          

            }
        }
    
    
      
      
    

      BDSpectacles::init();


?>