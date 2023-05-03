<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/users-profile.php';
require_login();
?>

<?php
$errors = [];
$inputs = [];

$data = mysqli_connect($host, $user, $password, $db);

$name = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$name' ";
$result = mysqli_query($data, $sql);
$info = mysqli_fetch_assoc($result);

$picture = $info['picture'];

if (isset($_POST['update-profile'])) {
  $dataUpdate = mysqli_connect($host, $user, $password, $db);

  $id = $_POST['id'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $social = $_POST['social'];

  $file = $_FILES['picture']['name'];
  $dst = "./uploads/" . $file;
  $dst_db = "uploads/" . $file;
  move_uploaded_file($_FILES['picture']['tmp_name'], $dst);

  $sqlUpdate = "UPDATE users SET fname = '$fname', lname = '$lname',
  social = '$social', picture = '$dst_db' WHERE id = '$id' ";

  $resultUpdate = mysqli_query($dataUpdate, $sqlUpdate);

  if ($resultUpdate) {
    redirect_for_admin('users-profile.php', 'Successfully updated account information.');
  }

}

if (isset($_POST['change-password'])) {
  $fields = [
    'password' => 'string | required | secure',
    'renewpassword' => 'string | required | same: password'
  ];

  // custom messages
  $messages = [
    'renewpassword' => [
      'required' => 'Please enter the password again',
      'same' => 'The password does not match'
    ]
  ];

  [$inputs, $errors] = filter($_POST, $fields, $messages);

  if ($errors) {
    redirect_with('users-profile.php', [
      'inputs' => $inputs,
      'errors' => $errors
    ]);
  
  } else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
  
  } else {
  
    $username = current_user();
    if (update_user_password($username, $inputs['password'])) {
      redirect_with_message(
        'user-profile.php',
        'Successfully changed password.'
      );
    } else {
      $errors = [
        'message' => 'An error occurred while updating your password. Please try again.'
      ];
      redirect_with('user-profile.php', [
        'errors' => $errors,
        'inputs' => $_POST
      ]);
    }
  }

}
?>

<?php view('header_admin', ['title' => 'CS210 - Aiden Castillo - Dashboard']) ?>

<main id="main" class="main">

  <div id="admin_message">
    <?php if (!empty($message)): ?>
      <div class="alert alert-success">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="<?php echo "{$info['picture']}" ?>"
              style="width: 100px; height: 100px; border-radius: 50%; margin-right: 15px;" alt="Profile">
            <h2>
              <?= current_user() ?>
            </h2>
            <h3>User</h3>
            <div class="social-links mt-2">
              <a href="<?php echo "{$info['social']}" ?>" class="facebook" target="_blank"><i
                  class="bi bi-facebook"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab"
                  data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                  Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Username</div>
                  <div class="col-lg-9 col-md-8">
                    <?= current_user() ?>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">
                    <?php echo "{$info['fname']} {$info['lname']}" ?>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">
                    <?php echo "{$info['email']}" ?>
                  </div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="users-profile.php" method="post" enctype="multipart/form-data">

                  <input name="id" type="text" class="form-control" id="id" value="<?php echo "{$info['id']}" ?>"
                    hidden>

                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <input class="form-control" type="file" name="picture" id="picture" accept="image/*"
                        value="<?= $inputs['picture'] ?? '' ?>"
                        class="form-control <?= error_class($errors, 'picture') ?>">
                      <small>
                        <?= $errors['picture'] ?? '' ?>
                      </small>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fname" type="text" class="form-control <?= error_class($errors, 'fname') ?>"
                        id="fname" value="<?= $inputs['fname'] ?? '' ?>">
                      <small>
                        <?= $errors['fname'] ?? '' ?>
                      </small>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="lname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="lname" type="text" class="form-control <?= error_class($errors, 'lname') ?>"
                        id="lname" value="<?= $inputs['lname'] ?? '' ?>">
                      <small>
                        <?= $errors['lname'] ?? '' ?>
                      </small>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="social" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="social" type="text" class="form-control <?= error_class($errors, 'social') ?>"
                        id="social" value="<?= $inputs['social'] ?? '' ?>">
                      <small>
                        <?= $errors['social'] ?? '' ?>
                      </small>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" name="update-profile" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="password">
                    </div>
                    <small>
                      <?= $errors['password'] ?? '' ?>
                    </small>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewpassword">
                    </div>
                    <small>
                      <?= $errors['renewpassword'] ?? '' ?>
                    </small>
                  </div>

                  <div class="text-center">
                    <button type="submit" name="change-password" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php view('footer_admin') ?>