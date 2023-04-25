<?php 
//include('inc/header.php');
require_once __DIR__ . '/../src/inc/header.php';
require __DIR__ . '/../../loginsystem/src/bootstrap.php';
require __DIR__ . '/../src/student-add.php';
require_login();
?>


<main id="main" class="main">

<div class="pagetitle">
  <h1>Form Elements</h1>
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
          <form action="student-add.php" method="post">
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
                  <input class="form-check-input" type="radio" name="stud_gender" id="male" value="male" checked>
                  <label class="form-check-label" for="male">
                    Male
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="stud_gender" id="female" value="female">
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
                  <option selected>Open this select menu</option>
                  <option value="1">1st Year</option>
                  <option value="2">2nd Year</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Program:</label>
              <div class="col-sm-10">
                <select class="form-select" name="stud_program" id="stud_program" aria-label="Default select example">
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
              <label for="inputNumber" class="col-sm-2 col-form-label">Photo:</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" name="stud_pic" id="stud_pic" accept="image/*" value="<?= $inputs['stud_pic'] ?? '' ?>"
                        class="form-control <?= error_class($errors, 'stud_pic') ?>">
                <small><?= $errors['stud_pic'] ?? '' ?></small>
              </div>
            </div>
            <!--<div class="row mb-3">
              <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputTime" class="col-sm-2 col-form-label">Time</label>
              <div class="col-sm-10">
                <input type="time" class="form-control">
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputColor" class="col-sm-2 col-form-label">Color Picker</label>
              <div class="col-sm-10">
                <input type="color" class="form-control form-control-color" id="exampleColorInput" value="#4154f1" title="Choose your color">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword" class="col-sm-2 col-form-label">Textarea</label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 100px"></textarea>
              </div>
            </div>
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                  <label class="form-check-label" for="gridRadios1">
                    First radio
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                  <label class="form-check-label" for="gridRadios2">
                    Second radio
                  </label>
                </div>
                <div class="form-check disabled">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios" value="option" disabled>
                  <label class="form-check-label" for="gridRadios3">
                    Third disabled radio
                  </label>
                </div>
              </div>
            </fieldset>
            <div class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0">Checkboxes</legend>
              <div class="col-sm-10">

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck1">
                  <label class="form-check-label" for="gridCheck1">
                    Example checkbox
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck2" checked>
                  <label class="form-check-label" for="gridCheck2">
                    Example checkbox 2
                  </label>
                </div>

              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Disabled</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" value="Read only / Disabled" disabled>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Select</label>
              <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Multi Select</label>
              <div class="col-sm-10">
                <select class="form-select" multiple aria-label="multiple select example">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
            </div>-->

            <div class="row mb-3">
              <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Submit Form</button>
              </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>

    </div>

    <!--<div class="col-lg-6">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Advanced Form Elements</h5>-->

          <!-- Advanced Form Elements -->
          <!--<form>
            <div class="row mb-5">
              <label class="col-sm-2 col-form-label">Switches</label>
              <div class="col-sm-10">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                  <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                  <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled" disabled>
                  <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedDisabled" checked disabled>
                  <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
                </div>
              </div>
            </div>

            <div class="row mb-5">
              <label class="col-sm-2 col-form-label">Ranges</label>
              <div class="col-sm-10">
                <div>
                  <label for="customRange1" class="form-label">Example range</label>
                  <input type="range" class="form-range" id="customRange1">
                </div>
                <div>
                  <label for="disabledRange" class="form-label">Disabled range</label>
                  <input type="range" class="form-range" id="disabledRange" disabled>
                </div>
                <div>
                  <label for="customRange2" class="form-label">Min and max with steps</label>
                  <input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange2">
                </div>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Floating labels</label>
              <div class="col-sm-10">
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                  <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                  <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating mb-3">
                  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"></textarea>
                  <label for="floatingTextarea">Comments</label>
                </div>
                <div class="form-floating mb-3">
                  <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                  <label for="floatingSelect">Works with selects</label>
                </div>
              </div>
            </div>

            <div class="row mb-5">
              <label class="col-sm-2 col-form-label">Input groups</label>
              <div class="col-sm-10">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">@</span>
                  <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <span class="input-group-text" id="basic-addon2">@example.com</span>
                </div>

                <label for="basic-url" class="form-label">Your vanity URL</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
                  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text">$</span>
                  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                  <span class="input-group-text">.00</span>
                </div>

                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                  <span class="input-group-text">@</span>
                  <input type="text" class="form-control" placeholder="Server" aria-label="Server">
                </div>

                <div class="input-group">
                  <span class="input-group-text">With textarea</span>
                  <textarea class="form-control" aria-label="With textarea"></textarea>
                </div>
              </div>
            </div>

          </form>--><!-- End General Form Elements -->

        <!--</div>
      </div>

    </div>
  </div>-->
</section>

</main><!-- End #main -->

  <?php include('inc/footer.php'); ?>