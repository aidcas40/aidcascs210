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

$sql = "SELECT s.stud_id, CONCAT(s.stud_fname, ' ', s.stud_lname) AS Name, s.stud_gender, DATE_FORMAT(s.stud_dob, '%M %e, %Y') AS stud_dob, s.stud_email, s.stud_pic, p.prog_name, s.stud_yearlvl FROM `student` s INNER JOIN `program` p ON p.prog_id=s.stud_program";
$result = $conn->query($sql);

if(isset($_GET['message'])){
  $message = $_GET['message'];
  echo "<div class='alert alert-success'>$message</div>";
}

if($_GET['stud_id'])
{
  $s_id=$_GET['stud_id'];
  $sqlDel = "DELETE FROM student WHERE stud_id = '$s_id'";
  $resultDel = mysqli_query($conn, $sqlDel);

  if($resultDel)
  {
      //echo "Delete Success";
      redirect_for_admin('student-list.php', 'Student Deleted Successfully');
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
      <li class="breadcrumb-item">Student</li>
      <li class="breadcrumb-item active">List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div style="width: 1150px;" class="card">
        <div class="card-body">
          <h5 class="card-title">Students Datatable</h5>
          <p>This webpage contains a datatable displaying information about students.</p>

          <?php 
            if ($result->num_rows > 0) {
              echo "<div style=\"width: 1100px; overflow-x: auto;\"><table class=\"table datatable\"><thead><tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Program</th>
              <th>Year Level</th>
              <th>DOB</th>
              <th>Update</th>
              <th>Delete</th>
              </tr></thead><tbody>";
              // output data of each row
              while($row = $result->fetch_assoc()) {
                echo "<tr><th scope=\"row\">" . $row["stud_id"] . "</th><td>"
                . "<div style='display: flex; align-items: center;'><img src=\"" . $row["stud_pic"] . "\" alt=\"Teacher Image\" style=\"width: 50px; height: 50px; border-radius: 50%; margin-right: 15px;\">"  
                . $row["Name"] . "</td><td>" 
                . $row["stud_email"] . "</div></td><td>" 
                . $row["prog_name"] . "</td><td>" 
                . $row["stud_yearlvl"] . "</td><td>"
                . $row["stud_dob"] . "</td><td class = 'table_td'>"
                . "<a class='btn btn-outline-primary' href='student-update.php?stud_id={$row['stud_id']}'>
                Update
                </a>" . "</td><td class = 'table_td'>" 
                . "<a onClick=\"javascript:return confirm('Are you sure you want to delete this?');\" class='btn btn-outline-danger' href='student-list.php?stud_id={$row['stud_id']}'>
                Delete
                </a>" . "</td></tr>";
              }
              echo "</tbody></table></div>";
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