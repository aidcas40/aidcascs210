<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/student-add.php';
require_login();
?>

<?php view('header_admin', ['title' => 'CS210 - Aiden Castillo - Dashboard']) ?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Add Students</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Student</li>
      <li class="breadcrumb-item active">Add</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <!--<div class="row">-->
    <div class="col-lg-10">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Student Information</h5>

          <!-- General Form Elements -->
          <form action="student-add.php" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">First Name:</label>
              <div class="col-sm-10">
                <input type="text" name="stud_fname" id="stud_fname" value="<?= $inputs['stud_fname'] ?? '' ?>" 
                      class="form-control <?= error_class($errors, 'stud_fname') ?>">
                <small><?= $errors['stud_fname'] ?? '' ?></small>
            </div>
            </div>

            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Last Name:</label>
              <div class="col-sm-10">
                <input type="text" name="stud_lname" id="stud_lname" value="<?= $inputs['stud_lname'] ?? '' ?>"
                      class="form-control <?= error_class($errors, 'stud_lname') ?>">
                <small><?= $errors['stud_lname'] ?? '' ?></small>
            </div>
            </div>

            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0">Gender:</legend>
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="stud_gender" id="male" value="Male" checked>
                  <label class="form-check-label" for="male">
                    Male
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="stud_gender" id="female" value="Female">
                  <label class="form-check-label" for="female">
                    Female
                  </label>
                </div>
              </div>
            </fieldset>

            <div class="row mb-3">
              <label for="inputDate" class="col-sm-2 col-form-label">Date Of Birth:</label>
              <div class="col-sm-10">
                <input type="date" name="stud_dob" id="stud_dob" value="<?= $inputs['stud_dob'] ?? '' ?>" 
                      class="form-control <?= error_class($errors, 'stud_dob') ?>">
                <small><?= $errors['stud_dob'] ?? '' ?></small>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Age:</label>
              <div class="col-sm-10">
                <input type="number" name="stud_age" id="stud_age" value="<?= $inputs['stud_age'] ?? '' ?>"
                      class="form-control <?= error_class($errors, 'stud_age') ?>">
                <small><?= $errors['stud_age'] ?? '' ?></small>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
              <div class="col-sm-10">
                <input type="email" name="stud_email" id="stud_email" value="<?= $inputs['stud_email'] ?? '' ?>" 
                      class="form-control <?= error_class($errors, 'stud_email') ?>">
                <small><?= $errors['stud_email'] ?? '' ?></small>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Phone Number:</label>
              <div class="col-sm-10">
                <input type="number" name="stud_cellnum" id="stud_cellnum" value="<?= $inputs['stud_cellnum'] ?? '' ?>"  
                      class="form-control  <?= error_class($errors, 'stud_cellnum') ?>">
                <small><?= $errors['stud_cellnum'] ?? '' ?></small>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputDate" class="col-sm-2 col-form-label">Enrollment Date:</label>
              <div class="col-sm-10">
                <input type="date" name="stud_enrolldate" id="stud_enrolldate" value="<?= $inputs['stud_enrolldate'] ?? '' ?>" 
                      class="form-control <?= error_class($errors, 'stud_enrolldate') ?>">
                <small><?= $errors['stud_enrolldate'] ?? '' ?></small>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Academic Level:</label>
              <div class="col-sm-10">
                <select class="form-select" name="stud_yearlvl" id="stud_yearlvl" aria-label="Default select example">
                  <option disabled selected>Open this select menu</option>
                  <option value="1st Year">1st Year</option>
                  <option value="2nd Year">2nd Year</option>
                  <option value="Part Time">Part Time</option>
                </select>
                <small><?= $errors['stud_yearlvl'] ?? '' ?></small>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Program:</label>
              <div class="col-sm-10">
                <select class="form-select" name="stud_program" id="stud_program" aria-label="Default select example">
                  <option disabled selected>Open this select menu</option>
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
                <small><?= $errors['stud_program'] ?? '' ?></small>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Photo:</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" name="stud_pic" id="stud_pic" accept="image/*" value="<?= $inputs['stud_pic'] ?? '' ?>"
                        class="form-control <?= error_class($errors, 'stud_pic') ?>">
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

<?php view('footer_admin') ?>