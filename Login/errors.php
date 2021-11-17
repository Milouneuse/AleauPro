<?php  if (count($errors) > 0) : ?>
	<div class="error">
		<?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>


<?php
    function generateSuccessMSG(){
        $successMessage = $_GET["SuccessMessage"];
        echo "<p class='success_message'>$successMessage</p></br>";
    }
 
	function generateErrorMSG(){
		$errorMSG = $_GET["ErrorMSG"];
		echo "<p class='error_message'>$errorMSG</p></br>";
	}
	
	function generateSessionSuccess(){
		$successMessage = $_SESSION["success"];
		echo "<p style='text-align:center;
	color: #07AB61;' class='success_message'>$successMessage</p></br>";
	}
	
	if(isset ($_GET["ErrorMSG"]))
     generateErrorMSG();

	if(isset ($_GET["SuccessMessage"]))
	 generateSuccessMSG();

	if(isset ($_SESSION["success"]))
	 generateSessionSuccess();

?>