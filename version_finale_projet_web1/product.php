<?php 
include "config.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Vérifiez la variable d'URL est définie et qu'il existe dans la base
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
     
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	// Utilisez cette var pour vérifier pour voir si cet ID existe, si oui alors obtenir le produit
	// details, if no then exit this script and give message why
	$sql = mysql_query("SELECT * FROM products WHERE id='$id' LIMIT 1");
	$productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysql_fetch_array($sql)){ 
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $details = $row["details"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $max_quantity = $row['max_quantity_allowed'];
			 //$size = $row['taille'];
			 
         }
		 
	} else {
		echo "ça n'existe pas.";
	    exit();
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
}


	
	
//echo $taille;

//mysql_close();


?>
<?php
include('menu1.php');
 ?>
	  

 
  <table width="100%" border="1" cellspacing="0" cellpadding="15">
  <tr>
    <td width="19%" valign="top"><img src="inventory_images/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $product_name; ?>" /><br />
      <a href="inventory_images/<?php echo $id; ?>.jpg"target="_blank">Voir l'Image</a></td>
    <td width="81%" valign="top"><h3><?php echo $product_name; ?></h3>
      <p><?php echo "prix:&euro;".$price; ?><br />
	  
	
        <br />
        <?php echo "<strong>Marque :$subcategory </br></br> Catégorie  : $category"; ?> <br />
<br />
        <strong>details:</strong></br><?php echo $details; ?>
		
<h1><em> tailles Disponibles pour ce model: </h1>		
<?php
$sql1 = mysql_query("SELECT * FROM products WHERE product_name='$product_name' ORDER BY taille ");
while ($row = mysql_fetch_array($sql1)){
$taille=$row['taille'];
$max_quantity = $row['max_quantity_allowed'];
if ($max_quantity >0){
echo "<strong><font color = 'red' >$taille</font></strong>","-";}
} 

?>
	
<br /><br>
        
        
        </p>
		<h1><em> Selectionner Taille :</h1>
      <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
		<select name="size" id="size">
 <option value="28" >28</option>
 <option value="30" >30</option>
 <option value="32">32</option>
 <option  value="34">34</option> 
 <option selected value="36" >36</option>
 <option  value="37" >37</option>
 <option  value="38" >38</option>
 <option  value="39" >39</option>
 <option value="40">40</option>
 <option  value="41" >41</option>
 <option value="42" >42</option>
 <option value="44" >44</option>
 <option value="46">46</option>
 </select>
        <input type="submit" name="button" id="button" value="Ajouter au panier" />
      </form>
	  



	  
	
      </td>
    </tr>
</table>
<?php
include('menu2.php');
 ?>
  