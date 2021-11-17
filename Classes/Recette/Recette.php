<?php

    include "BDRecette.php";
    
    class Recette extends BDRecette {

        private $id;
        private $categorie;
        private $nom;
        private $image;
        private $temps;
        private $urlVideo;
		private $presentation;
		private $auteur;
		private $idEtape;
		private $description;
		private $titreEtape;
		private $idIngredient;
		private $nomIngredient;
		private $quantite;
		private $calories;
		private $fat;
		private $proteine;
		private $carbs;
		
        public function __get($name) {
			
			switch ($name) { 
                
				case 'id':
                    return $this->id;
					
                case 'categorie': 
                    return $this->categorie;
			
                case 'nom': 
                    return $this->nom;

                case 'image': 
                    return $this->image;
                    
                case 'temps':
                     return $this->temps;
					 
				case 'presentation':
                     return $this->presentation;
					 
				case 'urlVideo':
                     return $this->urlVideo;
					 
				case 'auteur':
                     return $this->auteur;
					 
				case 'note':
					return $this->note;
					
				case 'idEtape':
					return $this->idEtape;
					
				case 'description':
					return $this->description;
					
				case 'titreEtape':
					return $this->titreEtape;
					
				case 'nomIngredient':
					return $this->nomIngredient;
					
				case 'quantite':
					return $this->quantite;
				
				case 'idIngredient':
					return $this->idIngredient;
					
				case 'calories':
					return $this->calories;
					
				case 'fat':
					return $this->fat;
					
				case 'proteine':
					return $this->proteine;
				
				case 'carbs':
					return $this->carbs;
            }
        }

        public static function getByID($id) {
           
            $rows = BDRecette::GetByidRecette($id);
			if ($rows == null)
				printf("Erreur, retourne Null");
                
			else {
                $Recette = new BDRecette();
				$Recette->id = $rows["id"];
                $Recette->categorie = $rows["categorie"];
                $Recette->nom = $rows["nom"];
                $Recette->image = $rows["image"];
                $Recette->temps = $rows["temps"];
                $Recette->urlVideo = $rows["urlVideo"];
                $Recette->presentation = $rows["presentation"];
                $Recette->auteur = $rows["auteur"];
				$Recette->note = $rows["note"];
            }
            return $Recette;
        }

        public static function getListRecetteCategorie($categorie) {
           
            $rows = BDRecette::GetListRecetteCategorie($categorie);
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Recette = new BDRecette();
                    
                    foreach($value as $key=>$values)
                    $Recette->$key = $values;
                    $array[]=$Recette;
                }
            
                return $array;
        }
		
		public static function getListRecetteAuteur($auteur) {
           
            $rows = BDRecette::GetListRecetteAuteur($auteur);
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Recette = new BDRecette();
                    
                    foreach($value as $key=>$values)
                    $Recette->$key = $values;
                    $array[]=$Recette;
                }
            
                return $array;
        }
		
		public static function getListRecetteNom($nom) {
           
            $rows = BDRecette::GetListRecetteNom($nom);
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Recette = new BDRecette();
                    
                    foreach($value as $key=>$values)
                    $Recette->$key = $values;
                    $array[]=$Recette;
                }
            
                return $array;
        }
		
		public static function getListEtape($idRecette) {
			 $rows = BDRecette::GetListEtape($idRecette);
           if ($rows == null)
				printf("Erreur, retourne Null");
                
			foreach($rows as $value)
                {   $Recette = new BDRecette();
                    
                    foreach($value as $key=>$values)
                    $Recette->$key = $values;
                    $array[]=$Recette;
                }
            
                return $array;
		}
		
		public static function getListIngredient($idRecette) {
			$rows = BDRecette::GetListIngredient($idRecette);
           if ($rows == null)
				printf("Erreur, retourne Null");
                
			foreach($rows as $value)
                {   $Recette = new BDRecette();
                    
                    foreach($value as $key=>$values)
                    $Recette->$key = $values;
                    $array[]=$Recette;
                }
            
                return $array;
		}
		
		public static function getVN($idRecette) {
			$rows = BDRecette::GetVN($idRecette);
           if ($rows == null)
				printf("Erreur, retourne Null");
                
			foreach($rows as $value)
                {   $Recette = new BDRecette();
                    
                    foreach($value as $key=>$values)
                    $Recette->$key = $values;
                    $array[]=$Recette;
                }
            
                return $array;
		}
    }
?>