<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = [
        'name' => $_POST['name'],
        'image' => $_POST['image'],
        'price' => $_POST['price'],
        'original_price' => $_POST['original_price'],
        'discount' => $_POST['discount'],
        'quantity' => 1
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if item already exists
    $exists = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['name'] == $item['name']) {
            $cartItem['quantity']++;
            $exists = true;
            break;
        }
    }

    if (!$exists) {
        $_SESSION['cart'][] = $item;
    }

    if (isset($_POST['buy_now'])) {
        header("Location: cart.php");
    } else {
        header("Location: shop.html");
    }
    exit();
}
