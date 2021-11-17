<?php

    include "BDAchats.php";
    
    class Achats extends BDAchats {

        private $idBillet;
        private $idAchat;
        private $date;
        private $idClient;
        
        public function __get($name) {
			
			switch ($name) { 
                
				case 'idAchat':
                    return $this->idAchat;
				case 'idAchat':
                    return $this->idBillet;
                        
                case 'Date': 
                    return $this->date;
			
                case 'idClient': 
                    return $this->idClient;
            }
        }

        public function getByID($id) {
           
            $rows = BDAchats::getByidAchat($id);
            
			if ($rows == null)
				printf("Erreur, retourne Null");
                
			else {
				
				$this->idAchat = $rows["idAchat"];
                $this->date = $rows["Date"];
                $this->idClient = $rows["idClient"];
            }
        }

        public function AfficherAchat() {
			
            echo ("$this->idAchat , $this->date , $this->idClient");
        }

        static public function SearchByAll($arrayDeParam) {

            if ($arrayDeParam !== null && count($arrayDeParam) === 3) {
                
                $IsValide = array_key_exists("Date", $arrayDeParam);

                if ($IsValide)
					$IsValide = array_key_exists("idClient", $arrayDeParam);
               
                if (!$IsValide)
					return null;
				
                $query = "";
				
                if (strlen($arrayDeParam["Date"]) !== 0)
					$query .= "$query Date = ".$arrayDeParam["Date"];
				
				if (strlen($arrayDeParam["idClient"]) !== 0)
					$query .= "$query idClient = ".$arrayDeParam["idClient"];

                if(strlen($query) !==0)
                    $rows = BDAchats::getByCustomWhere("WHERE $query");
				
                else
                    $rows = BDAchats::GetAll();

                $array = null;
				
                foreach($rows as $value) {   
				
					$Achat = new Achats();
					
                    foreach($value as $key=>$values)
                        $Achat->$key = $values;
						
                    $array[] = $Achat;
                }
            
                return $array;
            }
        }
    }
?>