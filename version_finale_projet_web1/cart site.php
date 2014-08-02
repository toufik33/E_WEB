<?php
include "config.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 1 (if user attempts to add something to the cart from the product page)
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
$size = $_POST['size'];
$wasFound = false;
$i = 0;
// If the cart session variable is not set or cart array is empty
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
   // RUN IF THE CART IS EMPTY OR NOT SET
$_SESSION["cart_array"] = array(1 => array("item_id" => $pid, "size" => $size, "quantity" => 1));
} else {
// RUN IF THE CART HAS AT LEAST ONE ITEM IN IT
foreach ($_SESSION["cart_array"] as $each_item) { 
     $i++;
     while (list($key, $value) = each($each_item)) {
 
if ($key == "item_id" && $value == $pid){
if ($each_item['size'] == $size){
   
 // That item is in cart already so let's adjust its quantity using array_splice()
 array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "size" => $size, "quantity" => $each_item['quantity'] + 1)));
 $wasFound = true;
 }} // close if condition
     } // close while loop
      } // close foreach loop
  
  if ($wasFound == false) {
  array_push($_SESSION["cart_array"], array("item_id" => $pid,"size" => $size, "quantity" => 1));
  }
}
header("location: Cart.php"); 
    exit();
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 2 (if user chooses to empty their shopping cart)
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    unset($_SESSION["cart_array"]);
unset($_SESSION["tradesrgr"]);     //unset all sessions if cart is empty
unset($_SESSION['amount']);    //unset all sessions if cart is empty
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 3 (if user chooses to adjust item quantity)
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "") {
    // execute some code
$item_to_adjust = $_POST['item_to_adjust'];
$size = $_POST['size'];
$quantity = $_POST['quantity'];
$quantity = preg_replace('#[^0-9]#i', '', $quantity); // filter everything but numbers
if ($quantity >= 100) { $quantity = 99; }
if ($quantity < 1) { $quantity = 1; }
if ($quantity == "") { $quantity = 1; }
$i = 0;
foreach ($_SESSION["cart_array"] as $each_item) { 
     $i++;
     while (list($key, $value) = each($each_item)) {
 if ($key == "item_id" && $value == $item_to_adjust) {
  if ($each_item['size'] == $size){
 // That item is in cart already so let's adjust its quantity using array_splice()
 array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "size" => $size, "quantity" => $quantity)));
 } // close if condition
     } // close while loop
} // close foreach loop
}
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 4 (if user wants to remove an item from cart)
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
    // Access the array and run code to remove that array index
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 5  (render the cart for the user to view on the page)
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Connect to the MySQL database  


$note="";
$Empty = "";
$cartOutput = "";
$cartTotal = "";
$imageName = "";
$pid = "";
$ProductName = "";
$price = "";
$pp_checkout_btn = '';
$product_id_array = '';
$amount='';

