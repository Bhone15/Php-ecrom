<?php
session_start();
require('./config/config.php');
if ($_POST) {
  $id = $_POST['id'];
  $qty = $_POST['qty'];
  // $stmt = $pdo->prepare("SELECT * FROM products WHERE id=" . $id);
  // $stmt->execute();
  // $result = $stmt->fetchAll();
  if (isset($_SESSION['cart']['id' . $id])) {
    $_SESSION['cart']['id' . $id] += $qty;
  } else {
    $_SESSION['cart']['id' . $id] = $qty;
  }
  $url = $_SERVER['HTTP_REFERER'];
  echo "<script>
    window.location.href = '$url';
  </script>";
  // header('Location: ./productDetail.php?id=' . $id);
}
