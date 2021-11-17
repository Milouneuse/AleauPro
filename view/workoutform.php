<?php include "./Classes/Exercises/Exercice.php";
include "./Classes/CategoriesMuscles/CategorieMuscle.php";  

$categorieMuscle = new CategorieMuscle;
if($categorieMuscle->getAllCategorie() != null)
{
    $ListCategorieMuscle = $categorieMuscle->getAllCategorie(); 
}
$exercice = new Exercice;
if($exercice->getAllExercise() != null)
{
$exerciceList = $exercice->getAllExercise();
?>
<p><select oninput="this.className = ''" onchange="SortByMuscle()">
  <option value="all"> -- Selectionner le muscle que vous désirez entrainer --</option>
  <?php foreach($ListCategorieMuscle as $item) { ?>
    <option value="<?php echo $item->MuscleID; ?>"> <?php echo $item->MuscleNom ?></option>
    <?php } ?>
</select></p>
<div class='workoutform'>
<div>
    Liste d'exercises :
    <table class="listExercices">
    <?php foreach($exerciceList as $item) { ?>
    <tr id="<?php echo $item->TypeMuscle ?>" >
        <td>
        <img id='profilPhoto' src='./image/ProfilePicDefault.jpg' width="50px" height="50px"> </img>
        </td>
        <td colspan="4">
            <?php echo $item->ExerciceNom; ?> <br>
            <?php echo $item->ExerciceDescription; ?>
        </td>
        <td>
        <a onclick="AddToPlan('<?php echo $item->ExerciceID; ?>', '<?php echo $item->ExerciceNom; ?>');">
        <img src='./image/icon/add.PNG' width="50px" height="50px"> </img>
        </a>
        </td>
        
    </tr>
    <?php  }} ?>
    </table>
</div>
<div>
Votre plan d'entrainement :
<table width="100%" style="display:block;">
    </table>
</div>
</div>