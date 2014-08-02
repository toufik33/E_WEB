<?php 
session_start();
include "config.php"; 
include "menu_admin1.php";

if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}

$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); 
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); 
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); 

  

$sql = mysql_query("SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1"); 


?>
<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 

if (isset($_POST['product_name'])) {
	
	$pid = mysql_real_escape_string($_POST['thisID']);
    $product_name = mysql_real_escape_string($_POST['product_name']);
	$price = mysql_real_escape_string($_POST['price']);
	$category = mysql_real_escape_string($_POST['category']);
	$subcategory = mysql_real_escape_string($_POST['subcategory']);
	$details = mysql_real_escape_string($_POST['details']);
	$max_quantity_allowed = mysql_real_escape_string($_POST["max_quantity_allowed"]);
	$taille = mysql_real_escape_string($_POST["taille"]);
	
	$sql = mysql_query("UPDATE products SET product_name='$product_name', price='$price', details='$details', category='$category', subcategory='$subcategory',max_quantity_allowed='$max_quantity_allowed', taille='$taille' WHERE id='$pid'");
	if ($_FILES['fileField']['tmp_name'] != "") {
	
	    $newname = "$pid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	}
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 

if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];
    $sql = mysql_query("SELECT * FROM products WHERE id='$targetID' LIMIT 1");
    $productCount = mysql_num_rows($sql); 
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $details = $row["details"];
			 $max_quantity_allowed= $row["max_quantity_allowed"];
			 $taille= $row["taille"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        }
    } else {
	    echo "Sorry dude that crap dont exist.";
		exit();
    }
}
?>

<div align="center" id="mainWrapper">
  
  <div id="pageContent"><br />
    <div align="right" style="margin-right:32px;"><a href="inventory_list.php#inventoryForm">+ Ajouter Produit</a></div>
<div align="left" style="margin-left:24px;">
      <h2>liste Inventaire </h2>
      
    </div>
    <hr />
    <a name="inventoryForm" id="inventoryForm"></a>
    <h3>
    &darr; Editer Produits &darr;
    </h3>
    <form action="inventory_edit.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right">Nom produit </td>
        <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" value="<?php echo $product_name; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Prix produit </td>
        <td><label>
        
          <input name="price" type="text" id="price" size="12" value="<?php echo $price; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Catégorie</td>
        <td><label>
          <select name="category" id="category">
          <option value="Homme">Homme</option>
          <option value="femme">femme</option>
          <option value="enfant">enfant</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="right">Sous-catégorie</td>
        <td><select name="subcategory" id="subcategory">
          <option value="<?php echo $subcategory; ?>"><?php echo $subcategory; ?></option>
          <option value="Nike">Nike</option>
          <option value="Reebock">Reebok</option>
          <option value="Puma">Puma</option>
		  <option value="adidas">adidas</option>
		  <option value="kappa">kappa</option>
		  <option value="coq">le coq sportif </option>
          </select></td>
      </tr>
      <tr>
        <td align="right"> Details Produit</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"><?php echo $details; ?></textarea>
        </label></td>
      </tr>
	  <tr>
            <td> Quantité</td>
            <td><input name="max_quantity_allowed" id="max_quantity_allowed" size="12" value ="<?php echo $max_quantity_allowed; ?>"/></td>
        </tr>
      <tr>
	  <tr>
            <td> Taille</td>
            <td><input name="taille" id="taille" size="12" value ="<?php echo $taille; ?>"/></td>
        </tr>
      <tr>
        <td align="right"> Image produit </td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
          <input type="submit" name="button" id="button" value="Make Changes" />
        </label></td>
      </tr>
    </table>
    </form>
    <br />
  <br />
  </div>
 
</div>
<?php
include('menu_admin2.php');