<?php
include ('config.php');
include ('menu1.php');


if(isset($_SESSION['username'])){
$result = mysql_query("SELECT * FROM transactions WHERE username='$username' ");

echo "<table border='5'>
<tr>

<th>Nom du produit  </th>
<th>Prix/u</th>
<th>Quantité</th>
<th> etat de votre commande </th>
<th> Date de votre commande</th>

</tr>";

while($row = mysql_fetch_array($result,MYSQL_ASSOC))
  {
  echo "<tr>";
  
  echo "<td>" . $row['product_name'] . "</td>";
  echo "<td>" . $row['prix'] . "</td>";
  echo "<td>" . $row['quantité'] . "</td>";
  echo"<td>"  . $row['etat_commande']     . "</td>";
  echo"<td>"  . $row['date_ajout_commande']     . "</td>";
  
  echo "</tr>";
  }
  //echo "  Votre commande est enregistrer avec succee</br></br></br>";
  echo " Merci $username,  voici Toutes vos commande  :";

echo "</table>";
}
else echo "vous n'avez pas de commande enregistree";
 
 ?>
 <?php
 include('menu2.php'); ?>

