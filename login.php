<?php
require('./header.php');
require './config/config.php';

if ($_POST) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $statement = $pdo->prepare("SELECT * FROM users WHERE email=:email");
  $result = $statement->execute([':email' => $email]);
  $user = $statement->fetch(PDO::FETCH_ASSOC);
  if ($user) {
    if (password_verify($password, $user['password'])) {
      $_SESSION['id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['username'] = $user['name'];
      $_SESSION['logged_in'] = time();
      header('Location: index.php');
    } else {
      $errorMsg = 'Incorrect Password';
    }
  } else {
    $errorMsg = 'Incorrect crendentials';
  }
}
?>
<div class="container">
  <div class="row mt-5 justify-content-md-center">
    <div class="col-md-6 border-sm border p-4 rounded-2 shadow">
      <h1 class="text-center mb-4">Login Form</h1>
      <p style="color: red;"><?php echo empty($errorMsg) ? '' : $errorMsg ?></p>
      <form action="login.php" method="post">
        <!-- Email input -->
        <div class="form-outline mb-4">
          <label class="form-label" for="form2Example1">Email address</label>
          <input type="email" id="form2Example1" class="form-control border" name="email" />
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
          <label class="form-label" for="form2Example2">Password</label>
          <input type="password" id="form2Example2" class="form-control border" name="password" />
        </div>


        <!-- Submit button -->
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Login</button>
          <div class="text-center">
            <p>Not a member? <a href="register.php">Register</a></p>
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