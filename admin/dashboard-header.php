<?php
require('../config/helper.php');
checkPermission();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Admin | Dashboard</title>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid mx-lg-5">
      <span class="navbar-brand mb-0 h1">Admin Dashboard</span>
      <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
        Actions
      </button>

      <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title text-capitalize" id="offcanvasWithBothOptionsLabel">
            welcome <?php echo $_SESSION['username']; ?>!
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <p>
            We trust you have received the usual lecture from the local System
            Administrator. Think before you do something and with greate power comes greate responsibility.
          </p>
          <nav class="nav flex-column">
            <a class="nav-link text-dark" aria-current="page" href="./products.php"><i class="fa-solid fa-shop"></i> Products</a>
            <hr class="dropdown-divider">
            <a class="nav-link text-dark" aria-current="page" href="./orders.php"><i class="fa-solid fa-bullhorn"></i> Orders</a>
            <hr class="dropdown-divider">
            <a class="nav-link text-dark" href="./adminUsers.php"><i class="fa-solid fa-lock"></i> Admin Users</a>
            <hr class="dropdown-divider">
            <a class="nav-link text-dark" href="./normalUsers.php"><i class="fa-solid fa-users"></i> Normal Users</a>
            <hr class="dropdown-divider">
            <a class="nav-link text-dark" href="../index.php"><i class="fa-solid fa-house-chimney-window"></i> Back Home</a>
          </nav>
        </div>
      </div>
    </div>
  </nav>