if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $Empty = "Your shopping cart is empty<br/>";
} else {
// Start PayPal Checkout Button
$pp_checkout_btn .= '<form action="https://www.paypal.co.uk/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="your_eamil@email.co.uk">';
// Start the For Each loop
$i = 0; 
    foreach ($_SESSION["cart_array"] as $each_item) { 
		$item_id = $each_item['item_id'];
		$sql = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1");
		while ($row = mysql_fetch_array($sql)) {
			$product_name = $row["product_name"];
			$price = $row["price"];
			$details = $row["details"];
			
		}
$pricetotal = $price * $each_item['quantity'];
$cartTotal = $pricetotal + $cartTotal;
setlocale(LC_MONETARY, "en_GB");
        //$pricetotal = money_format("%!4.2n", $pricetotal);
// Dynamic Checkout Btn Assembly
$x = $i + 1;
$pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $ProductName . '">
        <input type="hidden" name="amount_' . $x . '" value="' . $price . '">
<input type="hidden" name="Size_'. $x . '" value="'. $each_item['size'] . '">
        <input type="hidden" name="quantity_' . $x . '" value="' . $each_item['quantity'] . '">  ';
// Create the product array variable
$product_id_array .= "$item_id-".$each_item['quantity'].","; 
// Dynamic table row assembly
$cartOutput .= "<tr>";
$cartOutput .= '<td><img src="files/' . $item_id . '.jpg" alt="' . $ProductName. '" width="60" height="72" border="1" /></td>';
$cartOutput .= '<td>' . $pid . '</td>';
$cartOutput .= '<td>' . $ProductName .'</td>';
$cartOutput .= '<td>' . $each_item['size'] .'</td>';
$cartOutput .= '<td>£'. $price . '</td>';
$cartOutput .= '<td><form action="Cart.php" method="post">
<input name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
<input name="adjustBtn' . $item_id . '" type="submit" value="change" />
<input name="item_to_adjust" type="hidden" value="' . $item_id . '" />
<input name="size" type="hidden" value="' . $each_item['size'] . '" />
</form></td>';
//$cartOutput .= '<td>' . $each_item['quantity'] . '</td>';
$cartOutput .= '<td>£'.$pricetotal.'</td>';
$cartOutput .= '<td><form action="Cart.php" method="post"><input name="deleteBtn' . $item_id . '" type="submit" value="X" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form></td>';
$cartOutput .= '</tr>';
$i++; 
    } 

setlocale(LC_MONETARY, "en_GB");
    //$cartTotal = money_format("%!10.2n", $cartTotal);
$cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total : £".$cartTotal." GBP</div>";
    // Finish the Paypal Checkout Btn
$pp_checkout_btn .= '<input type="hidden" name="custom" value="' . $product_id_array . '">
<input type="hidden" name="notify_url" value="https://www.blockdesigns.co.uk/storescripts/my_ipn.php">
<input type="hidden" name="return" value="https://www.blockdesigns.co.uk/checkout_complete.php">
<input type="hidden" name="discount_amount_cart" value="' . $amount . '">   //This sends the variable to the paypal cart and was the issue I had before
<input type="hidden" name="rm" value="2">
<input type="hidden" name="cbt" value="Return to The Store">
<input type="hidden" name="cancel_return" value="https://www.blockdesigns.co.uk/paypal_cancel.php">
<input type="hidden" name="lc" value="GB">
<input type="hidden" name="currency_code" value="GBP">
<input type="image" src="http://www.paypal.com/en_GB/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">
</form>';
}
?>



<?php include "menu1.php";?>
<table id="body" cellpadding="0" cellspacing="0" align="center" width="831" border="0">
  <tr>
    <td valign="top" width="119">
  </td>
    <td width="612" valign="top">
      <div class="NewsProductDiv" style="margin:18px; text-align:left;">
    <table width="100%" border="1" align="center" cellpadding="6" cellspacing="0">
      <tr>
        <td width="13%" height="34" bgcolor="#333333"><div align="center" class="style1">Product</div></td>
        <td width="10%" bgcolor="#333333"><div align="center" class="style1">Item pid</div></td>
        <td width="45%" bgcolor="#333333"><div align="center" class="style1">Product Description</div></td>
        <td width="45%" bgcolor="#333333"><div align="center" class="style1">Size</div></td>
        <td width="9%" bgcolor="#333333"><div align="center" class="style1">Price</div></td>
        <td width="9%" bgcolor="#333333"><div align="center" class="style1">Quantity</div></td>
        <td width="10%" bgcolor="#333333"><div align="center" class="style1">Total</div></td>
<td width="9%" bgcolor="#333333"><div align="center" class="style1">Delete</div></td>
     <?php echo $cartOutput;?>
      </tr>
     <!-- <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> -->
    </table>
<?php echo $Empty; ?>
    <?php echo $cartTotal; ?>
    <br />
<div align="right">
<form id="form1" name="form1" method="post" action="">
Enter Voucher Code Here <input type="text" name="voucher" id="voucher" />
<input type="submit" name="button" id="button" value="Submit" />
</form>
      <?php echo $note; ?> 
<?php echo $pp_checkout_btn; ?></div>
<br />
    <br />
    <div>
      <div align="center"><a href="Cart.php?cmd=emptycart">Click Here to Empty Cart</a></div>
    </div>
    </div>
   <br />
    </td>
    <td align="right" valign="top" width="100">&nbsp;</td>
  </tr>
</table>
<table width="831" border="0" align="center" cellpadding="0" cellspacing="0" id="footer">
  <tr>
    <td height="20"></td>
  </tr>
</table>
<!-- include footer on line 42. the copyright is now in white due to CSS so a seperate class needs creating for this to be black -->

