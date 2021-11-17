<?php 
include "Classes/PlanEntrainement/PlanEntrainement.php";
session_start();
if(!isset($_SESSION["username"]))
header("location: Login/login.php")

?>

<html>
<head>
	<title>Plans</title>
	<link rel="stylesheet" type="text/css" href="css.css">
</head>

<body>
	<div id="navbar" class="navbar onload" style="top: 0px;">
		<!-- notification message -->
		<?php 
			include "NavBar.php";
			echo '</div>';

		?>
    </div>
    <div id="portailUser">
    <div class="menu-info">
     <h3 style="grid-column: 1 / 8 span;"> Plan d'entrainement de <?php echo $_SESSION["username"]; ?> </h3>
     <div onclick="creationPlan()"> 
     <p> Créer votre plan </p>
     <div style="background-image: url('image/icon/add.PNG');  background-repeat: no-repeat; background-size: cover;"> </div>
     </div>
     <?php
        $planEntrainement = new PlanEntrainement;
        $planEntrainementTab = $planEntrainement->getPlanByUserId($_SESSION["id"]);
        if(isset($planEntrainementTab))
        {
        foreach($planEntrainementTab as $item){
          ?>
      <div onclick="location.href='modifyPlanView.php?planId=<?php echo $item->planId ?>'">
      <p> <?php echo $item->nom ?>
      <div style="background-image: url('image/modifier.png');  background-repeat: no-repeat; background-size: cover;"> </div>
      </div>
          <?php
        }
      }
     ?>
</div>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>AleauPro</h2>
    </div>
    <div class="modal-body">
    <form id="regForm" action="ForumlaireCréationPlan.php" method="post">
  <h1>Création de plan:</h1>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">Nom:
    <p><input placeholder="Nom du plan" oninput="this.className = ''" name="fname"></p>
    Description : 
    <p><textarea id="bio" name="bio" placeholder="Description du plan. Les objectifs qui va vous permettre à atteindre ..." style="height:200px"></textarea></p>
  </div>
  <div class="tab">Objectif de l'entrainement:
    <p><select name="objectif" id="objectif" oninput="this.className = ''">
  <option value="perte">Perte de poids</option>
  <option value="gain">Gagner de la masse</option>
  <option value="santer">Rester en santé</option>
</select></p>
    Nombre de jours actifs durant la semaine d'entrainement : 
    <p><select name="jours" id="jours" oninput="this.className = ''" onchange="ajoutJournee()" required>
    <option value="" selected disabled> -- Choisir -- </option>
    <option value="1">1 journée</option>
  <option value="2">2 journées</option>
  <option value="3">3 journées</option>
  <option value="4">4 journées</option>
  <option value="5">5 journées</option>
  <option value="6">6 journées</option>
  <option value="7">7 journées</option>
</select></p>
  </div>
    <div id="in">
    </div> 
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Précédant</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Continuer</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div id="counterRound" style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>
    </div>
  </div>

</div>

<div id="Modify" class="modal">


</div>

<div id="template" style="display:none;">

<?php include "view/workoutform.php"?>

    </div>
    </div>
</div>

<script>
var counter = 0;
function ajoutJournee() {
  var x = document.getElementById("jours").value;
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("in");
            var containerRound = document.getElementById("counterRound");
            // Clear previous contents of the container
            if(counter != 0)
            {
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
            while (containerRound.hasChildNodes()) {
                containerRound.removeChild(containerRound.lastChild);
            }
            for(i=0;i<2;++i)
            {
              var span = document.createElement("span");
                span.className = ("step finish");
                var divRond = document.getElementById("counterRound");
                divRond.appendChild(span);
            }
            }
            ++counter;

            
            for (i=0;i<x;i++){
                // Create an <input> element, set its type and name attributes
                var div = document.createElement("div");
                var itm = document.getElementById("template");
                var clone = itm.cloneNode(true);
                clone.style.display = "initial";
                div.id = "jours" + i;
                div.className += ("tab");
                var idAddition = i + 1;
                div.innerHTML += "Journée " + idAddition;
                var divAfter = document.getElementById("in");
                if(i != 0)
                {
                var id = i-1;
                var query = "jours" + id;
                divAfter = document.getElementById(query);
                insertAfter(divAfter, div);
                }
                else{
                  divAfter.appendChild(div);
                }
                div.appendChild(clone);
                
                var span = document.createElement("span");
                span.className = ("step");
                var divRond = document.getElementById("counterRound");
                divRond.appendChild(span);
                
            }
}

