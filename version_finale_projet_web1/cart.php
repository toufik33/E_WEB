
<?php
include('config.php');
?>
<?php
include ('menu1.php');
?>
<?php


error_reporting(E_ALL);
ini_set('display_errors', '1');

?>
<?php



	if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
$size = $_POST['size'];
$kaka = $_SESSION['size'];
$wasFound = false;
$i = 0;

if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
   
$_SESSION["cart_array"] = array(1 => array("item_id" => $pid, "size" => $size, "quantity" => 0));
} else {

foreach ($_SESSION["cart_array"] as $each_item) { 
     $i++;
     while (list($key, $value) = each($each_item)) {
 
if ($key == "item_id" && $value == $pid){
if ($each_item['size'] == $size){
   
 
 array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "size" => $size, "quantity" => $each_item['quantity'] + 1)));
 $wasFound = true;
 }} 
     } 
      } 
  
  if ($wasFound == false) {
  array_push($_SESSION["cart_array"], array("item_id" => $pid,"size" => $size, "quantity" => 1));
  }
}
header("location: Cart.php"); 
    exit();
}
?>
<?php 

if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    unset($_SESSION["cart_array"]);
unset($_SESSION["tradesrgr"]);     
unset($_SESSION['amount']);    
}
?>
<?php 

if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "") {
    
	
$item_to_adjust = $_POST['item_to_adjust'];
$max = $_POST['max_quantity'];
$size = $_POST['size'];
$quantity = $_POST['quantity'];
$quantity = preg_replace('#[^0-9]#i', '', $quantity); 
if($quantity > $max){
        $quantity = $max;   
    }
    if($quantity < 1){
        $quantity = 0;   
    }
$i = 0;
foreach ($_SESSION["cart_array"] as $each_item) { 
     $i++;
     while (list($key, $value) = each($each_item)) {
 if ($key == "item_id" && $value == $item_to_adjust) {
  if ($each_item['size'] == $size){
 
 array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "size" => $size, "quantity" => $quantity)));
 } 
     } 
} 
}
}
?>
<?php 

if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
   
  $key_to_remove = $_POST['index_to_remove'];
if (count($_SESSION["cart_array"]) <= 1) {
unset($_SESSION["cart_array"]);
} else {
unset($_SESSION["cart_array"]["$key_to_remove"]);
sort($_SESSION["cart_array"]);
}
}
?>

 
<?php 



$note="";
$cartOutput = "";
$cartTotal = "";
$pp_checkout_btn = '';
$product_id_array = '';
$amount='';

