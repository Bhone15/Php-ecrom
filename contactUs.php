<?php
require('./header.php');
?>

<div class="container">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header mt-3">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="text-center">Contact Us</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card shadow">
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="">
              <h2>Eleven <strong>POWER</strong></h2>
              <p class="lead mb-5">123 Testing Street, Test Town, 9876 YGN<br>
                Phone: +95 234 56789012
              </p>
            </div>
          </div>
          <div class="col-7">
            <div class="form-group">
              <label for="inputName">Name</label>
              <input type="text" id="inputName" class="form-control" />
            </div>
            <div class="form-group mt-3">
              <label for="inputEmail">E-Mail</label>
              <input type="email" id="inputEmail" class="form-control" />
            </div>
            <div class="form-group mt-3">
              <label for="inputSubject">Subject</label>
              <input type="text" id="inputSubject" class="form-control" />
            </div>
            <div class="form-group mt-3">
              <label for="inputMessage">Message</label>
              <textarea id="inputMessage" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group mt-3">
              <input type="submit" class="btn btn-primary" value="Send message">
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>

<?php require('./footer.php') ?>