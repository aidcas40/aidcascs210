<?php
require __DIR__ . '/../src/bootstrap.php';
require_login();
?>

<?php
$data = mysqli_connect($host, $user, $password, $db);

if ($_GET['tchr_id']) {

    $tchr_id = $_GET['tchr_id'];
    $sql = "SELECT t.tchr_id, t.tchr_fname, t.tchr_lname, t.tchr_email, t.tchr_cellnum, 
    t.tchr_gender, DATE_FORMAT(t.tchr_dob, '%M %e, %Y') AS tchr_dob, t.tchr_age, t.tchr_pic, 
    d.dep_name
    FROM `teacher` t 
    INNER JOIN `department` d ON d.dep_id=t.tchr_department
    WHERE tchr_id = '$tchr_id'";

    $result = mysqli_query($data, $sql);
    $info = mysqli_fetch_assoc($result);
}

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'tchr_email' => 'string',
        'tchr_cellnum' => 'string | between: 1, 7',
        'tchr_department' => 'string',
        'tchr_age' => 'numeric',
        'tchr_pic' => 'string'
    ];

    // custom messages
    $messages = [
        'tchr_email' => [
            'required' => 'You need to enter in an email address.',
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with("teacher-update.php?tchr_id=$tchr_id", [
            'inputs' => $inputs,
            //escape_html($inputs),
            'errors' => $errors
        ]);
    }

    if (isset($_POST['teacher-update'])) {
        $tchr_id = $_POST['tchr_id'];
        $tchr_email = $_POST['tchr_email'];
        $tchr_cellnum = $_POST['tchr_cellnum'];
        $tchr_age = $_POST['tchr_age'];
        $tchr_department = $_POST['tchr_department'];

        $file = $_FILES['tchr_pic']['name'];
        $dst = "./uploads/" . $file;
        $dst_db = "uploads/" . $file;
        move_uploaded_file($_FILES['tchr_pic']['tmp_name'], $dst);

        $sqlUpdate = "UPDATE teacher SET tchr_age = '$tchr_age', tchr_email = '$tchr_email',
        tchr_cellnum = '$tchr_cellnum', tchr_department = '$tchr_department', 
        tchr_pic = '$dst_db' WHERE tchr_id = '$tchr_id' ";

        $resultUpdate = mysqli_query($data, $sqlUpdate);

        if ($resultUpdate) {
            redirect_to("teacher-update.php?tchr_id=$tchr_id");
        }
    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
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
        <h1>Teacher</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Teacher</li>
                <li class="breadcrumb-item active">Details</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?php echo "{$info['tchr_pic']}" ?>"
                            style="width: 100px; height: 100px; border-radius: 50%; margin-right: 15px;" alt="Profile">
                        <h2>
                            <?php echo "{$info['tchr_fname']} {$info['tchr_lname']}" ?>
                        </h2>
                        <h3>Teacher</h3>
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
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Teacher Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">ID</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['tchr_id']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Gender</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['tchr_gender']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Department</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['dep_name']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['tchr_email']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone #</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['tchr_cellnum']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['tchr_gender']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">DOB</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['tchr_dob']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Age</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['tchr_age']}" ?>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="teacher-update.php" method="post" enctype="multipart/form-data">

                                    <input name="tchr_id" type="text" class="form-control" id="tchr_id"
                                        value="<?php echo "{$info['tchr_id']}" ?>" hidden>

                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Teacher
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="form-control" type="file" name="tchr_pic" id="tchr_pic"
                                                accept="image/*" value="<?= $inputs['tchr_pic'] ?? '' ?>"
                                                class="form-control <?= error_class($errors, 'tchr_pic') ?>">
                                            <small>
                                                <?= $errors['tchr_pic'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="age" class="col-md-4 col-lg-3 col-form-label">Age</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="tchr_age" type="number"
                                                class="form-control <?= error_class($errors, 'tchr_age') ?>"
                                                id="tchr_age" value="<?= $inputs['tchr_age'] ?? '' ?>">
                                            <small>
                                                <?= $errors['tchr_age'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="tchr_email" type="text"
                                                class="form-control <?= error_class($errors, 'tchr_email') ?>"
                                                id="tchr_email" value="<?= $inputs['tchr_email'] ?? '' ?>">
                                            <small>
                                                <?= $errors['tchr_email'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone #</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="tchr_cellnum" type="number"
                                                class="form-control <?= error_class($errors, 'tchr_cellnum') ?>"
                                                id="tchr_cellnum" value="<?= $inputs['tchr_cellnum'] ?? '' ?>">
                                            <small>
                                                <?= $errors['tchr_cellnum'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Department:</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" name="tchr_department" id="tchr_department"
                                                aria-label="Default select example">
                                                <option disabled selected>Open this select menu</option>
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

                                    <div class="text-center">
                                        <button type="submit" name="teacher-update" class="btn btn-primary">Save
                                            Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php view('footer_admin') ?>