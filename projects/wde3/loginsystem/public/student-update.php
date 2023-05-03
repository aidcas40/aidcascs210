<?php
require __DIR__ . '/../src/bootstrap.php';
require_login();
?>

<?php
$data = mysqli_connect($host, $user, $password, $db);

if ($_GET['stud_id']) {

    $stud_id = $_GET['stud_id'];
    $sql = "SELECT s.stud_id, s.stud_fname, s.stud_lname, s.stud_gender, 
    DATE_FORMAT(s.stud_dob, '%M %e, %Y') AS stud_dob, s.stud_age, s.stud_email, s.stud_cellnum, 
    DATE_FORMAT(s.stud_enrolldate, '%M %e, %Y') AS stud_enrolldate, s.stud_yearlvl, s.stud_pic, 
    p.prog_name, s.stud_yearlvl 
    FROM `student` s 
    INNER JOIN `program` p ON p.prog_id=s.stud_program
    WHERE stud_id = '$stud_id'";

    $result = mysqli_query($data, $sql);
    $info = mysqli_fetch_assoc($result);
}

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'stud_age' => 'numeric',
        'stud_email' => 'string | required | between: 1, 25',
        'stud_cellnum' => 'numeric',
        'stud_yearlvl' => 'string',
        'stud_program' => 'string',
        'stud_pic' => 'string'
    ];

    // custom messages
    $messages = [
        'stud_email' => [
            'required' => 'You need to enter in an email address.',
        ],
        'stud_yearlvl' => [
            'required' => 'You need to enter in a year level.'
        ]
        
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('student-update.php', [
            'inputs' => $inputs, //escape_html($inputs),
            'errors' => $errors
        ]);
    }

    if (isset($_POST['student-update'])) {
        $stud_id = $_POST['stud_id'];
        $stud_age = $_POST['stud_age'];
        $stud_email = $_POST['stud_email'];
        $stud_cellnum = $_POST['stud_cellnum'];
        $stud_yearlvl = $_POST['stud_yearlvl'];
        $stud_program = $_POST['stud_program'];
    
        $file = $_FILES['stud_pic']['name'];
        $dst = "./uploads/" . $file;
        $dst_db = "uploads/" . $file;
        move_uploaded_file($_FILES['stud_pic']['tmp_name'], $dst);
    
        $sqlUpdate = "UPDATE student SET stud_age = '$stud_age', stud_email = '$stud_email',
        stud_cellnum = '$stud_cellnum', stud_yearlvl = '$stud_yearlvl', 
        stud_program = '$stud_program', stud_pic = '$dst_db' WHERE stud_id = '$stud_id' ";
    
        $resultUpdate = mysqli_query($data, $sqlUpdate);
    
        if ($resultUpdate) {
            redirect_to("student-update.php?stud_id=$stud_id");
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
        <h1>Student</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active">Details</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?php echo "{$info['stud_pic']}" ?>"
                            style="width: 100px; height: 100px; border-radius: 50%; margin-right: 15px;" alt="Profile">
                        <h2>
                            <?php echo "{$info['stud_fname']} {$info['stud_lname']}" ?>
                        </h2>
                        <h3>Student</h3>
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
                                <h5 class="card-title">Student Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">ID</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['stud_id']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Gender</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['stud_gender']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Program</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['prog_name']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Year Level</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['stud_yearlvl']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Enrolled</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['stud_enrolldate']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['stud_email']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone #</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['stud_cellnum']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">DOB</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['stud_dob']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Age</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['stud_age']}" ?>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="student-update.php" method="post" enctype="multipart/form-data">

                                    <input name="stud_id" type="text" class="form-control" id="stud_id"
                                        value="<?php echo "{$info['stud_id']}" ?>" hidden>

                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Student
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="form-control" type="file" name="stud_pic" id="stud_pic"
                                                accept="image/*" value="<?= $inputs['stud_pic'] ?? '' ?>"
                                                class="form-control <?= error_class($errors, 'stud_pic') ?>">
                                            <small>
                                                <?= $errors['stud_pic'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="age" class="col-md-4 col-lg-3 col-form-label">Age</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="stud_age" type="number"
                                                class="form-control <?= error_class($errors, 'stud_age') ?>"
                                                id="stud_age" value="<?= $inputs['stud_age'] ?? '' ?>">
                                            <small>
                                                <?= $errors['stud_age'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="stud_email" type="text"
                                                class="form-control <?= error_class($errors, 'stud_email') ?>"
                                                id="stud_email" value="<?= $inputs['stud_email'] ?? '' ?>">
                                            <small>
                                                <?= $errors['stud_email'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone #</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="stud_cellnum" type="number"
                                                class="form-control <?= error_class($errors, 'stud_cellnum') ?>"
                                                id="stud_cellnum" value="<?= $inputs['stud_cellnum'] ?? '' ?>">
                                            <small>
                                                <?= $errors['stud_cellnum'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Academic Level:</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" name="stud_yearlvl" id="stud_yearlvl"
                                                aria-label="Default select example">
                                                <option disabled selected>Open this select menu</option>
                                                <option value="1st Year">1st Year</option>
                                                <option value="2nd Year">2nd Year</option>
                                                <option value="Part Time">Part Time</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Program:</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" name="stud_program" id="stud_program"
                                                aria-label="Default select example">
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
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="student-update" class="btn btn-primary">Save
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