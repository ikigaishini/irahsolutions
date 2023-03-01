<?php
include "connection.php";
session_start();
if(isset($_SESSION["admin_email"])){
}else{
  header('location:login.php');
}

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
            <h1>Add Employee Information</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <form action="employee_add.php" method="post">
        <div class="card card-default">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" required class="form-control" name="firstName" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" required class="form-control" name="lastName" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" required class="form-control" name="email" placeholder="Enter Email">
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control select2" required name="status" style="width: 100%;">
                    <option selected="selected">Active</option>
                    <option>Terminated</option>
                    <option>Retired</option>
                    <option>Suspended</option>
                    <option>Probationary</option>
                  </select>
                </div>
                

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" required class="form-control" name="middleName" placeholder="Enter Middle Name">
               </div>
               <div class="form-group">
                  <label>Birth Date:</label>
                    <div class="input-group date" id="birthDate" data-target-input="nearest">
                        <input type="text" required name="birthDate" class="form-control datetimepicker-input" data-target="#birthDate"/>
                        <div class="input-group-append" data-target="#birthDate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <label>Position</label>
                  <select class="form-control select2" required name="position" style="width: 100%;">
                    <option selected="selected">Intern</option>
                    <option>HR</option>
                    <option>IT</option>
                    <option>CEO</option>
                    <option>President</option>
                    <option>Supervisor</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Hire Date:</label>
                    <div class="input-group date" id="hireDate" data-target-input="nearest">
                        <input type="text" required name="hireDate" class="form-control datetimepicker-input" data-target="#hireDate"/>
                        <div class="input-group-append" data-target="#hireDate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="add" class="btn btn-block btn-outline-success">Submit</button>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          </div>
        </div>
      </form>   
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>IRAH Solutions and Services Inc.</b>
    </div>
  </footer>
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
</body>

<?php
  if(isset($_POST['add'])){
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $birthDate = $_POST['birthDate'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $status = $_POST['status'];
    $hireDate = $_POST['hireDate'];
    $profile_image = "profile_images/default.png";


    $check = $conn->query("SELECT count(*) as cntUser FROM employee WHERE email = '$email'");
    $row = mysqli_fetch_array($check);
    $count = $row['cntUser'];

    if($count > 0){
      echo '<script>
            toastr.error("Email already exist");
          </script>';
    }else{
      $query = $conn->query("INSERT INTO employee(firstName, middleName, lastName, birthDate, email, position, status, hireDate, profile_image_path) VALUES ('$firstName','$middleName','$lastName','$birthDate','$email','$position','$status','$hireDate', '$profile_image')");
      echo '<script>
            toastr.success("Employee Information Successfully Added");
          </script>';  
    }
    
  }
?>
</html>
