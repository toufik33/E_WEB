<?php 
session_start();
include "config.php";
include"menu_admin1.php";

if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
?>

<h1><strong><center><em>Stat Vente Globale </h1>

<?php
// Make a MySQL Connection

$query = "SELECT product_name, SUM(quantit�),prix FROM transactions GROUP BY product_name "; 
echo "<center><table border='1'>
<tr>

<th><font color = 'red' >Nom du Produit</th>
<th><font color = 'red' />Quantit�</th>
<th> <font color = 'red' />PRIX/U</th>
<th> <font color = 'red' />PRIX Total</th>

</tr>";
	 
$result = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($result)){
	//echo "Total ". $row['product_name']. " = ". $row['SUM(quantit�)'];
	//echo "<br />";
	
	echo "<tr>";
    echo "<td>".  $row['product_name']."</td>";
    echo "<td>" . $row['SUM(quantit�)'] . "</td>";
	echo "<td>" . $row['prix'] . "</td>";
	$total = $row['prix'] * $row['SUM(quantit�)'];
	echo '<td>' . $total . '&euro;</td>';
	
    echo "</tr>";
}
echo "</table>";

?>
<h1><strong><center><em>Stat Vente Journali�re </h1>
<?php
$today =date("Y-m-d"); 
echo $today;
$query = "SELECT product_name, SUM(quantit�),prix FROM transactions where date_ajout_commande = '$today' GROUP BY product_name  "; 
echo "<center><table border='1'>
<tr>

<th><font color = 'red' >Nom du Produit</th>
<th><font color = 'red' />Quantit�</th>
<th> <font color = 'red' />PRIX/U</th>
<th> <font color = 'red' />PRIX Total</th>

</tr>";
	 
$result1 = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($result1)){
	//echo "Total ". $row['product_name']. " = ". $row['SUM(quantit�)'];
	//echo "<br />";
	
	echo "<tr>";
    echo "<td>".  $row['product_name']."</td>";
    echo "<td>" . $row['SUM(quantit�)'] . "</td>";
	echo "<td>" . $row['prix'] . "</td>";
	$total = $row['prix'] * $row['SUM(quantit�)'];
	echo '<td>' . $total . '&euro;</td>';
	
    echo "</tr>";
}
echo "</table>";
?>
<?php
include('menu_admin2.php');

?>
