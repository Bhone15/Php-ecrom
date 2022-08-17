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



if (empty($_POST['search'])) {
  $stmt = $pdo->prepare("SELECT * FROM users WHERE role='0' ORDER BY id DESC");
  $stmt->execute();
  $result = $stmt->fetchAll();
  $total_pages = ceil(count($result) / $numberOfRecords);
  $stmt = $pdo->prepare("SELECT * FROM users WHERE role='0' ORDER BY id DESC LIMIT $offset, $numberOfRecords");
  $stmt->execute();
  $result = $stmt->fetchAll();
} else {
  $searchKey = $_POST['search'];
  $stmt = $pdo->prepare("SELECT * FROM users WHERE name LIKE '%$searchKey%' AND role='0' ORDER BY id DESC");
  $stmt->execute();
  $result = $stmt->fetchAll();
  $total_pages = ceil(count($result) / $numberOfRecords);
  $stmt = $pdo->prepare("SELECT * FROM users WHERE name LIKE '%$searchKey%' AND role='0' ORDER BY id DESC LIMIT $offset, $numberOfRecords");
  $stmt->execute();
  $result = $stmt->fetchAll();
}

?>

<!-- Main content -->
<section class="content mt-3">

  <div class="container-fluid">
    <form action="normalUsers.php" method="POST">
      <div class="input-group mb-2">
        <div class="form-outline">
          <input type="search" name="search" id="form1" class="form-control" placeholder="Search" />
        </div>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </form>
  </div>

  <!-- /.row -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Normal Users Listing</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table class="table table-hover text-nowrap table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($result) {
                  $i = 1;
                  foreach ($result as $value) {
                ?>
                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $value['name'] ?></td>
                      <td><?= $value['email'] ?></td>
                      <td><?= $value['created_at'] ?></td>
                      <td><?= $value['updated_at'] ?></td>
                      <td>
                        <div class="btn-group">
                          <a href="deleteNormalUser.php?id=<?= $value['id'] ?>" type="button" class="btn btn-outline-danger" onclick="return confirm('Are you sure want to delete this user?')">Delete</a>
                        </div>
                      </td>
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