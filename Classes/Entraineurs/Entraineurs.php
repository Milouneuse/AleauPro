<?php

    include "BDEntraineurs.php";
    
    class Entraineurs extends DBEntraineurs {

        private $id;
        private $username;
        private $nom;
        private $prenom;
        private $sexe;
        private $img;
        
        public function __get($name) {
			
			switch ($name) { 
                
				case 'id':
                    return $this->id;
					
                case 'username': 
                    return $this->username;
			
                case 'nom': 
                    return $this->nom;

                case 'prenom': 
                    return $this->prenom;
                    
                case 'sexe':
                     return $this->sexe;
                     
                case 'img':
                    return $this->img;
            }
        }

        public static function getByID($id) {
           
            $rows = DBEntraineurs::GetByidEntraineur($id);
			if ($rows == null)
				printf("Erreur, retourne Null");
                
			else {
                $Entraineurs = new DBEntraineurs();
				$Entraineurs->id = $rows["id"];
                $Entraineurs->username = $rows["username"];
                $Entraineurs->email = $rows["email"];
                $Entraineurs->nom = $rows["nom"];
                $Entraineurs->prenom = $rows["prenom"];
                $Entraineurs->sexe = $rows["sexe"];
                $Entraineurs->telephone = $rows["telephone"];
                $Entraineurs->dateNaissance = $rows["dateNaissance"];
                $Entraineurs->ecole = $rows["ecole"];
                $Entraineurs->travail = $rows["travail"];
                $Entraineurs->img = $rows["img"];
                $Entraineurs->note = $rows["note"];                
            }
            return $Entraineurs;
        }

        public static function getListCoach($idCategorie) {
           
            $rows = DBEntraineurs::GetListCoach($idCategorie);
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Entraineurs = new DBEntraineurs();
                    
                    foreach($value as $key=>$values)
                    $Entraineurs->$key = $values;
                    $array[]=$Entraineurs;
                }
            
                return $array;
        }

        public static function getAbonner($idEntraineur) {
           
            $rows = DBEntraineurs::GetAbonner($idEntraineur);
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Entraineurs = new DBEntraineurs();
                    
                    foreach($value as $key=>$values)
                    $Entraineurs->$key = $values;
                    $array[]=$Entraineurs;
                }
                return $array;
        }

        public static function getFollow($userid, $entraineurid){
            $rows = DBEntraineurs::getFollow($userid,$entraineurid);
            if(mysqli_num_rows($rows) > 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function updateecol($id, $ecole){
            $TDG = new DBEntraineurs();
            $TDG->updateecole($id, $ecole);
            $TDG = null;
        }

        public function updatetravai($id, $travail){
            $TDG = new DBEntraineurs();
            $TDG->updatetravail($id, $travail);
            $TDG = null;
        }

        public function updatebi($id, $bio){
            $TDG = new DBEntraineurs();
            $TDG->updatebio($id, $bio);
            $TDG = null;
        }

        public function follow($userid,$entraineurid){
            $TDG = new DBEntraineurs();
            $TDG->follo($userid, $entraineurid);
            $TDG = null;
        }
        public function unfollow($userid,$entraineurid){
            $TDG = new DBEntraineurs();
            $TDG->unfollo($userid, $entraineurid);
            $TDG = null;
        }
    }
?>