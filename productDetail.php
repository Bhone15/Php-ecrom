<?php
require('./config/config.php');
require('./header.php');

$stmt = $pdo->prepare("SELECT * FROM products WHERE id=" . $_GET['id']);
$stmt->execute();
$result = $stmt->fetchAll();

?>

<div class="section mt-4">
  <div class="container my-auto">
    <div class="row">
      <div class="col-lg-6 col-md-12 d-flex justify-content-center">
        <img src="./admin/images/<?= $result[0]['image'] ?>" alt="<?= $result[0]['name'] ?>" width="400px">
      </div>
      <div class="col-lg-6 col-md-12 d-flex justify-content-center align-items-center">
        <div>
          <h4 class="mb-4"><?= $result[0]['name'] ?></h4>
          <p class="mb-4"><?= $result[0]['description'] ?></p>
          <p class="mb-4">Category: <?= $result[0]['category'] ?></p>
          <p class="mb-4">Price: <?= $result[0]['price'] ?> MMK</p>
          <p class="mb-4">Avaliable item: <?= $result[0]['quantity'] ?></p>
          <form action="./addToCart.php" method="POST">
            <label for="qty">Quantity: </label>
            <input type="number" value="1" min="1" max="<?= $result[0]['quantity'] ?>" oninput="validity.valid||(value='');" name='qty' id="qty" style="width: 80px;"> <br /><br />
            <input type="hidden" name='id' value="<?= $result[0]['id'] ?>">
            <button type="submit" class="btn btn-outline-primary rounded">Add to cart</button>
            <a type="button" href="./index.php" class="btn btn-outline-primary rounded">Back</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require('./footer.php') ?>