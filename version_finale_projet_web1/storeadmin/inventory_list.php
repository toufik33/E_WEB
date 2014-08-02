<?php 
session_start();
include "config.php";
include"menu_admin1.php";

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

if (isset($_GET['deleteid'])) {
	echo 'Do you really want to delete product with ID of ' . $_GET['deleteid'] . '? <a href="inventory_list.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="inventory_list.php">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {
	
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysql_query("DELETE FROM products WHERE id='$id_to_delete' LIMIT 1") or die (mysql_error());
	
    $pictodelete = ("../inventory_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 

if (isset($_POST['product_name'])) {
	
    $product_name = mysql_real_escape_string($_POST['product_name']);
	$price = mysql_real_escape_string($_POST['price']);
	$category = mysql_real_escape_string($_POST['category']);
	$subcategory = mysql_real_escape_string($_POST['subcategory']);
	$details = mysql_real_escape_string($_POST['details']);
	
	$max_quantity_allowed = mysql_real_escape_string($_POST["max_quantity_allowed"]);
	$taille = mysql_real_escape_string($_POST["taille"]);
	
	$sql = mysql_query("SELECT id FROM products WHERE product_name='$product_name' LIMIT 1");
	$productMatch = mysql_num_rows($sql); 
    //if ($productMatch > 0) {
		//echo 'Désolé vous avez essayé de placer un double "Product Name" dans le catalogue, <a href="inventory_list.php">click here</a>';
		//exit();
	//}
	
	$sql = mysql_query("INSERT INTO products (product_name, price, details, category, subcategory, date_added,max_quantity_allowed,taille) 
        VALUES('$product_name','$price','$details','$category','$subcategory',now(),'$max_quantity_allowed','$taille')") or die (mysql_error());
     $pid = mysql_insert_id();
	
	$newname = "$pid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 
$product_list = "";
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC");
$productCount = mysql_num_rows($sql); 
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $product_list .= "Product ID: $id - <strong>$product_name</strong> - $price - <em>Added $date_added</em> &nbsp; &nbsp; &nbsp; <a href='inventory_edit.php?pid=$id'>éditer</a> &bull; <a href='inventory_list.php?deleteid=$id'>Supprimer</a><br />";
    }
} else {
	$product_list = "Vous n'avez pas encore de produits figurant dans votre magasin ";
}
?>

<div align="center" id="mainWrapper">
  
  <div id="pageContent"><br />
    <div align="right" style="margin-right:32px;"><a href="inventory_list.php#inventoryForm"> Ajouter Produit</a></div>
<div align="left" style="margin-left:24px;">
      <h2>Inventaire</h2>
      <?php echo $product_list; ?>
    </div>
    <hr />
    <a name="inventoryForm" id="inventoryForm"></a>
    <h3>
    &darr; Ajouter un nouveau Produit &darr;
    </h3>
    <form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right">Nom Produit </td>
        <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" />
        </label></td>
      </tr>
      <tr>
        <td align="right">prix </td>
        <td><label>
      
          <input name="price" type="text" id="price" size="12" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Categorie</td>
        <td><label>
          <select name="category" id="category">
          <option value="homme">Homme</option>
		  <option value="femme">Femme</option>
		  <option value="enfant">Enfant</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="right">Subcategorie</td>
        <td><select name="subcategory" id="subcategory">
        <option value=""></option>
          <option value="nike">Nike</option>
          <option value="reebok">Reebok</option>
          <option value="puma">Puma</option>
		  <option value="adidas">adidas</option>
		  <option value="kappa">kappa</option>
		  <option value="coq">le coq sportif </option>
          </select></td>
      </tr>
      <tr>
        <td align="right"> Details Produit </td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"></textarea>
        </label></td>
      </tr>
	  <tr>
            <td> Quantité</td>
            <td><input name="max_quantity_allowed" id="max_quantity_allowed" size="12" />&nbsp;&nbsp;&bull;Use 999 for unlimited</td>
        </tr>
      <tr>
	  <tr>
            <td> Taille</td>
            <td><input name="taille" id="taille" size="12" /></td>
        </tr>
      <tr>
        <td align="right"> Image Produit</td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="Add This Item Now" />
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
 ?>