<?php

    include "BDAchatsReels.php";
    
    class AchatReels extends BDAchatReels {

        private $idClient;
        private $date;
        private $idSection;
        private $idRepresentation;
        private $quantite;
        
        public function __get($name) {
			
			switch ($name) { 
                case 'idClient':
                    return $this->idClient;
                case 'idSection':
                    return $this->idSection;
                case 'idRepresentation':
                    return $this->idRepresentation;
                case 'Quantite': 
                    return $this->quantite;
                    case 'Date': 
                        return $this->date;
            }
        }

        public function getByID($id) {
           
            $rows = BDAchatReels::getByidAchatReel($id);
            
			if ($rows == null)
				printf("Erreur, retourne Null");
                
			else {
				
				$this->idBillet = $rows["idBillet"];
                $this->quantite = $rows["Quantite"];
                $this->idAchat = $rows["idAchat"];
            }
        }

        public function AfficherAchatReel() {
			
            echo ("$this->idBillet , $this->quantite , $this->idAchat");
        }

        static public function SearchByidClient($idClient)
        {
            $rows = BDAchatReels::getByCustomWhere("WHERE idClient = $idClient");

            foreach($rows as $value) {   
				
                $AchatReel = new AchatReels();
                
                foreach($value as $key=>$values)
                    $AchatReel->$key = $values;
                    
                $array[] = $AchatReel;
            }
            return $array;
        }

        static public function SearchByAll($arrayDeParam) {

            if ($arrayDeParam !== null && count($arrayDeParam) === 3) {
                
                $IsValide = array_key_exists("Quantite", $arrayDeParam);

                if ($IsValide)
					$IsValide = array_key_exists("idAchat", $arrayDeParam);
               
                if (!$IsValide)
					return null;
				
                $query = "";
				if( array_key_exists("Quantite", $arrayDeParam));
                if (strlen($arrayDeParam["Quantite"]) !== 0)
					$query .= "$query Quantite = ".$arrayDeParam["Quantite"];
				
				

                if(strlen($query) !==0)
                    $rows = BDAchatReels::getByCustomWhere("WHERE $query");
				
                else
                    $rows = BDAchatReels::GetAll();

                $array = null;
				
                foreach($rows as $value) {   
				
					$AchatReel = new AchatReels();
					
                    foreach($value as $key=>$values)
                        $AchatReel->$key = $values;
						
                    $array[] = $AchatReel;
                }
            
                return $array;
            }
        }


        static public function ajouterAchatsReel($idClient,$date,$idSection,$idRepresentation,$quantite){

            BDAchatReels::addAchatReel($date,$idSection,$idRepresentation,$quantite,$idClient);
            
        }
    }
?>