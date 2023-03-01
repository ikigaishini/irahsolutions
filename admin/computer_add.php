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
            <h1>Add Computer Device</h1>
          </div>
          <div class="col-sm-6">    
            <img id="preview" src="images/laptop.png" alt="computer" height="300px">     
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <form action="computer_add.php" method="post" enctype="multipart/form-data">
        <div class="card card-default">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="modelName">Model Name</label>
                    <input type="text" required class="form-control" name="modelName" placeholder="Enter Model Name">
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" required class="form-control" name="color" placeholder="Enter Color">
                </div>
                <div class="form-group">
                    <label for="ram">RAM</label>
                    <input type="text" required class="form-control" name="ram" placeholder="Enter CPU">
                </div>
                <div class="form-group">
                    <label for="storage">Storage</label>
                    <input type="text" required class="form-control" name="storage" placeholder="Enter Storage">
                </div>
                <div class="form-group">
                    <label for="accountUsername">Account Username</label>
                    <input type="text" required class="form-control" name="accountUsername" placeholder="Enter Account Username">
                </div>
                
                <div class="form-group">
                  <label>Operating System</label>
                  <select class="form-control select2" required name="operatingSystem" style="width: 100%;">
                    <option selected="selected">Windows 7</option>
                    <option>Windows 8</option>
                    <option>Windows 10</option>
                    <option>Windows 11</option>
                    <option>Linux</option>
                    <option>MacOS</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control select2" required name="status" style="width: 100%;">
                    <option selected="selected">Operational</option>
                    <option>Available</option>
                    <option>Needs repair</option>
                    <option>Needs upgrade</option>
                    <option>Missing</option>
                    <option>Out of Service</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="computer_image">Upload Computer Image</label><br>
                    <input type="file" name="computer_image" id="computer_image" onchange="previewImage()">
                </div>
                

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
                    <label for="systemModel">System Model</label>
                    <input type="text" required class="form-control" name="systemModel" placeholder="Enter System Model">
              </div>
              <div class="form-group">
                    <label for="cpu">CPU</label>
                    <input type="text" required class="form-control" name="cpu" placeholder="Enter CPU">
                </div>
              <div class="form-group">
                    <label for="ramAddtl">Ram Additional (Optional)</label>
                    <input type="text" required class="form-control" name="ramAddtl" placeholder="Enter Additional RAM">
              </div>
              <div class="form-group">
                    <label for="storageAddtl">Storage Additional (Optional)</label>
                    <input type="text" required class="form-control" name="storageAddtl" placeholder="Enter Additional Storage">
              </div>
              <div class="form-group">
                    <label for="accountPassword">Account Password</label>
                    <input type="text" required class="form-control" name="accountPassword" placeholder="Enter Account Password">
              </div>
                <div class="form-group">
                  <label>Employee Assigned</label>
                  <select class="form-control select2" required name="employee_id" style="width: 100%;">
                  <?php 
                  $query = $conn->query("SELECT * FROM employee ");
                  while($fetch = $query->fetch_array()){
                  ?>
                      <option value="<?php echo $fetch['employee_id'] ?>"><?php echo $fetch['firstName']." ".$fetch['lastName'] ?></option>
                  <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <input type="textarea" required class="form-control" name="remarks" placeholder="Enter Remarks">
                </div>
                <div class="form-group">
                  <br>
                <button type="submit" name="add" class="btn btn-block btn-outline-success">Submit</button>
                </div>
                
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
function previewImage() {
  var fileInput = document.getElementById('computer_image');
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

</body>

<?php
if(isset($_POST['add'])){
  $model_name = $_POST['modelName'];
  $system_model = $_POST['systemModel'];
  $color = $_POST['color'];
  $cpu = $_POST['cpu'];
  $ram = $_POST['ram'];
  $ram_addtl = $_POST['ramAddtl'];
  $storage = $_POST['storage'];
  $storage_addtl = $_POST['storageAddtl'];
  $operating_system = $_POST['operatingSystem'];
  $account_username = $_POST['accountUsername'];
  $account_password = $_POST['accountPassword'];
  $employee_id = $_POST['employee_id'];
  $status = $_POST['status'];
  $remarks = $_POST['remarks'];

  $check = $conn->query("SELECT count(*) as cntComp FROM computer WHERE model_name = '$model_name'");
  $row = mysqli_fetch_array($check);
  $count = $row['cntComp'];

  if($count > 0){
    echo '<script>
          toastr.error("Computer already exists");
        </script>';
  }else{
    // Insert new record into the database
    $query = $conn->query("INSERT INTO computer(model_name, system_model, color, cpu, ram, ram_addtl, storage, storage_addtl, operating_system, account_username, account_password, employee_id, computer_status, remarks) VALUES ('$model_name','$system_model','$color','$cpu','$ram','$ram_addtl','$storage','$storage_addtl','$operating_system','$account_username','$account_password','$employee_id','$status','$remarks')");

    // Retrieve the new computer_id value
    $computer_id = $conn->insert_id;

    // Rename the computer image file to include the computer_id value
    if (isset($_FILES["computer_image"]) && $_FILES["computer_image"]["error"] == 0) {
      // Get image data
      $image_name = $_FILES["computer_image"]["name"];
      $image_size = $_FILES["computer_image"]["size"];
      $image_tmp_name = $_FILES["computer_image"]["tmp_name"];
      $image_type = $_FILES["computer_image"]["type"];

      // Check if image type is valid
      if (strpos($image_type, "image/") !== 0) {
        $success = false;
      } else {
        // Set upload directory path
        $upload_dir = "computer_images/";
        $image_extension = "png";
        $image_path = $upload_dir . "computer_" . $computer_id . "." . $image_extension;

        // Move uploaded image to upload directory
        if (move_uploaded_file($image_tmp_name, $image_path)) {
          // Prepare and execute SQL statement to update computer's image path
          $query2 = $conn->query("UPDATE computer SET computer_image_path = '$image_path' WHERE computer_id = $computer_id");
        } else {
          $success = false;
        }
      }
    }else{
      $image_path = "images/laptop.png";
    }

    echo '<script>
          toastr.success("Computer device successfully added");
        </script>';
  }  
}


?>
</html>