function insertAfter(referenceNode, newNode) {
  referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

// Get the modal
var modal = document.getElementById("myModal");
var modalMod = document.getElementById("Modify");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function creationPlan() {
  modal.style.display = "block";
}

function modifyPlan(id) {
  modalMod.style.display = "block";
  modalMod.innerHTML='<object id="obj" type="text/document" style="width:100%; height:100%;" data="view/modifyPlanView.php?planId=' + id + '" ></object>';
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  modalMod.style.display = "none";
  alert("hellow");
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal || event.target == modalMod) {
    modal.style.display = "none";
    modalMod.style.display = "none";
  }
}

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Créer";
  } else {
    document.getElementById("nextBtn").innerHTML = "Continuer";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
  compteurAddToPlan = 0;
} 
function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, z, e, m, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  z = x[currentTab].getElementsByTagName("select");
  e = x[currentTab].getElementsByTagName("table");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "" && y[i].id != "nbPoids") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  if(e[1] != null){
  if(e[1].getElementsByTagName("tr").length == 0){
      alert("Vous devez avoir au moin 1 exercise par journée !");
      valid = false;
    }
  }
  for (i = 0; i < z.length; i++) {
    // If a field is empty...
    if (z[i].value == "") {
      // add an "invalid" class to the field:
      z[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

function SortByMuscle() {
  // Declare variables
  var x, select, table, tr, i;
  x = document.getElementsByClassName("tab");
  select = x[currentTab].getElementsByTagName("select");
  table = x[currentTab].getElementsByTagName("table");
  tr = table[0].getElementsByTagName("tr");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    if (select[0].value == tr[i].id || select[0].value == "all") {
        tr[i].style.display = "";
      }
       else {
        tr[i].style.display = "none";
      }
    }
  }
  var compteurAddToPlan = 0;
  function AddToPlan(id, nom){
    var x, table, tr;
    x = document.getElementsByClassName("tab");
    var jour = document.getElementsByClassName("tab");
    table = x[currentTab].getElementsByTagName("table");
    tr = document.createElement("TR");
    tr.id = jour[currentTab].id + "Exercice" + compteurAddToPlan + 'info';
    var td = document.createElement("TD");
    var modify = document.createElement("TD");
    var deleteimg = document.createElement("TD");
    td.innerHTML = "<input id='NomExercice" + jour[currentTab].id + "Exercice" + compteurAddToPlan + "' name='NomExercice" + jour[currentTab].id + "Exercice" + compteurAddToPlan + "' value='" + nom + "' readonly>";
    td.style.width = "100%";
    modify.innerHTML = "<a><img src='./image/modifier.png' onclick=ModifyExerciceFromPlan('" + jour[currentTab].id + "Exercice" + compteurAddToPlan + "') width='50px' height='50px'> </img></a>";
    deleteimg.innerHTML = "<a><img onclick=DeleteFromPlan('" + jour[currentTab].id + "Exercice" + compteurAddToPlan + "') src='./image/poubelle.jpg' width='50px' height='50px'> </img></a>"
    tr.appendChild(td);
    tr.appendChild(modify);
    tr.appendChild(deleteimg);
    table[1].appendChild(tr);
    CreateInput(jour[currentTab].id + "Exercice" + compteurAddToPlan, table);
    ++compteurAddToPlan;
  }
  

  function CreateInput(id, table)
  {
    var div = document.createElement("div");
    div.id = id;
    div.style.display = "none";
    div.innerHTML = "Nombre de répétitions : ";
    var inputPoids = document.createElement("input");
    inputPoids.name = "nbPoids" + id;
    inputPoids.id = "nbPoids";
    inputPoids.oninput = "this.className = ''";
    var selectNbDeSeries = document.createElement("select");
    selectNbDeSeries.name = "nbSerie" + id;
    selectNbDeSeries.id = "nbSerie";
    selectNbDeSeries.oninput = "this.className = ''";
    var label = document.createElement("label");
    label.for= selectNbDeSeries.id;
    label.innerHTML = "Nombre de séries : ";
    var labelPoids = document.createElement("label");
    labelPoids.for= inputPoids.id;
    labelPoids.innerHTML = "Poids : ";
    var selectNbDeRepetitions = document.createElement("select");
    selectNbDeRepetitions.name = "nbRep" + id;
    selectNbDeRepetitions.id = "nbRep";
    selectNbDeRepetitions.oninput = "this.className = ''";
    div.appendChild(selectNbDeSeries);
    div.appendChild(label);
    div.appendChild(selectNbDeRepetitions);
    div.appendChild(labelPoids);
    div.appendChild(inputPoids);
    for(var i = 1; i <= 100; i++){
      var optionNbDeSeries = document.createElement("option");
      optionNbDeSeries.value = i;
      optionNbDeSeries.text = i;
      if(i == 10)
      optionNbDeSeries.selected = true;
      selectNbDeSeries.appendChild(optionNbDeSeries);
    }
    for(var i = 1; i <= 20; ++i){
      var optionNbDeRepetitions = document.createElement("option");
      optionNbDeRepetitions.value = i;
      optionNbDeRepetitions.text = i;
      if(i == 4)
      optionNbDeRepetitions.selected = true;
      selectNbDeRepetitions.appendChild(optionNbDeRepetitions);
    }
    table[1].appendChild(div);
  }
  function ModifyExerciceFromPlan(id){
    var divDejaCree = document.getElementById(id);
    if(divDejaCree.style.display == "")
      divDejaCree.style.display = "none";
    else
        divDejaCree.style.display = "";      
  }
  function DeleteFromPlan(id){
    var x, table, tr, div;
    x = document.getElementsByClassName("tab");
    table = x[currentTab].getElementsByTagName("table");
    tr = document.getElementById(id);
    div = document.getElementById(id + "info");
    tr.remove();
    div.remove();
    UpdateId(id, table);
  }
  function UpdateId(id, table){
    var tr = table[1].getElementsByTagName("tr");
    var tableauChar = id.split("Exercice");
    for(var i = 0; i <= tr.length; ++i){
      if(tableauChar[1] < i){
        var idTrToChange = document.getElementById(tableauChar[0] + "Exercice" + i + "info");
        var idDivToChange = document.getElementById(tableauChar[0] + "Exercice" + i);
        var inputName = document.getElementById("NomExercice" + tableauChar[0]  + "Exercice" + i);
        var newId = i - 1;
        inputName.name = "NomExercice" + tableauChar[0] + "Exercice" + newId;
        inputName.id = "NomExercice" + tableauChar[0] + "Exercice" + newId;
        idDivToChange.id = tableauChar[0] + "Exercice" + newId;
        idTrToChange.id = tableauChar[0] + "Exercice" + newId + "info";
        var button = idTrToChange.getElementsByTagName("a");
        button[0].innerHTML = "<img src='./image/modifier.png' onclick=ModifyExerciceFromPlan('" + idDivToChange.id + "') width='50px' height='50px'> </img>";
        button[1].innerHTML = "<img onclick=DeleteFromPlan('" + idDivToChange.id + "') src='./image/poubelle.jpg' width='50px' height='50px'> </img>";
        var tableauSelect = idDivToChange.children;
        for(var i = 0; i < tableauSelect.length; ++i){
          tableauSelect[i].name = tableauSelect[i].id + tableauChar[0] + "Exercice" + newId;
        }
        table[1].appendChild(idTrToChange);
        table[1].appendChild(idDivToChange);
      }      
  }  
  compteurAddToPlan--;
}


</script>

