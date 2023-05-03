<?php
require __DIR__ . '/../src/bootstrap.php';
require_login();
?>

<?php
$data = mysqli_connect($host, $user, $password, $db);

if ($_GET['crs_id']) {

    $crs_id = $_GET['crs_id'];
    $sql = "SELECT c.crs_id, c.crs_code, c.crs_title, p.prog_name, c.crs_credits
    FROM `course` c 
    INNER JOIN `program` p ON p.prog_id=c.crs_program 
    WHERE crs_id = '$crs_id'";

    $result = mysqli_query($data, $sql);
    $info = mysqli_fetch_assoc($result);
}

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'crs_credits' => 'numeric | required'
    ];

    // custom messages
    $messages = [
        'crs_credits' => [
            'required' => 'Must enter in a course credits to change.',
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('course-update#profile-edit.php', [
            'inputs' => $inputs, //escape_html($inputs),
            'errors' => $errors
        ]);
    }

    if (isset($_POST['course-update'])) {
        $crs_id = $_POST['crs_id'];
        $crs_credits = $_POST['crs_credits'];
    
        $sqlUpdate = "UPDATE course SET crs_credits = '$crs_credits' WHERE crs_id = '$crs_id' ";
    
        $resultUpdate = mysqli_query($data, $sqlUpdate);
    
        if ($resultUpdate) {
            redirect_to("course-update.php?crs_id=$crs_id");
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
        <h1>Course</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Course</li>
                <li class="breadcrumb-item active">Details</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
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
                                <h5 class="card-title">Course Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Code</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['crs_code']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Title</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['crs_title']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Credits</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['crs_credits']}" ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Program</div>
                                    <div class="col-lg-9 col-md-8">
                                        <?php echo "{$info['prog_name']}" ?>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="course-update.php" method="post" enctype="multipart/form-data">

                                    <input name="crs_id" type="text" class="form-control" id="crs_id"
                                        value="<?php echo "{$info['crs_id']}" ?>" hidden>

                                    <div class="row mb-3">
                                        <label for="credits" class="col-md-4 col-lg-3 col-form-label">Credits</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="crs_credits" type="number"
                                                class="form-control <?= error_class($errors, 'crs_credits') ?>"
                                                id="crs_credits" value="<?= $inputs['crs_credits'] ?? '' ?>">
                                            <small>
                                                <?= $errors['crs_credits'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="course-update" class="btn btn-primary">Save
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