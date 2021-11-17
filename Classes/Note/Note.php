<?php

    include "DBNote.php";
    
    class Note extends DBNote {

        private $id;
        private $idEntraineur;
        private $idClients;
        private $note;
        private $categorie;
        private $commentaire;
        
        public function __get($name) {
			
			switch ($name) { 
                
				case 'id':
                    return $this->id;
					
                case 'idEntraineur': 
                    return $this->idEntraineur;
			
                case 'idClients': 
                    return $this->idClients;

                case 'note': 
                    return $this->note;
                    
                case 'categorie':
                     return $this->categorie;
                
                case 'commentaire':
                    return $this->commentaire;
            }
        }

        public static function getCommentaireIdEntraineur($idEntraineur) {
           
            $rows = DBNote::GetCommentaireIdEntraineur($idEntraineur);
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Note = new DBNote();
                    
                    foreach($value as $key=>$values)
                    $Note->$key = $values;
                    $array[]=$Note;
                }
                return $array;
        }
    }
?>