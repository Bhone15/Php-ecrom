<?php
require('./config/config.php');
require('./header.php');
if (!empty($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$numberOfRecords = 8;
$offset = ($pageno - 1) * $numberOfRecords;

if (empty($_POST['searchCategory'])) {
  $stmt = $pdo->prepare("SELECT * FROM products WHERE quantity > 0 ORDER BY id DESC");
  $stmt->execute();
  $result = $stmt->fetchAll();
  $total_pages = ceil(count($result) / $numberOfRecords);
  $stmt = $pdo->prepare("SELECT * FROM products WHERE quantity > 0 ORDER BY id DESC LIMIT $offset, $numberOfRecords");
  $stmt->execute();
  $result = $stmt->fetchAll();
} else {
  $searchCategory = $_POST['searchCategory'];
  $stmt = $pdo->prepare("SELECT * FROM products WHERE category='$searchCategory' AND quantity > 0 ORDER BY id DESC");
  $stmt->execute();
  $result = $stmt->fetchAll();
  $result = $stmt->fetchAll();
  $total_pages = ceil(count($result) / $numberOfRecords);
  $stmt = $pdo->prepare("SELECT * FROM products WHERE category='$searchCategory' AND quantity > 0 ORDER BY id DESC LIMIT $offset, $numberOfRecords");
  $stmt->execute();
  $result = $stmt->fetchAll();
}
?>

<div class="container">
  <div class="row py-3">

    <?php
    if ($result) {
      $i = 1;
      foreach ($result as $value) {
    ?>
        <div class="col-lg-3 col-md-6 my-3 card-box">
          <div class="card pb-3">
            <img src="./admin/images/<?= $value['image'] ?>" alt="<?= $value['name'] ?>" height="430px" />
            <style>
              .detail:hover {
                text-decoration: underline !important;
              }
            </style>
            <div class="card-body">
              <a href="./productDetail.php?id=<?= $value['id'] ?>" class="fs-6 detail" style="color: black; text-decoration: none;"><?= $value['name'] ?></a>
            </div>

            <div class="d-flex justify-content-between mx-3">
              <p>Price: <?= $value['price'] ?> MMK</p>
              <p>Quantiy: <?= $value['quantity'] ?></p>
            </div>
            <form action="addToCart.php" method="POST">
              <input type="hidden" name='id' value="<?= $value['id'] ?>">
              <input type="hidden" name='qty' value="1">
              <button type="submit" class="btn rounded-0 addcards">Add to cart</button>
            </form>
          </div>
        </div>
      <?php
        $i++;
      }
    } else { ?>
      <h1 class="text-center my-5">There is nothing to show.</h1>
    <?php
    }
    ?>
    <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-4">
      <ul class="pagination">
        <li class="page-item border"><a class="page-link" href="?pageno=1">First</a></li>
        <li class="page-item border <?php if ($pageno <= 1) {
                                      echo 'disabled';
                                    } ?>">
          <a class="page-link" href="<?php echo $pageno <= 1 ? '#' : '?pageno=' . ($pageno - 1) ?>">Previous</a>
        </li>
        <li class="page-item border"><a class="page-link" href="#"><?= $pageno ?></a></li>
        <li class="page-item border <?php if ($pageno >= $total_pages) {
                                      echo 'disabled';
                                    } ?>">
          <a class="page-link" href="<?php echo $pageno >= $total_pages ? '#' : '?pageno=' . ($pageno + 1) ?>">Next</a>
        </li>
        <li class="page-item border"><a class="page-link" href="?pageno=<?= $total_pages ?>">Last</a></li>
      </ul>
    </nav>

    <?php require('./faq.php'); ?>
  </div>
</div>
<?php require('./footer.php'); ?>