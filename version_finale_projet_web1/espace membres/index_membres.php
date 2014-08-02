<?php
include('config.php');
include('../menu1.php');
?>


			<aside>
                <?php
//Si lutilisateur est connecte, on lui donne un lien pour modifier ses informations, pour voir ses messages et un pour se deconnecter
if(isset($_SESSION['username'])) 

{ 

?>


<a href="edit_infos.php">Modifier mes informations personnelles </a><br /></br>
<a href="connexion.php">Se d&eacute;connecter</a></br></br>
<a href="../affiche_commande.php">Mes Commandes </a></br></br>
<a href="supprimer_users.php" onclick="return confirm('Etes vous sûre de vouloir supprimer votre compte ?');">Cloturer Mon Compte </a>

<?php
}
else
{
//Sinon, on lui donne un lien pour sinscrire et un autre pour se connecter
?>
<a href="sign_up.php"><strong>Inscription</strong></a><br />
<a href="connexion.php"><strong>Se connecter</strong></a>

<?php
}
?>
</aside>
 <?php
include('../menu2.php'); 