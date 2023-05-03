<?php
require __DIR__ . '/../src/bootstrap.php';
require_login();
error_reporting(0);
?>
<?php
$conn = mysqli_connect($host, $user, $password, $db);
?>

<?php view('header_admin', ['title' => 'CS210 - Aiden Castillo - Dashboard']) ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="card-body">
                <h5 class="card-title">Users <span>| Total Registered</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <?php
                    $total_users_query = "SELECT * FROM users";
                    $total_users_query_run = mysqli_query($conn, $total_users_query);

                    if ($total_user = mysqli_num_rows($total_users_query_run)) {
                      echo '<h6>' . $total_user . '</h6>';
                    } else {
                      echo '<h6>None</h6>';
                    }

                    ?>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">Students <span>| Total Attending</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-mortarboard"></i>
                  </div>
                  <div class="ps-3">
                    <?php
                    $total_stud_query = "SELECT * FROM student";
                    $total_stud_query_run = mysqli_query($conn, $total_stud_query);

                    if ($total_stud = mysqli_num_rows($total_stud_query_run)) {
                      echo '<h6>' . $total_stud . '</h6>';
                    } else {
                      echo '<h6>None</h6>';
                    }

                    ?>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-md-6">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Teachers <span>| Total Hired</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fas fa-chalkboard-teacher"></i>
                  </div>
                  <div class="ps-3">
                    <?php
                    $total_tchr_query = "SELECT * FROM teacher";
                    $total_tchr_query_run = mysqli_query($conn, $total_tchr_query);

                    if ($total_tchr = mysqli_num_rows($total_tchr_query_run)) {
                      echo '<h6>' . $total_tchr . '</h6>';
                    } else {
                      echo '<h6>None</h6>';
                    }

                    ?>

                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->

          <div class="col-xxl-4 col-md-6">

            <div class="card info-card courses-card">

              <div class="card-body">
                <h5 class="card-title">Courses <span>| Total Offered</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3">
                    <?php
                    $total_crs_query = "SELECT * FROM course";
                    $total_crs_query_run = mysqli_query($conn, $total_crs_query);

                    if ($total_crs = mysqli_num_rows($total_crs_query_run)) {
                      echo '<h6>' . $total_crs . '</h6>';
                    } else {
                      echo '<h6>None</h6>';
                    }

                    ?>

                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->
        </div>
      </div><!-- End Left side columns -->

      <?php
      $query_stud_gender = "SELECT stud_gender, COUNT(*) AS count FROM student GROUP BY stud_gender";
      $result_stud_gender = mysqli_query($conn, $query_stud_gender);
      $genderCounts = mysqli_fetch_all($result_stud_gender, MYSQLI_ASSOC);

      // Calculate the total number of students
      $totalStudents = array_reduce($genderCounts, function ($sum, $genderCount) {
        return $sum + $genderCount['count'];
      }, 0);

      // Calculate the percentage of male and female students
      $femalePercentage = ($totalStudents > 0) ? round(($genderCounts[0]['count'] / $totalStudents) * 100) : 0;
      $malePercentage = ($totalStudents > 0) ? round(($genderCounts[1]['count'] / $totalStudents) * 100) : 0;

      // Output the chart with the updated data
      ?>

      <!-- Right side columns -->
      <div class="col-lg-4">

        <!-- Website Traffic -->
        <div class="card">
          <div class="card-body pb-0">
            <h5 class="card-title">Student Gender <span>| Distribution</span></h5>

            <div id="trafficChart" style="min-height: 280px;" class="echart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                echarts.init(document.querySelector("#trafficChart")).setOption({
                  tooltip: {
                    trigger: 'item'
                  },
                  legend: {
                    top: '5%',
                    left: 'center'
                  },
                  series: [{
                    name: 'Access From',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                      show: false,
                      position: 'center'
                    },
                    emphasis: {
                      label: {
                        show: true,
                        fontSize: '18',
                        fontWeight: 'bold'
                      }
                    },
                    labelLine: {
                      show: false
                    },
                    data: [{
                      value: <?php echo $malePercentage; ?>,
                      name: 'Male'
                    },
                    {
                      value: <?php echo $femalePercentage; ?>,
                      name: 'Female'
                    }]
                  }]
                });
              });
            </script>

          </div>
        </div><!-- End Website Traffic -->
      </div><!-- End Right side columns -->

    </div>
    <div row>
      <?php
      $query_prog_stud = "SELECT p.prog_name, COUNT(s.stud_id) AS count FROM student s INNER JOIN program p ON p.prog_id=s.stud_program GROUP BY stud_program";
      $result_prog_stud = mysqli_query($conn, $query_prog_stud);
      $programCounts = mysqli_fetch_all($result_prog_stud, MYSQLI_ASSOC);

      // Calculate the total number of students
      // Extract the program names into a new array
      $programNames = array_map(function ($programCount) {
        return $programCount['prog_name'];
      }, $programCounts);

      // Extract the number of students for each program into a new array
      $programStudentCounts = array_map(function ($programCount) {
        return $programCount['count'];
      }, $programCounts);

      // Output the chart with the updated data
      // Output the chart with the updated data
      ?>

      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Program Distributions</h5>

            <!-- Bar Chart -->
            <canvas id="barChart" style="max-height: 400px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#barChart'), {
                  type: 'bar',
                  data: {
                    labels: <?php echo json_encode($programNames); ?>,
                    datasets: [{
                      label: 'Programs',
                      data: <?php echo json_encode($programStudentCounts); ?>,
                      backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                      ],
                      borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              });
            </script>
            <!-- End Bar CHart -->

          </div>
        </div>
      </div>
    </div>

    <?php
    $sql = "SELECT s.stud_id, CONCAT(s.stud_fname, ' ', s.stud_lname) AS Name, s.stud_email, s.stud_pic, p.prog_name FROM `student` s INNER JOIN `program` p ON p.prog_id=s.stud_program";
    $result = $conn->query($sql);

    if (isset($_GET['message'])) {
      $message = $_GET['message'];
      echo "<div class='alert alert-success'>$message</div>";
    }

    if ($_GET['stud_id']) {
      $s_id = $_GET['stud_id'];
      $sqlDel = "DELETE FROM student WHERE stud_id = '$s_id'";
      $resultDel = mysqli_query($conn, $sqlDel);

      if ($resultDel) {
        //echo "Delete Success";
        redirect_for_admin('index_admin.php', 'Student Deleted Successfully');
      }
    }
    ?>

    <div class="row">
      <div class="col-lg-12">

        <div id="admin_message">
          <?php if (!empty($message)): ?>
            <div class="alert alert-success">
              <?php echo $message; ?>
            </div>
          <?php endif; ?>
        </div>

        <div style="width: 990px;" class="card">
          <div class="card-body">
            <h5 class="card-title">Students Datatable</h5>
            <?php
            if ($result->num_rows > 0) {
              echo "<div style=\"width: 950px; overflow-x: auto;\"><table class=\"table datatable\"><thead><tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Program</th>
              <th>Update</th>
              <th>Delete</th>
              </tr></thead><tbody>";
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                echo "<tr><th scope=\"row\">" . $row["stud_id"] . "</th><td>"
                  . "<div style='display: flex; align-items: center;'><img src=\"" . $row["stud_pic"] . "\" alt=\"Teacher Image\" style=\"width: 50px; height: 50px; border-radius: 50%; margin-right: 15px;\">"
                  . $row["Name"] . "</td><td>"
                  . $row["stud_email"] . "</div></td><td>"
                  . $row["prog_name"] . "</td><td class = 'table_td'>"
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