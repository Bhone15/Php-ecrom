<?php
require('../config/config.php');
require('./dashboard-header.php');

$statement = $pdo->prepare("SELECT * FROM products WHERE id=" . $_GET['id']);
$statement->execute();

$result = $statement->fetchAll();


if ($_POST) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $category = $_POST['category'];

  if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price']) || empty($_POST['quantity']) || empty($_POST['category'])) {
    if (empty($_POST['name'])) {
      $nameError = 'Product name is required!';
    }
    if (empty($_POST['description'])) {
      $descriptionError = 'Product description is required!';
    }
    if ($_POST['price'] < 0) {
      $priceError = 'Please provide valid value!';
    }
    if ($_POST['quantity'] < 0) {
      $quantityError = 'Please provide valid value!';
    }
    if (empty($_POST['category'])) {
      $categoryError = 'Please choose one of theses!';
    }
  } else {
    // check image
    if ($_FILES['image']['name'] != null) {
      $file = 'images/' . ($_FILES['image']['name']);
      $imageType = pathinfo($file, PATHINFO_EXTENSION);
      if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
        $imageError = 'Image must be png/jpg/jpeg!';
      } else {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $file);

        $stmt = $pdo->prepare("UPDATE products SET name='$name', description='$description', price='$price', quantity='$quantity', category='$category', image='$image' WHERE id='$id'");
        $result = $stmt->execute();

        if ($result) {
          echo "
          <script>
          alert('Successfully edited!');
          window.location.href='products.php';
        </script>
        ";
        }
      }
    } else {
      $stmt = $pdo->prepare("UPDATE products SET name='$name', description='$description', price='$price', quantity='$quantity', category='$category' WHERE id='$id'");
      $result = $stmt->execute();

      if ($result) {
        echo "
          <script>
          alert('Successfully edited!');
          window.location.href='products.php';
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
            <h3 class="card-title">Edit Product</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?= $result[0]['id'] ?>">
              <div class="row mb-2">
                <div class="col-sm-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label class="mb-2">Product Name</label>
                    <input value="<?= $result[0]['name'] ?>" type="text" name="name" class="form-control" placeholder="Enter the product name." style="<?php echo empty($nameError) ? '' : 'border: 1px solid red;' ?>">
                    <p style="color: red;"><?php echo empty($nameError) ? '' : $nameError ?></p>
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-12">
                  <!-- textarea -->
                  <div class="form-group">
                    <label class="mb-2">Product Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter the product description." style="<?php echo empty($descriptionError) ? '' : 'border: 1px solid red;' ?>"><?= $result[0]['description'] ?></textarea>
                    <p style="color: red;"><?php echo empty($descriptionError) ? '' : $descriptionError ?></p>
                  </div>
                </div>
              </div>


              <div class="row mb-2">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="mb-2">Price</label>
                    <input value="<?= $result[0]['price'] ?>" name="price" type="number" class="form-control" placeholder="Enter the product price." style="<?php echo empty($priceError) ? '' : 'border: 1px solid red;' ?>">
                    <p style="color: red;"><?php echo empty($priceError) ? '' : $priceError ?></p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="mb-2">Quantity</label>
                    <input value="<?= $result[0]['quantity'] ?>" name="quantity" type="number" class="form-control" placeholder="Enter the product quantity." style="<?php echo empty($quantityError) ? '' : 'border: 1px solid red;' ?>">
                    <p style="color: red;"><?php echo empty($quantityError) ? '' : $quantityError ?></p>
                  </div>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-sm-12">
                  <!-- radio -->
                  <div class="form-group">
                    <label class="mb-2">Choose Category</label>
                    <p style="color: red;"><?php echo empty($categoryError) ? '' : $categoryError ?></p>
                    <div class="form-check-inline">
                      <input class="form-check-input" type="radio" name="category" value="t-shirt" <?php echo $result[0]['category'] == "t-shirt" ? 'checked' :  '' ?>>
                      <label class="form-check-label">T-Shirt</label>
                    </div>
                    <div class="form-check-inline">
                      <input class="form-check-input" type="radio" name="category" value="swimwear" <?php echo $result[0]['category'] == "swimwear" ? 'checked' :  '' ?>>
                      <label class="form-check-label">Swimwear</label>
                    </div>
                    <div class="form-check-inline">
                      <input class="form-check-input" type="radio" name="category" value="sport" <?php echo $result[0]['category'] == "sport" ? 'checked' :  '' ?>>
                      <label class="form-check-label">Sport</label>
                    </div>
                    <div class="form-check-inline">
                      <input class="form-check-input" type="radio" name="category" value="skirt" <?php echo $result[0]['category'] == "skirt" ? 'checked' :  '' ?>>
                      <label class="form-check-label">Skirt</label>
                    </div>
                    <div class="form-check-inline">
                      <input class="form-check-input" type="radio" name="category" value="street" <?php echo $result[0]['category'] == "street" ? 'checked' :  '' ?>>
                      <label class="form-check-label">Street</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="mb-2">Product Image</label> </br>
                    <img src="images/<?= $result[0]['image'] ?>" alt="<?= $result[0]['name'] ?>" width="150" class="mb-2">
                    <input type="file" name='image' class="form-control" style="<?php echo empty($imageError) ? '' : 'border: 1px solid red;' ?>" />
                    <p style="color: red;"><?php echo empty($imageError) ? '' : $imageError ?></p>
                  </div>
                  <button type="submit" class="btn btn-primary">Edit Product</button>
                  <a href='products.php' type="button" class="btn btn-primary">Back</a>
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