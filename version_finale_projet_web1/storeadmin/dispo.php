<?php 
session_start();
include "config.php";
include"menu_admin1.php";

if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
?>
<h1><strong><center><em> Quantité disponible pour chaque model </h1>
<?php
// Make a MySQL Connection

$query = "SELECT id,product_name,taille, max_quantity_allowed FROM products  "; 
echo "<center><table border='1'>
<tr>
<th><font color = 'red' >Id</th>
<th><font color = 'red' >Nom du Produit</th>
<th><font color = 'red' />Taille</th>
<th> <font color = 'red' />Quantité disponible</th>


</tr>";
	 
$result = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($result)){
	//echo "Total ". $row['product_name']. " = ". $row['SUM(quantité)'];
	//echo "<br />";
	$id = $row['id'];
	echo "<tr>";
	echo "<td><a href =  inventory_edit.php?pid=$id </a>$id</td>";
    echo "<td>".  $row['product_name']."</td>";
    echo "<td>" . $row['taille'] . "</td>";
	echo "<td>" . $row['max_quantity_allowed'] . "</td>";
	
	
	
    echo "</tr>";
}
echo "</table>";

?>
<?php
include('menu_admin2.php');
?>