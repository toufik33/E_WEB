<?php 
session_start();
include "../config.php";
include"../menu_admin1.php";

if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
?>

<center><h1>Voici la liste des utilisateurs:</h1></center>

<?php
//On recupere les identifiants, les pseudos et les emails des utilisateurs
$req = mysql_query('select id, username, email,adresse from users');
echo "<center><table border='1' >
<tr>

<th><font color = 'red' >id</th>
<th><font color = 'red' />Non utilisateur</th>
<th> <font color = 'red' />E-mail</th>
<th> <font color = 'red' />Adresse</th>

</tr>";
	 
//$req = mysql_query($req) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($req)){
	//echo "Total ". $row['product_name']. " = ". $row['SUM(quantité)'];
	//echo "<br />";
	$id = $row['id'];
	echo "<tr>";
    echo "<td><a href =  profile.php?id=$id </a>$id</td>";
    echo "<td>" . $row['username'] . "</td>";
	echo "<td>" . $row['email'] . "</td>";
	echo "<td>" . $row['adresse'] . "</td>";
	
	
	
    echo "</tr>";
}
echo "</table>";

?>




<h1>Supprimer Utilisateur:</h1>
	<form id="sup" name="sup" method="post" action="sup_utilisateur.php" onSubmit="return confirm('Etes vous sûre de vouloir supprimer ce compte ?')">
Nom Utilisateur :<input type="text" name="utilisateur" id="utilisateur" />
<input type="submit" name="button" id="button" value="suprimer" />
      </form>
<?php
include "menu_admin2.php";
?>