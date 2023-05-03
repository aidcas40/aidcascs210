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

$sql = "SELECT t.tchr_id, CONCAT(t.tchr_fname, ' ', t.tchr_lname) AS Name, t.tchr_email, t.tchr_cellnum, t.tchr_pic, d.dep_name FROM `teacher` t INNER JOIN `department` d ON d.dep_id=t.tchr_department";
$result = $conn->query($sql);

if(isset($_GET['message'])){
    $message = $_GET['message'];
    echo "<div class='alert alert-success'>$message</div>";
}

if($_GET['tchr_id'])
{
    $t_id=$_GET['tchr_id'];
    $sqlDel = "DELETE FROM teacher WHERE tchr_id = '$t_id'";
    $resultDel = mysqli_query($conn, $sqlDel);

    if($resultDel)
    {
        //echo "Delete Success";
        redirect_for_admin('teacher-list.php', 'Teacher Deletd Successfully.');
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
      <li class="breadcrumb-item">Teacher</li>
      <li class="breadcrumb-item active">List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div style="width: 11000px;" class="card">
        <div class="card-body">
          <h5 class="card-title">Teachers Datatable</h5>
          <p>This webpage contains a datatable displaying information about teachers.</p>

          <?php 
            if ($result->num_rows > 0) {
              echo "<div style=\"width: 1000px; overflow-x: auto;\"><table class=\"table datatable\"><thead><tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone #</th>
              <th>Departmet</th>
              <th>Update</th>
              <th>Delete</th>
              </tr></thead><tbody>";
              // output data of each row
              while($row = $result->fetch_assoc()) {
                echo "<tr><th scope=\"row\">" . $row["tchr_id"] . "</th><td>"
                . "<div style='display: flex; align-items: center;'><img src=\"" . $row["tchr_pic"] . "\" alt=\"Teacher Image\" style=\"width: 50px; height: 50px; border-radius: 50%; margin-right: 15px;\">" 
                . "<a href='teacher-update.php?tchr_id={$row['tchr_id']}'>"
                . $row["Name"] . "</div></td><td>" 
                . $row["tchr_email"] . "</td><td>" 
                . $row["tchr_cellnum"] . "</td><td>" 
                . $row["dep_name"] . "</td><td class = 'table_td'>"
                . "<a class='btn btn-outline-primary' href='teacher-update.php?tchr_id={$row['tchr_id']}'>
                Update
                </a>" . "</td><td class = 'table_td'>" 
                . "<a onClick=\"javascript:return confirm('Are you sure you want to delete this?');\" class='btn btn-outline-danger' href='teacher-list.php?tchr_id={$row['tchr_id']}'>
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