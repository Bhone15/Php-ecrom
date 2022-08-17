<?php
require('../config/config.php');
require('./dashboard-header.php');

if ($_POST) {
  // check name, email and password;
  if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || (strlen($_POST['password']) < 4)) {
    if (empty($_POST['name'])) {
      $nameError = 'Name is required';
    }
    if (empty($_POST['email'])) {
      $emailError = 'Email is required';
    }
    if (empty($_POST['password'])) {
      $passwordError = 'Password is required';
    }
    if (strlen($_POST['password']) < 4) {
      $passwordError = 'Password should be 4 chars at least';
    }
  } else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 1;
    $statement = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $result = $statement->execute([':email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      $emailError = 'Email alread exists.';
    } else {
      $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, created_at) VALUES (?,?,?,?,?)");
      $result = $stmt->execute(
        array($name, $email, $password, $role, date('Y-m-d h:m:s'))
      );

      if ($result) {
        echo "<script>
          alert('Successfully Added!');
          window.location.href='adminUsers.php';
        </script>
        ";
      }
    }
  }
}

?>

<section class="content mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Add New Admin</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="addAdmin.php" method="post">
              <div class="row mb-2">
                <div class="col-sm-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label class="mb-2">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name." style="<?php echo empty($nameError) ? '' : 'border: 1px solid red;' ?>">
                    <p style="color: red;"><?php echo empty($nameError) ? '' : $nameError ?></p>
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label class="mb-2">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter email." style="<?php echo empty($emailError) ? '' : 'border: 1px solid red;' ?>">
                    <p style="color: red;"><?php echo empty($emailError) ? '' : $emailError ?></p>
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label class="mb-2">Password</label>
                    <input type="text" name="password" class="form-control" placeholder="Enter password." style="<?php echo empty($passwordError) ? '' : 'border: 1px solid red;' ?>">
                    <p style="color: red;"><?php echo empty($passwordError) ? '' : $passwordError ?></p>
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-3">
                  <button type="submit" class="btn btn-primary">Add New Admin</button>
                  <a href='adminUsers.php' type="button" class="btn btn-primary">Back</a>
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>