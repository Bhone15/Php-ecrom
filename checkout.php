<?php
require './config/config.php';
require './header.php';

if (empty($_SESSION['logged_in'])) {
  header('Location: login.php');
} else {
  if ($_POST) {
    $phno = $_POST['phno'];
    $address = $_POST['address'];
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $qty) {
      $id = str_replace('id', '', $key);
      $qtyStmt = $pdo->prepare("SELECT * FROM products WHERE id=" . $id);
      $qtyStmt->execute();
      $qResult = $qtyStmt->fetch(PDO::FETCH_ASSOC);
      $total += $qResult['price'] * $qty;
      $updateQty = $qResult['quantity'] - $qty;

      if ($updateQty >= 0) {
        $stmt = $pdo->prepare("UPDATE products SET quantity=:qty WHERE id=:pid");
        $result = $stmt->execute(
          array(':qty' => $updateQty, ':pid' => $id)
        );

        $stmt = $pdo->prepare("INSERT INTO orders (product_id, user_id, phno, address, quantity, amount) VALUES (?,?,?,?,?,?)");
        $result = $stmt->execute(
          array($id, $_SESSION['id'], $phno, $address, $qty, $total)
        );

        if ($result) {
          unset($_SESSION['cart']);
          echo "<script>window.location.href='comfirmation.php';</script>";
        } else {
          $msg = "Somethings went wrong! please try again";
          echo "<script>alert('$msg');window.location.href='cart.php';</script>";
        }
      } else {
        $avaliable = $qResult['quantity'];
        $name = $qResult['name'];
        $msg = "Fail to purchase! Only $avaliable items in $name.";
        echo "<script>alert('$msg');window.location.href='cart.php';</script>";
      }
    }
  }
} ?>

<div class="container">
  <div class="row mt-5 justify-content-md-center">
    <div class="col-md-6 border-sm border p-4 rounded-2 shadow">
      <h5 class="text-center mb-4">We will need these information to process your order</h5>
      <p style="color: red;"><?php echo empty($errorMsg) ? '' : $errorMsg ?></p>
      <form action="checkout.php" method="post">

        <div class="form-outline mb-4">
          <label class="form-label" for="form2Example1">Phone Number</label>
          <input type="text" id="form2Example1" class="form-control border" name="phno" required />
        </div>
        <div class="form-outline mb-4">
          <label class="form-label" for="form2Example2">Address</label>
          <input type="text" id="form2Example2" class="form-control border" name="address" required />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>


</html>