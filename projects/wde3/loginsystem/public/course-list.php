<?php
require __DIR__ . '/../src/bootstrap.php';
require_login();
error_reporting(0);
?>

<?php

// Create connection
$conn = new mysqli($host, $user, $password, $db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT c.crs_id, c.crs_code, c.crs_title, p.prog_name, c.crs_credits FROM `course` c INNER JOIN `program` p ON p.prog_id=c.crs_program";
$result = $conn->query($sql);

if(isset($_GET['message'])){
    $message = $_GET['message'];
    echo "<div class='alert alert-success'>$message</div>";
}

if($_GET['crs_id'])
{
    $c_id=$_GET['crs_id'];
    $sqlDel = "DELETE FROM course WHERE crs_id = '$c_id'";
    $resultDel = mysqli_query($conn, $sqlDel);

    if($resultDel)
    {
        //echo "Delete Success";
        redirect_for_admin('course-list.php', 'Course Deleted Successfully');
    }
}
?>

<?php view('header_admin', ['title' => 'CS210 - Aiden Castillo - Dashboard']) ?>

<main id="main" class="main">

<div id="admin_message">
    <?php if (!empty($message)) : ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>
</div>

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index_admin.php">Home</a></li>
      <li class="breadcrumb-item">Course</li>
      <li class="breadcrumb-item active">List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">CourseStudents Datatable</h5>
          <p>This webpage contains a datatable displaying information about courses.</p>

          <?php 
            if ($result->num_rows > 0) {
              echo "<table class=\"table datatable\"><thead><tr>
              <th>Code</th>
              <th>Title</th>
              <th>Program</th>
              <th>Credits</th>
              <th>Update</th>
              <th>Delete</th>
              </tr></thead><tbody>";
              // output data of each row
              while($row = $result->fetch_assoc()) {
                echo "<tr><th scope=\"row\">" . $row["crs_code"] . "</th><td>" 
                . "<a href='course-update.php?crs_id={$row['crs_id']}'>"
                . $row["crs_title"] . "</td><td>" 
                . $row["prog_name"] . "</td><td>" 
                . $row["crs_credits"]  . "</td><td class = 'table_td'>"
                . "<a class='btn btn-outline-primary' href='course-update.php?crs_id={$row['crs_id']}'>
                Update
                </a>" . "</td><td>"
                . "<a onClick=\"javascript:return confirm('Are you sure you want to delete this?');\" class='btn btn-outline-danger' href='course-list.php?crs_id={$row['crs_id']}'>
                Delete
                </a>" .  "</td></tr>";
              }
              echo "</tbody></table>";
            } else {
              echo "0 results";
            }
            
            $conn->close();
          ?>

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->

<?php view('footer_admin') ?>