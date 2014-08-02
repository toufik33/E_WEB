<?php 
session_start();
include "config.php";
include"menu_admin1.php";

if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
?>

<h1>Voici la liste des utilisateurs:</h1>

<?php
//On recupere les identifiants, les pseudos et les emails des utilisateurs
$req = mysql_query('select id, username, email,adresse from users');
while($dnn = mysql_fetch_array($req))
{
?>
        <tr>
        <td class="left"><?php echo $dnn['id']; ?></td>
        <td class="left"><a href="profile.php?id=<?php echo $dnn['id']; ?>"><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
        <td class="left"><?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?></td>
		<td class="left"><?php echo htmlentities($dnn['adresse'], ENT_QUOTES, 'UTF-8'); ?></td>
    </tr></br>
	
<?php
}
?>
<h1>Supprimer Utilisateur:</h1>
	<form id="sup" name="sup" method="post" action="sup_utilisateur.php" onSubmit="return confirm('Etes vous sûre de vouloir supprimer ce compte ?')">
Nom Utilisateur :<input type="text" name="utilisateur" id="utilisateur" />
<input type="submit" name="button" id="button" value="suprimer" />
      </form>
<?php
include "menu_admin2.php";
?>
