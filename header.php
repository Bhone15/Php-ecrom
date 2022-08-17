<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lucky | Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="cart.css">
  <!-- custom css -->
  <style type="text/css">
    .card-box {
      position: relative;
    }

    .addcards {
      background: #fff;
      /*color:white;*/

      border: 1px solid red;
      position: absolute;
      right: 10px;
      bottom: -17px;
    }

    .addcards:hover {
      background: red;
      color: #fff;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid mx-lg-5">
      <a class="navbar-brand" href="#">Eleven Power</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="./aboutUs.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="./contactUs.php">Contact Us</a>
          </li>
        </ul>

        <div class="me-auto ms-auto py-3">
          <form action="index.php" method="POST">
            <div class="input-group">
              <select class="custom-select rounded" id="inputGroupSelect01" style="width: 200px;" name="searchCategory">
                <option selected disabled>Search By Category</option>
                <option value="t-shirt">T-Shirt</option>
                <option value="swimwear">Swimwear</option>
                <option value="sport">Sport</option>
                <option value="skirt">Skirt</option>
                <option value="street">Street</option>
              </select>
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary mx-lg-2" type="submit">Search</button>
              </div>
            </div>
          </form>
        </div>

        <?php
        if (isset($_SESSION['role'])) { ?>
          <div class="dropdown mx-lg-2 py-3">
            <button class="btn btn-outline-primary dropdown-toggle text-capitalize" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION['username'] ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-light">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <?php
              if ($_SESSION['role'] == 1) { ?>
                <li><a class="dropdown-item" href="./admin/products.php">Dashboard</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
              <?php
              }
              ?>

              <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
            </ul>
          </div>

        <?php
        } else { ?>

          <a href="./login.php" class="btn btn-primary mx-lg-2">Login</a>
          <a href="./register.php" class="btn btn-outline-primary mx-lg-2">Register</a>
        <?php
        }
        ?>
        <?php
        $cart = 0;
        if (isset($_SESSION['cart'])) {
          foreach ($_SESSION['cart'] as $key => $qty) {
            $cart += $qty;
          }
        }
        ?>

        <a href="./cart.php" class="btn btn-primary position-relative">
          Cart
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php echo $cart ?>
            <span class="visually-hidden">unread messages</span>
          </span>
        </a>
      </div>
    </div>
  </nav>
  <script>
    $(document).ready(function() {
      $('.mdb-select').materialSelect();
    });
  </script>