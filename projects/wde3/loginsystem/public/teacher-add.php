<?php 
include('inc/header.php');
require __DIR__ . '/../../loginsystem/src/bootstrap.php';
require __DIR__ . '/src/teacher-add.php';
require_login();
?>


<main id="main" class="main">

<div class="pagetitle">
  <h1>Form Elements</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Teacher</li>
      <li class="breadcrumb-item active">Add</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <!--<div class="row">-->
    <div class="col-lg-10">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Teacher Information</h5>

          <!-- General Form Elements -->
          <form action="teacher-add.php" method="post">
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">First Name:</label>
              <div class="col-sm-10">
                <input type="text" name="tchr_fname" id="tchr_fname" value="<?= $inputs['tchr_fname'] ?? '' ?>" 
                      class="form-control <?= error_class($errors, 'tchr_fname') ?>">
                <small><?= $errors['tchr_fname'] ?? '' ?></small>
            </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Last Name:</label>
              <div class="col-sm-10">
                <input type="text" name="tchr_lname" id="tchr_lname" value="<?= $inputs['tchr_lname'] ?? '' ?>"
                      class="form-control <?= error_class($errors, 'tchr_lname') ?>">
                <small><?= $errors['tchr_lname'] ?? '' ?></small>
            </div>
            </div>
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0">Gender:</legend>
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="tchr_gender" id="male" value="male" checked>
                  <label class="form-check-label" for="male">
                    Male
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="tchr_gender" id="female" value="female">
                  <label class="form-check-label" for="female">
                    Female
                  </label>
                </div>
              </div>
            </fieldset>
            <div class="row mb-3">
              <label for="inputDate" class="col-sm-2 col-form-label">Date Of Birth:</label>
              <div class="col-sm-10">
                <input type="date" name="tchr_dob" id="tchr_dob" value="<?= $inputs['tchr_dob'] ?? '' ?>" 
                      class="form-control <?= error_class($errors, 'tchr_dob') ?>">
                <small><?= $errors['tchr_dob'] ?? '' ?></small>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Age:</label>
              <div class="col-sm-10">
                <input type="number" name="tchr_age" id="tchr_age" value="<?= $inputs['tchr_age'] ?? '' ?>"
                      class="form-control <?= error_class($errors, 'tchr_age') ?>">
                <small><?= $errors['tchr_age'] ?? '' ?></small>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
              <div class="col-sm-10">
                <input type="email" name="tchr_email" id="tchr_email" value="<?= $inputs['tchr_email'] ?? '' ?>" 
                      class="form-control <?= error_class($errors, 'tchr_email') ?>">
                <small><?= $errors['tchr_email'] ?? '' ?></small>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Phone Number:</label>
              <div class="col-sm-10">
                <input type="number" name="tchr_cellnum" id="tchr_cellnum" value="<?= $inputs['tchr_cellnum'] ?? '' ?>"  
                      class="form-control  <?= error_class($errors, 'tchr_cellnum') ?>">
                <small><?= $errors['tchr_cellnum'] ?? '' ?></small>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Department:</label>
              <div class="col-sm-10">
                <select class="form-select" name="tchr_department" id="tchr_department" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <?php
                    // Connect to the database and fetch the values from the "program" lookup table
                    $pdo = new PDO("mysql:host=localhost:3307;dbname=auth", "root", "");
                    $stmt = $pdo->query("SELECT dep_id, dep_name FROM department");

                    // Loop through the results and generate an <option> element for each row
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['dep_id'] . '">' . $row['dep_name'] . '</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Photo:</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" name="tchr_pic" id="tchr_pic" accept="image/*" value="<?= $inputs['tchr_pic'] ?? '' ?>"
                        class="form-control <?= error_class($errors, 'tchr_pic') ?>">
                <small><?= $errors['tchr_pic'] ?? '' ?></small>
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