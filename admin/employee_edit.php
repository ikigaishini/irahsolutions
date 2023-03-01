<?php
include "connection.php";
session_start();
header("Cache-Control: no-cache, must-revalidate");
if(isset($_SESSION["admin_email"])){
}else{
  header('location:login.php');
}

if(isset($_POST['update'])){
  $employee_id = $_GET['employee_id'];
  $firstName = $_POST['firstName'];
  $middleName = $_POST['middleName'];
  $lastName = $_POST['lastName'];
  $birthDate = $_POST['birthDate'];
  $upemail = $_POST['upemail'];
  $position = $_POST['position'];
  $status = $_POST['status'];
  $hireDate = $_POST['hireDate'];

  $query1 = $conn->query("UPDATE employee SET firstName='$firstName', middleName='$middleName', lastName='$lastName', birthDate='$birthDate', email='$upemail', position='$position', status='$status', hireDate='$hireDate' WHERE employee_id=$employee_id");

    $success = true;

  // Check if file was uploaded successfully
if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == 0) {
  // Get image data
  $image_name = $_FILES["profile_image"]["name"];
  $image_size = $_FILES["profile_image"]["size"];
  $image_tmp_name = $_FILES["profile_image"]["tmp_name"];
  $image_type = $_FILES["profile_image"]["type"];

  // Check if image type is valid
  if (strpos($image_type, "image/") !== 0) {
    $success = false;
  }else{
      // Set upload directory path
    $upload_dir = "profile_images/";
    $image_extension = "png";
    $image_path = $upload_dir . "employee_" . $employee_id . "." . $image_extension;
    echo $image_path." norm";

    // Move uploaded image to upload directory
    if (move_uploaded_file($image_tmp_name, $image_path)) {
      // Prepare and execute SQL statement to update user's profile image
      $query2 = $conn->query("UPDATE employee SET profile_image_path = '$image_path' WHERE employee_id = '$employee_id'"); 
    } else {
      $success = false;
    } 
  }

    
}

