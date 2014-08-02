<?php
include ('config.php'); 
include ('menu1.php');
include ('fonctions.php');
?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Exécuter une requête de sélection pour obtenir letest mes 6 articles
// Connectez-vous à la base de données MySQL 

$nombre = 10;  

// si limite n'existe pas on l'initialise à zéro

if (!$limite) $limite = 0; 

// on cherche le nom de la page.    

$path_parts = pathinfo($_SERVER['PHP_SELF']);

$page = $path_parts["basename"];

$dynamicList = "";
//$sql = mysql_query("SELECT count(id) from products ");
$sql = mysql_query("SELECT count(DISTINCT product_name) FROM products  WHERE subcategory =	'puma'  ");
$row = mysql_fetch_row($sql);
$total = $row[0];

$sql = mysql_query("SELECT * FROM products   GROUP BY product_name ");


             
			 


$verifLimite= verifLimite($limite,$total,$nombre); 

// si la limite passée n'est pas valide on la remet à zéro

if(!$verifLimite)  {

    $limite = 0;

}
$sql ='SELECT * FROM products WHERE subcategory = "puma" GROUP BY product_name ASC limit '.$limite.','.$nombre;

$sql = mysql_query($sql)  or die ('Erreur : '.mysql_error() );
$productCount = mysql_num_rows($sql); // compter le nombre de sortie
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));






			 if($total) {
			 
			 
			 
			 $dynamicList .= '<table width="70%" border="1" cellspacing="6" cellpadding="6">
			 
			 
        <tr>
          <td bgcolor="#99CCCC" width="17%" valign=""><a href="product.php?id=' . $id . '">
		  <img style="border:#666 1px solid;" src="inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="77" height="102" border="1" /></a></td>
          <td width="83%" valign="">' . $product_name . '<br />
            ' . $price . '&euro;<br />
            <a href="product.php?id=' . $id . '"> Details Produit</a></td>
        </tr>
      </table>';
    }
	}
} else {
	$dynamicList = "Nous n'avons pas encore de produits figurant dans notre magasin ";
}




mysql_close();
?>

    <center><h2><em><u><font color = 'red' >Catégorie Puma  </font></h2>
      <center><?php echo $dynamicList; ?></center>
        
		<?php
		if($total > $nombre) {

    // affichage des liens vers les pages

    affichePages($nombre,$page,$total);

    // affichage des boutons

    //displayNextPreviousButtons($limite,$total,$nombre,$page);

}
		?>
		
    <?php
include ('menu2.php');
?>
