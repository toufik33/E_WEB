<?php 
session_start();
include "config.php";
include"menu_admin1.php";

if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
?>

<h1>Editer commande</h1> </br> </br></br>
  <form method="POST" action="editer_commande.php">
  etat commande :
 <select name="editer_commande">
    <option value="en pr�paration">En pr�paration</option>
    <option value="en cours d�exp�dition">En cours d�exp�dition</option>
    <option value="exp�di�e">Exp�di�e</option>
    </select>
 Nom clients :
 <input type="text" name="user"></br>
 Date d'ajout du produit :
 <input type="text" name="date"></br>
 <input type="submit" name ="envoyer">
</form>


<?php

$result = mysql_query("SELECT * FROM transactions   ");

echo "<table border='1'>
<tr>
<th>client</th>
<th>Nom du produit</th>
<th>Prix/u</th>
<th>Quantit�</th>
<th> �tat de la  commande </th>
<th> Date de la  commande</th>
</tr>";

while($row = mysql_fetch_array($result,MYSQL_ASSOC))
  {
  echo "<tr>";
  echo "<td>".  $row['username']."</td>";
  echo "<td>" . $row['product_name'] . "</td>";
  echo "<td>" . $row['prix'] . "</td>";
  echo "<td>" . $row['quantit�'] . "</td>";
  echo"<td>"  . $row['etat_commande']     . "</td>";
  echo"<td>"  . $row['date_ajout_commande']     . "</td>";
  echo "</tr>";
  }
  //echo "  Votre commande est enregistrer avec succee</br></br></br>";
  //echo " Merci $username,  voici Toutes vos commande  :";

echo "</table>";

//else echo "vous n'avez pas de commande enregistree";
 
 ?>
<?php
include('menu_admin2.php');
?>



