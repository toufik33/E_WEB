<?php
include('../config.php');
?>
<?php
include ('../menu1.php');
?>
<?php
//On verifie si lutilisateur est connecte
if(isset($_SESSION['username']))


if (mysql_query(" DELETE FROM users where username = '$username'"))
	{
							//Si ca a fonctionne, on naffiche pas le formulaire
							$form = false;
							//On supprime les sessions username  au cas ou il aurait supprimer son pseudo
							unset($_SESSION['username']);
?>
<div class="message">Votre compte a et� bien supprim� <br />

<?php
						}
						
						include ('../menu2.php');
						?>
						