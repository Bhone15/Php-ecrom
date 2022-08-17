<?php
require './config/config.php';
require './header.php';

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
    $statement = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $result = $statement->execute([':email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      $emailError = 'Email alread exists.';
    } else {
      $stmt = $pdo->prepare("INSERT INTO users (name, email, password, created_at) VALUES (?,?,?,?)");
      $result = $stmt->execute(
        array($name, $email, $password, date('Y-m-d h:m:s'))
      );
      if ($result) {
        echo "<div class='alert alert-success' role='alert'>
  Successfully Registered! You can now login. <a href='./login.php' class='alert-link'>Login</a>
</div>";
      }
    }
  }
}

?>
<script>

</script>

<div class="container">
  <div class="row mt-5 justify-content-md-center">
    <div class="col-md-6 border-sm border p-4 rounded-2 shadow">
      <h1 class="text-center mb-4">Registration Form</h1>
      <form action="register.php" method="post">

        <!-- Name input -->
        <div class="form-outline mb-4">
          <label class="form-label" for="form2Example1">Name</label>
          <input type="text" id="form2Example1" class="form-control border" name="name" style="<?php echo empty($nameError) ? '' : 'border: 1px solid red;' ?>" />
          <p style="color: red;"><?php echo empty($nameError) ? '' : $nameError ?></p>
        </div>
        <!-- Email input -->
        <div class="form-outline mb-4">
          <label class="form-label" for="form2Example1">Email address</label>
          <input type="email" id="form2Example1" class="form-control border" name="email" style="<?php echo empty($emailError) ? '' : 'border: 1px solid red;' ?>" />
          <p style="color: red;"><?php echo empty($emailError) ? '' : $emailError ?></p>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
          <label class="form-label" for="form2Example2">Password</label>
          <input type="password" id="form2Example2" class="form-control border" name="password" style="<?php echo empty($passwordError) ? '' : 'border: 1px solid red;' ?>" />
          <p style="color: red;"><?php echo empty($passwordError) ? '' : $passwordError ?></p>
        </div>


        <!-- Submit button -->
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Register</button>
          <div class="text-center">
            <p>Already Registered? <a href="login.php">Login</a></p>
          </div>
        </div>

        <!-- Register buttons -->

      </form>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>


</html>