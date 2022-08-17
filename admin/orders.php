<?php
require('../config/config.php');
require('./dashboard-header.php');

if (!empty($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$numberOfRecords = 5;
$offset = ($pageno - 1) * $numberOfRecords;
$stmt = $pdo->prepare("SELECT * FROM orders");
$stmt->execute();
$result = $stmt->fetchAll();
$total_pages = ceil(count($result) / $numberOfRecords);
$stmt = $pdo->prepare("SELECT * FROM orders LIMIT $offset, $numberOfRecords");
$stmt->execute();
$result = $stmt->fetchAll();

?>

<!-- Main content -->
<section class="content mt-3">
  <!-- /.row -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Product Orders Listing</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table class="table table-hover text-nowrap table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Product Name</th>
                  <th>Customer Name</th>
                  <th>Billing Address</th>
                  <th>Phone Number</th>
                  <th>Quantity</th>
                  <th>Total Amount</th>
                  <th>Order Date</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($result) {
                  $i = 1;
                  foreach ($result as $value) {
                    $pid = $value['product_id'];
                    $uid = $value['user_id'];

                    $productQuery = $pdo->prepare("SELECT name FROM products WHERE id=$pid");
                    $productQuery->execute();
                    $productResult = $productQuery->fetch(PDO::FETCH_ASSOC);
                    $productName = $productResult['name'];

                    $userQuery = $pdo->prepare("SELECT name FROM users WHERE id=$uid");
                    $userQuery->execute();
                    $userResult = $userQuery->fetch(PDO::FETCH_ASSOC);
                    $userName = $userResult['name'];
                ?>
                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $productName ?></td>
                      <td class="text-capitalize"><?= $userName ?></td>
                      <td><?= $value['address'] ?></td>
                      <td><?= $value['phno'] ?></td>
                      <td><?= $value['quantity'] ?></td>
                      <td><?= $value['amount'] ?> MMK</td>
                      <td><?= $value['order_date'] ?></td>
                      <th>
                        <div class="btn-group">
                          <a href="deleteOrder.php?id=<?= $value['id'] ?>" type="button" class="btn btn-outline-danger" onclick="return confirm('Are you sure want to delete this user?')">Delete</a>
                        </div>
                      </th>
                    </tr>
                <?php
                    $i++;
                  }
                }
                ?>
              </tbody>
            </table>

            <nav aria-label="Page navigation example" style="float: right;">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                <li class="page-item <?php if ($pageno <= 1) {
                                        echo 'disabled';
                                      } ?>">
                  <a class="page-link" href="<?php echo $pageno <= 1 ? '#' : '?pageno=' . ($pageno - 1) ?>">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#"><?= $pageno ?></a></li>
                <li class="page-item <?php if ($pageno >= $total_pages) {
                                        echo 'disabled';
                                      } ?>">
                  <a class="page-link" href="<?php echo $pageno >= $total_pages ? '#' : '?pageno=' . ($pageno + 1) ?>">Next</a>
                </li>
                <li class="page-item"><a class="page-link" href="?pageno=<?= $total_pages ?>">Last</a></li>
              </ul>
            </nav>
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>