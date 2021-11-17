<?php

    require_once "BDCategories.php";


    class Categories extends BDCategories{
        private $idCategorie;
        private $nom;

        public function __get($name) {
            switch($name) { 
                case 'idCategorie':
                    return $this->idCategorie; 
                case 'nom': 
                    return $this->nom; 
                
              }
          }

        

        public static function getAll()
        {
            $array=array();
            $rows=BDCategories::getAllCategories();
            
            foreach($rows as $value)
                    {   $Categorie = new Categories();
                        foreach($value as $key=>$values)
                            $Categorie->$key = $values;
                        array_push($array, $Categorie);
                    }
                    return $array;
        }   
        public function display_cat() {
            $id = $this->id;
            $nom = $this->nom;
            echo "<div style=\"width: 100px; display: inline-block\"><a href='forum.php?catID=$id&cat=$nom'><h5>$nom</h5</a>>";
            echo "</div>";
        }  
    /*
        public static function getAllToArray()
        {
            $array=array();
            $rows=BDCategories::getAllCategories();

            foreach($rows as $value)
                    {   
                       
                        $array[$value["idCategorie"]] = $value["nom"];
                        
                        
                    }
                   
                 
                    return $array;
        }

        public static function convertToSelect($Post)
        {
            echo "<select class='select' name='Categories'> ";
			$Categories = Categories::getAll();
   
			$NoneSelected = true;
            $SelectedCat = (isset($Post["Categories"])? $Post["Categories"] : "NothingSelected");
			foreach($Categories as $values )
			{
				if(strcasecmp($values->idCategorie,$SelectedCat) == 0)
				{
					echo"<option value=\"$values->idCategorie\" selected='selected'>$values->nom</option>";
					$NoneSelected = false;
				}
				else
				{
					echo"<option value=\"$values->idCategorie\">$values->nom</option>";
				}
				
            
			}
			if($NoneSelected)
				echo "<option value='TOUS' selected='selected'>Tous</option>";
				else
				echo "<option value='TOUS'>Tous</option>";
            
            echo"</select> ";
        }
        */
    }






?>