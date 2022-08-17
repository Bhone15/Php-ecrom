<?php
require('./config/config.php');
require('./header.php');
?>

<section>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                    <h6 class="mb-0 text-muted"><?php echo $cart ?> items</h6>
                  </div>
                  <hr class="my-4">

                  <?php if (!empty($_SESSION['cart'])) : ?>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $key => $qty) :
                      $id = str_replace('id', '', $key);

                      $stmt = $pdo->prepare("SELECT * FROM products WHERE id=" . $id);
                      $stmt->execute();
                      $result = $stmt->fetch(PDO::FETCH_ASSOC);
                      $total += $result['price'] * $qty;
                    ?>

                      <div class="row mb-4 d-flex justify-content-between align-items-center">
                        <div class="col-md-2 col-lg-2 col-xl-2">
                          <img src="./admin/images/<?= $result['image'] ?>" class="img-fluid rounded-3" alt="<?= $result['name'] ?>" width="100px">
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <h6 class="text-muted"><?= $result['category'] ?></h6>
                          <a href="./productDetail.php?id=<?= $id ?>" class="text-black mb-0 customLink"><?= $result['name'] ?></a>
                          <style>
                            .customLink:hover {
                              text-decoration: underline !important;
                            }
                          </style>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                          <input value="<?= $qty ?>" type="number" class="form-control form-control-sm" readonly />
                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                          <h6 class="mb-0"><?php echo $result['price'] * $qty ?> MKK</h6>
                        </div>
                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                          <a href="cartItemClear.php?pid=<?= $result['id'] ?>" class="text-muted"><i class="fas fa-times"></i></a>
                        </div>
                      </div>
                      <hr class="my-4">

                    <?php endforeach ?>

                  <?php endif ?>

                  <div class="pt-5">
                    <h6 class="mb-0"><a href="./index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">items <?php echo $cart ?></h5>
                  </div>
                  <hr class="my-4">

                  <?php if (!empty($_SESSION['cart'])) : ?>
                    <div class="d-flex justify-content-between mb-5">
                      <h5 class="text-uppercase">Total price</h5>
                      <h5><?php echo $total ?> MMK</h5>
                    </div>
                  <?php endif ?>
                  <a href="clearAll.php" type="button" class="btn btn-outline-warning btn-lg my-2" data-mdb-ripple-color="dark">Clear All</a>
                  <?php if (!empty($_SESSION['cart'])) : ?>
                    <a href="./checkout.php" type="button" class="btn btn-outline-success btn-lg my-2" data-mdb-ripple-color="dark">Check Out</a>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php require('./footer.php');
