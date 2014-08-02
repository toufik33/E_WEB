<?php
include('config.php');
?>
<?php
include ('menu1.php');

?>
<script>
function redirection(page)
  {window.location=page;}
setTimeout('redirection("affiche_commande.php")',10000);
</script>


<?php

 if(isset($_SESSION['username'])){
$quantité='';
$taille='';

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
			
	        $sql1= mysql_query("SELECT max_quantity_allowed  FROM products WHERE  product_name = '$product_name' and taille = '".$each_item['size']."'");
	      while ($row = mysql_fetch_array($sql1)) {
	       $max_quantity = $row['max_quantity_allowed'];
	  
	   //echo $max_quantity;
	   //echo $each_item['size'];
	   }
		   }
            $reste = ($max_quantity - $quantité);
		if ($quantité <= 0){ echo " vous devez ajuter votre quantité";}
			else if ($max_quantity > 0 )
			 {
			 mysql_query("INSERT INTO transactions  VALUES('','$product_name','$price','$quantité','$taille','$username','enregistrée',NOW())");
          
			
			 mysql_query("update products set max_quantity_allowed = '$reste'  where product_name = '$product_name' and taille = '$taille'");
			 
			 echo " <p>Merci pour votre confiance ,Vous pouvez voir votre commande dans votre espace membres</p>";
			  }         
			 
			 else echo " Désolé le produit '$product_name'  n'est pas disponible pour le moment";
			 
			
			
	
unset($_SESSION["cart_array"]);

//header ('location: affiche_commande.php');
}
}	

	//else echo "<a href='/espace membres/connexion.php'> <H4>Connectez vous pour contunuer </H4></a>";
	 else echo "vous devez etre connecter pour enregistrer votre commande","<a href='/espace membres/connexion.php' title= 'Connectez vous pour enregistrer votre commande'> Connexion </a>" ;
 ?>
 <?php

include ('menu2.php');
?>
 
 