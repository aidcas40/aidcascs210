<?php 
include('inc/header.php');
require __DIR__ . '/src/course-add.php';
?>


<main id="main" class="main">

<div class="pagetitle">
  <h1>Form Elements</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Course</li>
      <li class="breadcrumb-item active">Add</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <!--<div class="row">-->
    <div class="col-lg-10">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Course Information</h5>

          <!-- General Form Elements -->
          <form action="course-add.php" method="post">
          <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Code:</label>
              <div class="col-sm-10">
                <input type="text" name="crs_id" id="crs_id" value="<?= $inputs['crs_id'] ?? '' ?>" 
                      class="form-control <?= error_class($errors, 'crs_id') ?>">
                <small><?= $errors['crs_id'] ?? '' ?></small>
            </div>
           </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Title:</label>
              <div class="col-sm-10">
                <input type="text" name="crs_title" id="crs_title" value="<?= $inputs['crs_title'] ?? '' ?>" 
                      class="form-control <?= error_class($errors, 'crs_title') ?>">
                <small><?= $errors['crs_title'] ?? '' ?></small>
            </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Credits:</label>
              <div class="col-sm-10">
                <input type="number" name="crs_credits" id="crs_credits" value="<?= $inputs['crs_credits'] ?? '' ?>"
                      class="form-control <?= error_class($errors, 'crs_credits') ?>">
                <small><?= $errors['crs_credits'] ?? '' ?></small>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Program:</label>
              <div class="col-sm-10">
                <select class="form-select" name="crs_program" id="crs_program" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <?php
                    // Connect to the database and fetch the values from the "program" lookup table
                    $pdo = new PDO("mysql:host=localhost:3307;dbname=auth", "root", "");
                    $stmt = $pdo->query("SELECT prog_id, prog_name FROM program");

                    // Loop through the results and generate an <option> element for each row
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['prog_id'] . '">' . $row['prog_name'] . '</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Submit Form</button>
              </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>

    </div>
</section>

</main><!-- End #main -->

  <?php include('inc/footer.php'); ?>