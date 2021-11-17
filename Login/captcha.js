function reloa()
{
img = document.getElementById("capt");
img.src="captcha.php";
}
 
$(document).ready(function(){
 
 /*<div class="form__group field">
			<input class="form__field" placeholder="Recopier le Captcha" type="text" name="g-recaptcha-response" id="captcha"required />
			<label for="captcha" class="form__label">Recopier le Captcha</label>
		</div>*/
var htm='<p id="id01"><img src="captcha.php" id="capt">&nbsp;<input width="30" height="30" type="image" src="reload.png" onClick="reloa();"  ></p><div class="form__group field"><input class="form__field" placeholder="Recopier le Captcha" type="text" name="g-recaptcha-response" id="captcha" required /><label for="captcha" class="form__label">Recopier le Captcha</label></div> ';
$('#custom_captcha').html(htm);//set the captcha data in element having id > custom_captcha . you can change as your div/Element id
 
 
 
});