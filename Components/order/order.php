<?php
include '../../connection.php';
$db = new DatabaseConnection();
$conenect = $db->connect();

$userid = $_SESSION['user_id'];
$data = $db->Selectcart($userid);

$table = "users";
$userdetails = $db->selectAllUsers($table, $userid);
foreach ($userdetails as $user) {
  $addressParts = explode(',', $user['address']);
}

$table2 = "payment";
$payment = $db->payment($table2);

$totalPrice = 0;
$shippingCharge = 0;
foreach ($data as $value45) {
  $totalPrice += $value45['price'] * $value45['quantity'];
  $shippingCharge += $value45['shipping'];
}
$gstRate = 0.18;
$gstAmount = $totalPrice * $gstRate;

$grandTotal = $totalPrice + $gstAmount + $shippingCharge;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="order.css">
  <title>Document</title>
</head>

<body>
  <form action="order_insert.php" method="post" id="orderForm">
    <div class="container">
      <div class="title">
        <h2>RED FOOD</h2>
      </div>
      <div class="d-flex">
        <div class="from">

          <label>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
            <span class="name"> Name <span class="required">*</span></span>
            <input type="text" name="name" value="<?php echo $user['name'] ?>">
          </label>
          <label>
            <span>Email Address <span class="required">*</span></span>
            <input type="email" name="Email" value="<?php echo $user['email'] ?>">
          </label>
          <label>
            <span> Address <span class="required">*</span></span>
            <input type="text" name="houseadd" value="<?php echo $addressParts[0] ?>" required>
          </label>
          <label>
            <span> City <span class="required">*</span></span>
            <input type="text" name="city" value="<?php echo $addressParts[1] ?>">
          </label>
          <label>
            <span>State <span class="required">*</span></span>
            <input type="text" name="State" value="<?php echo $addressParts[2] ?>">
          </label>
          <label>
            <span>Contry <span class="required">*</span></span>
            <input type="text" name="Contry" value="<?php echo $addressParts[3] ?>">
          </label>
          <label>
            <span>Postcode / ZIP <span class="required">*</span></span>
            <input type="text" name="Postcode" value="<?php echo $addressParts[4] ?>">
          </label>
          <label>
            <span>Phone <span class="required">*</span></span>
            <input type="tel" name="Phone" value="<?php echo $user['phonenumber'] ?>">
          </label>
        </div>

        <div class="orderproduct">
          <div class="Yorder">
            <table>
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody id="productTableBody">
                <?php foreach ($data as $value45) : ?>
                  <tr id="<?php echo $value45['cart_id'] ?>">
                    <td> <?php echo $value45['item_name'] ?></td>
                    <td> <?php echo $value45['quantity'] ?></td>
                    <td>Rs <?php echo $value45['price']; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
              <input type="hidden" name="totalPrice" value="<?php echo number_format($totalPrice, 2); ?>">
              <input type="hidden" name="grandTotal" value="<?php echo number_format($grandTotal, 2); ?>">
              <input type="hidden" name="gst" value="<?php echo number_format($gstAmount, 2); ?>">
              <input type="hidden" name="shippingCharge" value="<?php echo $shippingCharge; ?>">
              <tfoot>
                <tr>
                  <td colspan="2">Total </td>
                  <td id="totalProductPrice">Rs <?php echo number_format($totalPrice, 2); ?></td>
                </tr>
                <tr>
                  <td colspan="2">Shipping</td>
                  <td>Rs <?php echo $shippingCharge ?></td>
                </tr>
                <tr>
                  <td colspan="2">Gst</td>
                  <td>Rs <?php echo number_format($gstAmount, 2); ?></td>
                </tr>
                <tr>
                  <td colspan="2">Grand Total</td>
                  <td id="grandTotal">Rs <?php echo number_format($grandTotal, 2); ?></td>
                </tr>
              </tfoot>
            </table><br>


          </div>
          <div class="placeorderbtn">
            <label for="Payment">Payment Method
              <select name="Payment" id="Payment">
                <option value="0">Select Payment Method</option>
                <?php foreach ($payment as $paymentmethod) : ?>
                  <option value="<?php echo $paymentmethod['payment_id'] ?>" selected><?php echo $paymentmethod['payment_method'] ?></option>

                <?php endforeach; ?>
              </select>
            </label>
            <button type="submit" name="submit" id="placeOrderButton">Place Order</button>
          </div>
         

        </div>
      </div>
    </div>
  </form>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const placeOrderButton = document.getElementById("placeOrderButton");
      const orderForm = document.getElementById("orderForm");

      placeOrderButton.addEventListener("click", function() {

        orderForm.submit();
      });
    });

    
  </script>

</body>

</html>