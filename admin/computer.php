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
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            <h1>Computers (Laptops and Desktops)</h1>
          </div>
          <div class="col-sm-3">
            <button type="button" class="btn btn-block btn-success" onclick="window.location.href='computer_add.php'">Add Computer Device</button>
          </div>
          

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Image</th>
                    <th>Model Name</th>
                    <th>System Model</th>
                    <th>Color</th>
                    <th>Assigned Employee</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

    <?php 
    $query = $conn->query("SELECT * FROM computer JOIN employee ON computer.employee_id = employee.employee_id ORDER BY model_name");
    while($fetch = $query->fetch_array())
    {
    ?>
                  <tr>
                  <td><img src="<?php echo $fetch['computer_image_path'] ?>" alt="computer_images/default.jpg" width="100px" height="75px"></td>
                    <td><?php echo $fetch['model_name'] ?></td>
                    <td><?php echo $fetch['system_model'] ?></td>
                    <td><?php echo $fetch['color'] ?></td>
                    <td><?php echo $fetch['firstName']." ".$fetch['lastName'] ?></td>
                    <td><?php echo $fetch['computer_status'] ?></td>
                    <td><button type="button" class="btn btn-block btn-success btn-sm" onclick="window.location.href='computer_edit.php?computer_id=<?php echo $fetch['computer_id'] ?>'">View</button></td>
                  </tr>
    <?php } ?>
                  </tbody>

                </table>

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
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

</body>
</html>
