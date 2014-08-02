<?php
include ('config.php'); 
include ('menu1.php');
?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Exécuter une requête de sélection pour obtenir letest mes 6 articles
// Connectez-vous à la base de données MySQL 

$dynamicList = "";
$sql = mysql_query("SELECT * FROM products GROUP BY product_name ");
$productCount = mysql_num_rows($sql); // compter le nombre de sortie
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $dynamicList .= '<table width="100%" border="1" cellspacing="1" cellpadding="6">
        <tr>
          <td width="17%" valign="top"><a href="product.php?id=' . $id . '"><img style="border:#666 1px solid;" src="inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="77" height="102" border="1" /></a></td>
          <td width="83%" valign="top">' . $product_name . '<br />
            ' . $price . '&euro;<br />
            <a href="product.php?id=' . $id . '"> Details Produit</a></td>
        </tr>
      </table>';
    }
} else {
	$dynamicList = "Nous n'avons pas encore de produits figurant dans notre magasin ";
}
mysql_close();
?>

    <td width="35%" valign="top"><h3>Catalogue</h3>
      <p><center><?php echo $dynamicList; ?></center></br>
        </p>
    <?php
include ('menu2.php');
?>

    