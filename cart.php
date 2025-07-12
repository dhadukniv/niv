<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cart</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<div class="cart-container">
  <h1>Cart : <?= count($cart) ?> Items</h1>
  <hr>
  <?php foreach ($cart as $item): 
    $itemTotal = $item['price'] * $item['quantity'];
    $total += $itemTotal;
    $discountAmount = $item['original_price'] - $item['price'];
  ?>
  <div class="cart-item">
    <img src="<?= $item['image'] ?>" width="80">
    <div>
      <h3><?= $item['name'] ?></h3>
      <p>₹<?= $item['price'] ?> <del>₹<?= $item['original_price'] ?></del> <span style="color:red"><?= $item['discount'] ?> Off</span></p>
      <p>Size: Free Size</p>
      <p>Qty: <?= $item['quantity'] ?></p>
    </div>
  </div>
  <hr>
  <?php endforeach; ?>

  <div class="cart-summary">
    <h3>Price Detail</h3>
    <p>Order Sub-total: ₹<?= number_format($total, 2) ?></p>
    <p>Product Discount on MRP: -₹<?= number_format(array_sum(array_map(fn($i) => ($i['original_price'] - $i['price']), $cart)), 2) ?></p>
    <p>Estimated Shipping: ₹0.00</p>
    <h3>Grand Total: ₹<?= number_format($total, 2) ?></h3>
  </div>

  <button onclick="location.href='shop.html'">CONTINUE SHOPPING</button>
  <button>PROCEED TO CHECKOUT</button>
</div>

</body>
</html>
