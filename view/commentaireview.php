<?php 
 include "./Classes/Note/Note.php"; 

$note = new Note;
if($note->getCommentaireIdEntraineur($id) != null)
{
$noteList = $note->getCommentaireIdEntraineur($id);


foreach($noteList as $item)
{
     
     
     $clientList = $Clients->getByID($item->idClients);
    ?>
   <div class="commentaire" id="<?php echo $item->id; ?>">
   <div style='grid-row: 1;'>
    <img id="profilPhoto" src="./image/ProfilePicDefault.jpg"> </img>

    <p id="usernameComment">
      
    <?php 
    if($clientList->username != null)
     echo $clientList->username; 
     else
     echo 'Compte Effacé';
     ?>
    </p>
    <div>
    <?php
    for($i = 0; $i < 5; $i++)
    {
         if($i < $item->note)
    echo'<span class="fa fa-star checked"></span>';
         else
    echo'<span class="fa fa-star"></span>';
    }
     ?>
     </div>
     </div>
    <text>
    <?php echo $item->commentaire; ?>
    </text>
    <div id="iconCommentaire">
    <?php 
    if(isset($_SESSION['id']))
    if($_SESSION['id'] != $item->idClients)
    echo"<img src='./image/report.png'> </img>";
    
    if(isset($_SESSION['id']))
    if($_SESSION['id'] == $item->idClients || isset($_SESSION['admin']))
    {
    echo" <img src='./image/modifier.png'> </img>";
    echo"<img src='./image/poubelle.jpg'> </img>";
    }
    
    ?>
</div>
   </div>
<?php
}

}
else
echo '<p> Aucun commentaire </p>';

?>