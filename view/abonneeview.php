<?php include "Classes/Abonnées/Abonnées.php"; ?>

<?php
    $abonée = new Abonnées;
    
    ?> 
    
    <?php
    if($abonée->getAbonner($id) != null)
    {
        $listAbonnée = $abonée->getAbonner($id);
        echo '<div class="abonee">';
    foreach($listAbonnée as $item)
    {
        ?>
        <div>
        <img src="./image/ProfilePicDefault.jpg" style="width: 100px; height: 100px;"> </img>
        <p>
        <?php
        $clientInfo = $Clients->getByID($item->idClient);
        echo $clientInfo->username;
        ?> </p> </div> <?php
    }
}
else
{
    echo '<p> Aucun abonné </p>';
}
?>
</div>