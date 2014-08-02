<?php
include('config.php');
?>
<?php
include ('menu1.php');
?>



<?php

 if(isset($_SESSION['username'])){
$quantité='';
$taille='';
$reste = '';

$_SESSION['taille']=$taille;

$_SESSION['username']=$username;
$i=0;
    foreach ($_SESSION["cart_array"] as $each_item) { 
		$item_id = $each_item['item_id'];
		$sql = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1");
		while ($row = mysql_fetch_array($sql)) {
			$product_name = $row["product_name"];
			$price = $row["price"];
			$details = $row["details"];
			
			
			$quantité = $each_item['quantity'];
            
			$taille = $each_item['size'];
			
	        $max_quantity = $row["max_quantity_allowed"];
            $reste = ($max_quantity - $quantité);
		
			 if ($max_quantity > 0)
			 {
			 mysql_query("INSERT INTO transactions  VALUES('','$product_name','$price','$quantité','$taille','$username','enregistrée',NOW())");
            
			 mysql_query("update products set max_quantity_allowed = '$reste'  where id = '$item_id' and size ='$taille' ");
			 }
			 else echo " produit n'existe pas actuelement dans le stock";
			 
			}
}	

}	

	//else echo "<a href='/espace membres/connexion.php'> <H4>Connectez vous pour contunuer </H4></a>";
	 else echo "<a href='/espace membres/connexion.php' title= 'Connectez vous pour enregistrer votre commande'> Connexion </a>" ;
	 echo $taille;
 ?>
 <?php

include ('menu2.php');
?>
 
 
 
 