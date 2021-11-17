<?php
include 'Classes/Utilisateurs/Clients.php';

session_start();
$mysqli = new mysqli("167.114.152.54", "equipe01", "in9vest01", "dbequipe01");
$username = $_SESSION['username'];
$client = new Clients;
$id = $client->GetByUsername($username);
if(isset($_REQUEST["upload"]))
{
if (isset($_FILES['photoPermis']) && isset($_FILES['photoDiplome'])) {
        $permis = $_FILES['photoPermis'];
        $diplome = $_FILES['photoDiplome'];
        // print_r($file);  just checking File properties

        // Permis Properties
        $file_name  = $permis['name'];
        $file_tmp   = $permis['tmp_name'];
        $file_size  = $permis['size'];
        $file_error = $permis['error'];

        // Diplome Properties
        $diplome_name  = $diplome['name'];
        $diplome_tmp   = $diplome['tmp_name'];
        $diplome_size  = $diplome['size'];
        $diplome_error = $diplome['error'];

        // Working With File Extension
        $file_ext   = explode('.', $file_name);
        $file_fname = explode('.', $file_name);

        $diplome_ext   = explode('.', $diplome_name);
        $diplome_fname = explode('.', $diplome_name);

        $diplome_fname = strtolower(current($diplome_fname));
        $diplome_ext   = strtolower(end($diplome_ext));

        $file_fname = strtolower(current($file_fname));
        $file_ext   = strtolower(end($file_ext));
        $allowed    = array('png','jpg');


        if (in_array($file_ext,$allowed) && in_array($diplome_ext,$allowed)) {
            if ($file_error === 0 && $diplome_error === 0) {
                if ($file_size <= 5000000 && $diplome_size <= 5000000) {
                        $file_name_new     =  $file_fname . uniqid('',true) . '.' . $file_ext;
                        $file_name_new    =  uniqid('',true) . '.' . $file_ext;
                        $file_destination =  'image/permisdiplome/permis/'. $username . "_" . $file_name_new;
                        $id = 75;
                        $diplome_name_new     =  $diplome_fname . uniqid('',true) . '.' . $diplome_ext;
                        $diplome_name_new    =  uniqid('',true) . '.' . $diplome_ext;
                        $diplome_destination =  'image/permisdiplome/diplome/' . $username . "_" . $diplome_name_new;
                        $procedure_params = array(
                            array($id, @idClient),
                            array($_POST["ecole"], @ecole),
                            array($_POST["annee"], @anneeGradutaion),
                            array($_POST["experienceT"], @experienceT),
                            array($_POST["travail"], @travail),
                            array($_POST["experience"], @dateTravail),
                            array($file_name_new , @imgPermis),
                            array($diplome_name_new, @imgDiplome),
                            array($_POST["bio"], @bio)
                        );
                        $ecole =$_POST["ecole"];
                        $anneeGraduation = $_POST["annee"];
                        $experienceT = $_POST["experienceT"];
                        $travail = $_POST["travail"];
                        $dateTravail = $_POST["experience"];
                        $bio = $_POST["bio"];

                        $exec = "insert into demandeEnCours (idClient, ecole, anneeGraduation, experienceT, travail, dateTravail, imgPermis, imgDiplome, bio) value ($id, '$ecole', '$anneeGraduation', '$experienceT', '$travail', '$dateTravail',  '$file_name_new', '$diplome_name_new', '$bio')";
                        
                        if (move_uploaded_file($file_tmp, $file_destination) && move_uploaded_file($diplome_tmp, $diplome_destination)) {
                            if (!$mysqli->query($exec)) {
                                echo "Echec lors de l'appel à la procédure stockée : (" . $mysqli->errno . ") " . $mysqli->error;
                            }
                                
                        }
                        else
                        {
                            echo "some error in uploading file".mysql_error();
                        }                     
                }
                else
                {
                    echo "size must bne less then 5MB";
                }
            }

        }
        else
        {
            echo "invalid file";
        }
}
$_SESSION["success"] = "Votre demande a bien été publié !";
}
else
{
$_SESSION["success"] = "Un erreur c'est produit lors de votre demande !";
}
header("location: index.php");
die();
?>