if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0) {
  // Get resume data
  $resume_name = $_FILES["resume"]["name"];
  $resume_size = $_FILES["resume"]["size"];
  $resume_tmp_name = $_FILES["resume"]["tmp_name"];
  $resume_type = $_FILES["resume"]["type"];

  // Check if resume type is valid
  if (strpos($resume_type, "application/pdf") !== 0) {
    $success = false;
  }else{
    // Set upload directory path
    $upload_dir = "resume_files/";
    $resume_extension = pathinfo($resume_name, PATHINFO_EXTENSION);
    $resume_path = $upload_dir . "employee_" . $employee_id . "." . $resume_extension;

    // Move uploaded resume to upload directory
    if (move_uploaded_file($resume_tmp_name, $resume_path)) {
      // Prepare and execute SQL statement to update employee's resume file path
      $query2 = $conn->query("UPDATE employee SET resume_file_path = '$resume_path' WHERE employee_id = '$employee_id'"); 
    } else {
      $success = false;
    } 
  }

    
}


}

  // Get employee ID from the URL
  $employee_id = $_GET['employee_id'];
  // Use the employee ID to retrieve the employee data from the database and display it in the form for editing
  // ...
  $query = $conn->query("SELECT * FROM employee WHERE employee_id = '$employee_id'");
    while($fetch = $query->fetch_array())
    {
        $firstName = $fetch['firstName'];
        $middleName = $fetch['middleName'];
        $lastName = $fetch['lastName'];
        $birthDate = $fetch['birthDate'];
        $email = $fetch['email'];
        $position = $fetch['position'];
        $status = $fetch['status'];
        $hireDate = $fetch['hireDate'];
        $profile_image = $fetch['profile_image_path'];
    } 

    if (!empty($profile_image)) {
      // Set image path to the value in the database
      $image_path = $profile_image;
    } else {
      // Set default image path
      $image_path = "profile_images/default.jpg";
    }
    $query3 = $conn->query("UPDATE employee SET profile_image_path = '$image_path' WHERE employee_id = '$employee_id'"); 
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Irah Solutions and Services</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-boxed">
<!-- Site wrapper -->
<div class="wrapper">
<?php include "navsidebar.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Employee Information</h1>
          </div>
          <div class="col-sm-6">    
          <img id="preview" src="<?php echo $profile_image ?>" alt="profile" width="150px" height="150px">     
          </div>


        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
              <form action="employee_edit.php?employee_id=<?php echo $employee_id ?>" method="POST" enctype="multipart/form-data">
              
              <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
                <div class="form-group">
                    <label for="profile_image">Upload Profile Image</label><br>
                    <input type="file" name="profile_image" id="profile_image" onchange="previewImage()">
                </div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" required class="form-control" name="firstName" value="<?php echo $firstName ?>" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" required class="form-control" name="lastName" value="<?php echo $lastName ?>" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                    <label for="upemail">Email</label>
                    <input type="email" required class="form-control" name="upemail" value="<?php echo $email ?>" placeholder="Enter Email">
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control select2" required name="status"  style="width: 100%;">
                    <option <?php if ($status == 'Active') echo 'selected'; ?>>Active</option>
                    <option <?php if ($status == 'Terminated') echo 'selected'; ?>>Terminated</option>
                    <option <?php if ($status == 'Retired') echo 'selected'; ?>>Retired</option>
                    <option <?php if ($status == 'Suspended') echo 'selected'; ?>>Suspended</option>
                    <option <?php if ($status == 'Probationary') echo 'selected'; ?>>Probationary</option>
                  </select>
                </div>

                

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
                    <label for="resume">Upload Resume</label><br>
                    <input type="file" name="resume" id="resume">
              </div>
              <div class="form-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" required class="form-control" name="middleName" value="<?php echo $middleName ?>" placeholder="Enter Middle Name">
               </div>
               <div class="form-group">
                  <label>Birth Date:</label>
                    <div class="input-group date" id="birthDate" data-target-input="nearest">
                        <input type="text" required name="birthDate" value="<?php echo $birthDate ?>" class="form-control datetimepicker-input" data-target="#birthDate"/>
                        <div class="input-group-append" data-target="#birthDate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <label>Position</label>
                  <select class="form-control select2" required name="position" style="width: 100%;">
                    <option <?php if ($position == 'Intern') echo 'selected'; ?>>Intern</option>
                    <option <?php if ($position == 'HR') echo 'selected'; ?>>HR</option>
                    <option <?php if ($position == 'IT') echo 'selected'; ?>>IT</option>
                    <option <?php if ($position == 'CEO') echo 'selected'; ?>>CEO</option>
                    <option <?php if ($position == 'President') echo 'selected'; ?>>President</option>
                    <option <?php if ($position == 'Supervisor') echo 'selected'; ?>>Supervisor</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Hire Date:</label>
                    <div class="input-group date" id="hireDate" data-target-input="nearest">
                        <input type="text" required name="hireDate" value="<?php echo $hireDate ?>" class="form-control datetimepicker-input" data-target="#hireDate"/>
                        <div class="input-group-append" data-target="#hireDate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="update" class="btn btn-block btn-outline-success">Update</button>
                </form> 
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
        
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>IRAH Solutions and Services Inc.</b>
    </div>
  </footer>
  </div>
  <!-- /.content-wrapper -->



</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>

<script>
$(function () {
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    //Money Euro
    $('[data-mask]').inputmask()

    $('#birthDate').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#hireDate').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'yyyy-mm-dd hh:mm A'
      }
    })
})
</script>

<script>
function previewImage() {
  var fileInput = document.getElementById('profile_image');
  var file = fileInput.files[0];
  var imageType = /image.*/;

  if (file.type.match(imageType)) {
    var preview = document.getElementById("preview");
    preview.src = '';

    var reader = new FileReader();
    reader.onload = function(e) {
      preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }
}
</script>

<script>
<?php if (isset($success) && $success): ?>
  toastr.success("Employee Information Successfully Updated");
<?php elseif (isset($success) && !$success): ?>
  toastr.warning("File Upload Failed");
<?php endif; ?>
</script>
<?php



?>

</body>

</html>
