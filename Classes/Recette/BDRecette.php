<?php
	
	require_once "Classes/SQL/Connexion.php";

        class BDRecette extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

           protected static function GetListRecetteCategorie($catego) {
			   
				if ($result = BDRecette::$conn->query("Select * from view_recette where categorie = '$catego'")) {
               
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$rows[] = $row;
					}

					$result->close();
                }
				if(isset($rows))
				return $rows;
				else
				header('location: Recettes.php?erreur=Pas%20de%20correspondance');
           }
		   
		   protected static function GetListRecetteAuteur($auteur) {
			   
				if ($result = BDRecette::$conn->query("Select * from view_recette where auteur = '$auteur'")) {
               
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$rows[] = $row;
					}

					$result->close();
                }
				if(isset($rows))
				return $rows;
				else
				header('location: Recettes.php?erreur=Pas%20de%20correspondance');
		
           }
		   
		   protected static function GetListRecetteNom($nom) {
			   
				if ($result = BDRecette::$conn->query("Select * from view_recette where nom like '%$nom%'")) {
               
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$rows[] = $row;
					}

					$result->close();
                }
				if(isset($rows))
				return $rows;
				else
				header('location: Recettes.php?erreur=Pas%20de%20correspondance');
           }
/*
       protected static function GetAbonner($idEntraineur) {
			   
        if ($result = DBEntraineurs::$conn->query("Select * from abonnementEntraineur where idEntraineur = $idEntraineur")) {
            {
            while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $rows[] = $row;
            }
            $result->close();
            }
        }
        return $rows;
   }
*/
           static protected function GetByidRecette($idRecette) {
                if ($result = BDRecette::$conn->query("Select * from view_recette_Individual where id = $idRecette")) {
					$row = $result->fetch_array(MYSQLI_BOTH);
                    $result->close();
                    return $row;
                }
           }
        
		static protected function GetListIngredient($idRecette) {
			if ($result = BDRecette::$conn->query("Select * from ingredient where idRecette = '$idRecette'")) {
				while($row = $result->fetch_array(MYSQLI_ASSOC))
				{
					$rows[] = $row;
				}
				$result->close();
            }
            return $rows;
                
           }
		   
		   static protected function GetVN($idRecette) {
			if ($result = BDRecette::$conn->query("Select * from valeurNutritiveRecette where idRecette = '$idRecette'")) {
				while($row = $result->fetch_array(MYSQLI_ASSOC))
				{
					$rows[] = $row;
				}
				$result->close();
            }
            return $rows;
                
           }
		
		
		static protected function GetListEtape($idRecette) {
			if ($result = BDRecette::$conn->query("Select * from etapeRecette where idRecette = '$idRecette'")) {
				while($row = $result->fetch_array(MYSQLI_ASSOC))
				{
					$rows[] = $row;
				}
				$result->close();
            }
            return $rows;
                
           }
		}
		
        BDRecette::init();
?>