if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Votre panier est vide</h2>";
} else {
	
	$pp_checkout_btn .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="khellafzirem910@hotmail.com">';
	
	$i = 0; 
    foreach ($_SESSION["cart_array"] as $each_item) { 
		$item_id = $each_item['item_id'];
		$sql = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1");
		if ($row = mysql_fetch_array($sql)) {
			$product_name = $row["product_name"];
			$price = $row["price"];
			$details = $row["details"];
			//$max_quantity = $row["max_quantity_allowed"];
			//$product_name = $_SESSION['$product_name'];
	  
	  
		}
		
			//foreach ($_SESSION["cart_array"] as $taille) {
          $sql1= mysql_query("SELECT max_quantity_allowed  FROM products WHERE  product_name = '$product_name' and taille = '".$each_item['size']."'");
	      if ($row = mysql_fetch_array($sql1)) {
	       $max_quantity = $row['max_quantity_allowed'];}
		  else $max_quantity = 0;
	  
	   //echo $max_quantity;
	   //echo $each_item['size'];
	   
	  // else echo "kaka";
	  //}
		
		$pricetotal = $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		setlocale(LC_MONETARY, "en_EUR");
        
		
		$x = $i + 1;
		$pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $product_name . '">
        <input type="hidden" name="amount_' . $x . '" value="' . $price . '">
		<input type="hidden" name="on0_' . $x . '" value="taille"> 
        <input type="hidden" name="os0_' . $x . '" value="' . $each_item['size'] . '">
        <input type="hidden" name="quantity_' . $x . '" value="' . $each_item['quantity'] . '">  ';
		
		$product_id_array .= "$item_id-".$each_item['quantity'].","; 
		
		
		
		
		
		$cartOutput .= "<tr>";
		$cartOutput .= '<td><a href="product.php?id=' . $item_id . '">' . $product_name . '</a><br /><img src="inventory_images/' . $item_id . '.jpg" alt="' . $product_name. '" width="40" height="52" border="1" /></td>';
		//$cartOutput .= '<td>' . $details . '</td>';
		$cartOutput .= '<td>' . $price . '&euro;</td>';
		$cartOutput .= '<td><form action="Cart.php" method="post">
                        <input name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
                        <input name="adjustBtn' . $item_id . '" type="submit" value="Changer" />
						Disponible:' . $max_quantity . '
                        <input name="item_to_adjust" type="hidden" value="' . $item_id . '" />
						<input name="max_quantity" type="hidden" value="' . $max_quantity . '" />
                        <input name="size" type="hidden" value="' . $each_item['size'] . '" />
                        </form></td>';
		$cartOutput .= '<td>' . $each_item['size'] . '</td>';
		
		//$cartOutput .= '<td>' . $each_item['quantity'] . '</td>';
		$cartOutput .= '<td>' . $pricetotal . '&euro;</td>';
		$cartOutput .= '<td><form action="cart.php" method="post"><input name="deleteBtn' . $item_id . '" type="submit" value="X" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form></td>';
		$cartOutput .= '</tr>';
		$i++; 
    } 
	
	
	
	
// code promotion (FMIN223)

if ($cartTotal < 200){

unset($_SESSION["tradesrgr"]);
$_SESSION['amount']="";
}

if(isset($_SESSION['tradesrgr'])){

$cartTotal=$cartTotal-20.00;
$amount=20.00;
}

elseif (isset($_POST['voucher'])){
$coupon=$_POST['voucher'];
$newVoucher = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["voucher"]);

if ($cartTotal < 200){

$note="<div align='center' class='RedMessage'><br/>Vous n'avez pas assez dans votre panier Pour béneficier de la Remise<br/></div>";
}

elseif($coupon!="FMIN223" ){

$note="<div align='center' class='RedMessage'> Désolé ce  coupon est invalide <br/> S'il vous plaît essayez a nouveau ou  contacter nous si vous rencontrez des problèmes<br/></div>";
}

else{
$cartTotal=$cartTotal-20.00;

$amount=20;
//echo $cartTotal;
$_SESSION['amount']=$amount;
$_SESSION['tradesrgr']=$coupon;

}
}




	setlocale(LC_MONETARY, "en_EUR");
	
   
	$cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'> Total : ".$cartTotal." &euro; </div>";
    
	$pp_checkout_btn .= '<input type="hidden" name="custom" value="' . $product_id_array . '">
	<input type="hidden" name="notify_url" value="https://localhost/storescripts/my_ipn.php">
	<input type="hidden" name="return" value="https://localhost/checkout_complete.php">
	<input type="hidden" name="discount_amount_cart" value="' . $amount . '">   
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="cbt" value="Return to The Store">
	<input type="hidden" name="cancel_return" value="https://localhost/paypal_cancel.php">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="currency_code" value="EUR">
	<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">
	</form>';
	
	
}

?>


 <center><a href="cart.php?cmd=emptycart" title="supprimer votre panier "> Vider panier   </a></center>

<br />
    <table width="100%" border="5" cellspacing="5" cellpadding="6">
      <tr>
        <td width="18%" bgcolor="#C5DFFA"><strong>Produit</strong></td>
        
        <td width="10%" bgcolor="#C5DFFA"><strong>Prix<strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Quantité</strong></td>
		<td width="9%" bgcolor="#C5DFFA"><strong>Taille</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Total</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Supprimer</strong></td>
		
      </tr>
     <?php echo $cartOutput; ?>
     <!-- <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> -->
    </table>
    <?php echo $cartTotal; ?>
    





    <br />
	<center><form id="form1" name="form1" method="post" action="">
Entrer code Promos : <input type="text" name="voucher" id="voucher" />
<input type="submit" name="button" id="button" value="valider" />
</form>
     <?php echo $note; ?> 
<?php
$url='/espace membres';
if(isset($_SESSION['username']))
 echo $pp_checkout_btn; 
 
        
 ?>
 <?php
    if(isset($_SESSION['cart_array']))
    echo "<center><a href='commande.php'title='Enregistrer votre commande'> <img src='/images/enregistrer_panier.jpg' alt='valider votre commande' /></a></center>";
	?>
	
	  
	
	  
<?php
include ('menu2.php');
?>
