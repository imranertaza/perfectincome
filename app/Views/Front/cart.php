<?php
session_start();
@$client_id = $_SESSION['id'];
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 1 (if user attempts to add something to the cart from the product page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['pid'])) {
    print $pid = $_GET['pid'];
	$wasFound = false;
	$i = 0;
	// If the cart session variable is not set or cart array is empty
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
	    // RUN IF THE CART IS EMPTY OR NOT SET
		$_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => 1));
	} else {
		// RUN IF THE CART HAS AT LEAST ONE ITEM IN IT
		foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $pid) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + 1)));
					  $wasFound = true;
				  } // close if condition
		      } // close while loop
	       } // close foreach loop
		   if ($wasFound == false) {
			   array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => 1));
		   }
	}
	header("Location: cart_page.html");
	exit;
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 2 (if user chooses to empty their shopping cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    unset($_SESSION["cart_array"]);
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 3 (if user chooses to adjust item quantity)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "") {
    // execute some code
	$item_to_adjust = $_POST['item_to_adjust'];
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
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $quantity)));
				  } // close if condition
		      } // close while loop
	} // close foreach loop
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 4 (if user wants to remove an item from cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
    // Access the array and run code to remove that array index
 	$key_to_remove = $_POST['index_to_remove'];
	if (count($_SESSION["cart_array"]) <= 1) {
		unset($_SESSION["cart_array"]);
	} else {
		unset($_SESSION["cart_array"]["$key_to_remove"]);
		sort($_SESSION["cart_array"]);
	}
	header("Location: index.php?page=cart");
	exit;
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 5  (render the cart for the user to view on the page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$cartOutput = "";
$cartTotal = "";
$pp_checkout_btn = '';
$product_id_array = '';
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
} else {
	// Start PayPal Checkout Button
	// For the test url : https://www.sandbox.paypal.com/cgi-bin/webscr
	// Live URL : https://www.paypal.com/cgi-bin/webscr
	//$select_paypal = mysql_fetch_array(mysql_query("SELECT value FROM `settings` WHERE `id` = 1"));
	$select_paypal = $this->db->query("SELECT value FROM `settings` WHERE `id` = 1")->row();
	$pp_checkout_btn .= '<form id = "paypal_checkout" action = "https://www.sandbox.paypal.com/cgi-bin/webscr" method = "post">
    <input name = "cmd" value = "_cart" type = "hidden">
    <input name = "upload" value = "1" type = "hidden">
    <input name = "no_note" value = "0" type = "hidden">
    <input name = "bn" value = "PP-BuyNowBF" type = "hidden">
    <input name = "tax" value = "0" type = "hidden">
    <input name = "rm" value = "2" type = "hidden">
	
	<input name = "business" value = "'.$select_paypal['value'].'" type = "hidden">
    <input name = "handling_cart" value = "0" type = "hidden">
    <input name = "currency_code" value = "USD" type = "hidden">
    <input name = "lc" value = "US" type = "hidden">';

	// Start the For Each loop
	$i = 0; 
    foreach ($_SESSION["cart_array"] as $each_item) { 
		$item_id = $each_item['item_id'];
		$sql = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1");
		while (@$row = mysql_fetch_array($sql)) {
			$product_name = $row["product_name"];
			$price = $row["price"];
			$details = $row["details"];
			$product_image = $row['product_image'];
		}
		$pricetotal = $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		setlocale(LC_MONETARY, "en_US");
        //$pricetotal = money_format("%10.2n", $pricetotal);
		// Dynamic Checkout Btn Assembly
		$x = $i + 1;
		$pp_checkout_btn .= '<div id = "item_1" class = "itemwrap">
			<input name = "item_name_' . $x . '" value = "' . $product_name . '" type = "hidden">
			<input name = "quantity_' . $x . '" value = "' . $each_item['quantity'] . '" type = "hidden">
			<input name = "amount_' . $x . '" value = "' . $price . '" type = "hidden">
    	</div>';
		
		// Create the product array variable
		$product_id_array .= "$item_id-".$each_item['quantity'].","; 
		// Dynamic table row assembly
		$cartOutput .= "<tr>";
		$cartOutput .= '<td><a href="product.php?id=' . $item_id . '">' . $product_name . '</a><br /><img src="../admin/uploads/' . $product_image . '" alt="' . $product_name. '" width="40" height="52" border="1" /></td>';
		$cartOutput .= '<td>' . $details . '</td>';
		$cartOutput .= '<td>$' . $price . '</td>';
		$cartOutput .= '<td><form action="index.php?page=cart" method="post">
		<input name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
		<input name="adjustBtn' . $item_id . '" type="submit" value="Update" />
		<input name="item_to_adjust" type="hidden" value="' . $item_id . '" />
		</form></td>';
		//$cartOutput .= '<td>' . $each_item['quantity'] . '</td>';
		$cartOutput .= '<td>$' . $pricetotal . '</td>';
		$cartOutput .= '<td><form action="index.php?page=cart" method="post"><input name="deleteBtn' . $item_id . '" type="submit" value="X" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form></td>';
		$cartOutput .= '</tr>';
		$i++; 
    } 
	
	
	//$pp_checkout_btn .= '<input type="hidden" name="currency_code" value="USD">
//<input type="hidden" name="button_subtype" value="services">
//<input type="hidden" name="no_note" value="0">';
	
	// This is for shipping section
	$y = $x+1;
	$shipping = ($cartTotal * $shipping_cost_percent)/100;
	$_SESSION['shipping'] = $shipping;

		
	$pp_checkout_btn .= '<input type="hidden" name="tax_rate" value="0">
	<input name = "shipping_1" value = "'.$shipping.'" type = "hidden">';
	
	
	setlocale(LC_MONETARY, "en_US");
    //$cartTotal = money_format("%10.2n", $cartTotal);
	$cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total :".$cartTotal." USD</div>";
	
		
    // Finish the Paypal Checkout Btn
	/*$pp_checkout_btn .= '<input type="hidden" name="custom" value="' . $product_id_array . ' | '.$client_id.'">
	<input name="notify_url" value="http://localhost/ecommerce_admin/watch_store/index.php?page=ipn" type="hidden">
	<input type="hidden" name="return" value="http://localhost/ecommerce_admin/watch_store/index.php?page=complete_payment">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="cbt" value="Return to The Store">
	<input type="hidden" name="cancel_return" value="http://localhost/ecommerce_admin/watch_store/index.php?page=cancle_payment">
	<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>';*/
	
	
	$pp_checkout_btn .= '<input name = "return" value = "http://localhost/ecommerce_admin/watch_store/index.php?page=complete_payment" type = "hidden">
	<input name="notify_url" value="http://localhost/ecommerce_admin/watch_store/index.php?page=ipn" type="hidden">
    <input name = "cbt" value = "Return to Store Back" type = "hidden">
    <input name = "cancel_return" value = "http://localhost/ecommerce_admin/watch_store/index.php?page=cancle_payment" type = "hidden">
    <input name = "custom" value = "' . $product_id_array . ' | '.$client_id.'" type = "hidden">
	<input id = "ppcheckoutbtn" value = "Checkout" class = "button" type = "submit">
	</form>';
}
?>


  <div id="pageContent">
    <div style="margin:24px; text-align:left;">
	
    <br />
    <?php //if($addr != 1) { ?>
    <table width="100%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <td width="18%" bgcolor="#C5DFFA"><strong>Product</strong></td>
        <td width="45%" bgcolor="#C5DFFA"><strong>Product Description</strong></td>
        <td width="10%" bgcolor="#C5DFFA"><strong>Unit Price</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Quantity</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Total</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Remove</strong></td>
      </tr>
     <?php echo $cartOutput; ?>
    </table>
    <?php  //}else { print $addr_form; } ?>
    <?php echo $cartTotal; ?>
    <br />
	<br />
    <div>Your Total Shipping Cost Is: $<?php if(!empty($shipping)) { print $shipping; }else { print 0; } ?></div>
    <br />
    <br />
<?php if(isset($_SESSION['username'])) { echo $pp_checkout_btn; }else { ?>
<a href="index.php?page=register&from=cart" class="button">Buy Now!</a>
<?php } ?>
    <br />
    <br clear="all" />
    <a href="index.php?page=cart&cmd=emptycart">Click Here to Empty Your Shopping Cart</a>
    </div>
   <br />
  </div>