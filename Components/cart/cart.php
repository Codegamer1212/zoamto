<?php
include '../../connection.php';

$db = new DatabaseConnection();
$conenect = $db->connect();
$userid = $_SESSION['user_id'];
$data = $db->Selectcart($userid);

if (isset($_POST['quantity']) && isset($_POST['cart_id'])) {
  $quantity = $_POST['quantity'];
  $cart_id = $_POST['cart_id'];
  $quant = $db->updateCartItemsQuantities($cart_id, $quantity);
  header('location:cart.php');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="cart.css">
  <title>Document</title>
</head>

<body>

  <div class="cart-container">
    <h1>Shopping Cart</h1>
    <table id="cart-table">
      <thead>
        <tr>
          <th>Item</th>
          <th>Name</th>
          <th>Quantity</th>
          <th> Unit Per Price</th>
          <th>shipping</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <form action="" method="post">
          <?php foreach ($data as $value) : ?>
            <tr id="<?php echo $value['cart_id'] ?>">
              <td><img class="cartiamge" src="../reasturant/menuimages/<?php echo $value['product_image'] ?>" alt=""></td>
              <td><?php echo $value['item_name'] ?></td>
              <td>
                <input type="hidden" name="cart_id[]" value="<?php echo $value['cart_id']; ?>">
                <button class="minus-btn">-</button>
                <span class="quantity">
                  <input type="text" name="quantity[]" value="<?php echo $value['quantity'] ?>" min="1" readonly></span>
                <button class="plus-btn">+</button>
              </td>
              <td><?php echo $value['price'] ?></td>
              <td><?php echo $value['shipping'] ?></td>
              <td><?php $priceofall = $value['price'] * $value['quantity'];
                  echo $value['shipping'] +  $priceofall; ?></td>
              <td><button class="delete-btn" id="<?php echo $value['cart_id'] ?>"><i class="fa-solid fa-xmark"></i></button></td>

            </tr>
          <?php endforeach; ?>


      </tbody>
    </table>
    <div class="buttonaction">
      <button id="continue-btn"><a href="../mainscreen/mainscreen.php">Continue Shopping </a></button>
      <div class="sidebutton">
        <button id="update-btn" type="submit">Update Cart</button>
        <button id="order-btn"><a href="../order/order.php">Order</a></button>
      </div>
    </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="cart.js"></script>
</body>

</html>