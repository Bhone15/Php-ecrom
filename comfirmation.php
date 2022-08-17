<?php
require './header.php';
require './config/config.php';
$userName = $_SESSION['username'];
?>
<div class="my-5">
  <div class="jumbotron text-center">
    <h1 class="display-3 text-capitalize">Thank You! <?= $userName ?></h1>
    <p class="lead"><strong>We got your order,</strong> It's really pretty. We'll send you and email when it ships!</p>
    <hr>
    <p>
      Having trouble? <a href="./contactUs.php">Contact Us</a>
    </p>
    <p class="lead">
      <a class="btn btn-primary btn-sm" href="./index.php" role="button">Continue to homepage</a>
    </p>
  </div>
</div>

<?php require './footer.php' ?>