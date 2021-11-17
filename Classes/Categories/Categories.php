<?php

    require_once "BDCategories.php";


    class Categories extends BDCategories{
        private $id;
        private $nom;

        public function __get($name) {
            switch($name) { 
                case 'idCategorie':
                    return $this->id; 
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
        public function display_cat($catid) {
            $id = $this->id;
            $nom = $this->nom;
            if($catid == $id)
            {
                echo "<a href='forum.php' style=\"border: 2px solid black; color: orange;\"><h5>$nom</h5></a>";
            }
            else
            {
                echo "<a href='forum.php?catID=$id&cat=$nom' style=\"border: 2px solid black;\"><h5>$nom</h5></a>";
            }
            
        }  

        public function select_cat() {
            $id = $this->id;
            $nom = $this->nom;
            echo "<option value='$id'>$nom</options>";
        }
    
    }






?>