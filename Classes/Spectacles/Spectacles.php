<?php

    include "BDSpectacles.php";
    include_once "Classes/Categories/Categories.php";

    class Spectacles extends BDSpectacles{

        //Reprèsente l'objet dans la BD 
        // Toute la communication à la BD va se faire ici

         private $idSpectacle;
         private $nomSpectacle;
         private $Description;
         private $idCategorie;
         private $prix_de_base;
         private $nomArtiste;
         private $nomImage;

        
        
          public function __get($name) {
            switch($name) { 
                case 'idSpectacle':
                    return $this->idSpectacle; 
                case 'nomSpectacle': 
                    return $this->nomSpectacle; 
                case 'Description': 
                    return $this->Description;
                case 'idCategorie': 
                    return $this->idCategorie;
                case 'prix_de_base': 
                    return $this->prix_de_base;
                case 'nomArtiste': 
                    return $this->nomArtiste;
                case 'nomImage': 
                    return $this->nomImage;


              }
          }



        public function getByID($id){
           
                $rows = BDSpectacles::getByidSpectacle($id);
                if($rows == null)
                printf("Erreur, retourne Null");
                else{
                    $this->idSpectacle = $rows["idSpectacle"];
                    $this->nomSpectacle = $rows["nomSpectacle"];
                    $this->Description = $rows["Description"];
                    $this->idCategorie = $rows["idCategorie"];
                    $this->prix_de_base = $rows["prix_de_base"];
                    $this->nomArtiste= $rows["nomArtiste"];
                    $this->nomImage= $rows["nomImage"];
                }

        }

        public function AfficherSpectacle()
        {
            echo ("$this->idSpectacle , $this->nomSpectacle , $this->Description , $this->idCategorie , $this->prix_de_base , $this->nomArtiste");
        }
        
        static public function SearchByNomSpectacle($nomSpectacle){
                if($nomSpectacle!=null)
                {
                    $array = array();
                   $rows = BDSpectacles::getByNomSpectacle($nomSpectacle);
                   if(isset($rows))
                    foreach($rows as $value)
                    {   $Spectacle = new Spectacles();
                        foreach($value as $key=>$values)
                            $Spectacle->$key = $values;
                        $array[]=$Spectacle;
                    }
                }
               
                return $array;
                
        }

        static public function SearchByAll($arrayDeParam = null){


            if($arrayDeParam != null && count($arrayDeParam) == 3)
            {
                
                $IsValide = array_key_exists("NomSpectacle",$arrayDeParam);

                if($IsValide)
                $IsValide = array_key_exists("NomArtiste",$arrayDeParam);

                if($IsValide)
                $IsValide = array_key_exists("idCategorie",$arrayDeParam);
               
                if(!$IsValide)
                return null;

               

               
                $query = "";
                if(strlen($arrayDeParam["NomSpectacle"])!==0)
                {
                    
                    
                   $query=$query."nomSpectacle LIKE '%".$arrayDeParam["NomSpectacle"]."%' ";
                }
                if(strlen($arrayDeParam["NomArtiste"])!==0)
                {
                    if(strlen($query) !==0)
                    $query=$query." and ";

                    $query=$query." nomArtiste LIKE '%".$arrayDeParam["NomArtiste"]."%'";
                }

                if(strcmp($arrayDeParam["idCategorie"],"TOUS") !==0 )
                {
                    
                    if(strlen($query) !==0)
                    $query=$query." and ";
                    
                    $query=$query." idCategorie LIKE '".$arrayDeParam["idCategorie"]."'";
                }

                if(strlen($query) !==0)
                {
                    $rows = BDSpectacles::getByCostumeWhere("WHERE ".$query);
                   
                }
                else
                {
                  
                    $rows = BDSpectacles::GetAll();
                }

                
                 $array = null;
                foreach($rows as $value)
                {   $Spectacle = new Spectacles();
                    
                    foreach($value as $key=>$values)
                        $Spectacle->$key = $values;
                    $array[]=$Spectacle;
                }
            
                return $array;



            }
            else if($arrayDeParam == null || count($arrayDeParam) == 0) 
            {
                $rows = BDSpectacles::GetAll();
                $array = null;
                foreach($rows as $value)
                {   $Spectacle = new Spectacles();
                    
                    foreach($value as $key=>$values)
                        $Spectacle->$key = $values;
                    $array[]=$Spectacle;
                }
            
                return $array;
            }
            
            

        }

        static public function AjouterSpectacle($nomSpectacle,$Description,$idCategorie,$prix_de_base,$nomArtiste,$nomImage)
        {
            if(self::SearchByNomSpectacle($nomSpectacle)==null)
            return BDSpectacles::AjouterSpectacle($nomSpectacle,$Description,$idCategorie,$prix_de_base,$nomArtiste,$nomImage);
            else
            return false;
            
        }

        static public function AjouterRepresentation($idSpectacle,$idSalle,$Date)
        {
            if(BDSpectacles::getByidSpectacle($idSpectacle)!=null)
            {
                
                $SallePriseOuInnexistante = BDSpectacles::ajouterRepresenationSpectacle($idSpectacle,$idSalle,$Date);
                return $SallePriseOuInnexistante;
            }
        }
        
        static public function AjouterSpecRepresentation($nomSpectacle,$Description,$idCategorie,$prix_de_base,$nomArtiste,$nomImage,$Date,$idSalle)
        {
            $result = self::SearchByNomSpectacle($nomSpectacle);
            if($result == null)
            {
                
                $idSpectacle = self::AjouterSpectacle($nomSpectacle,$Description,$idCategorie,$prix_de_base,$nomArtiste,$nomImage);
               
            }
            else
            {
                $idSpectacle = $result[0]->idSpectacle;
            }

            self::AjouterRepresentation($idSpectacle,$idSalle,$Date);

        }

       
    }




?>


