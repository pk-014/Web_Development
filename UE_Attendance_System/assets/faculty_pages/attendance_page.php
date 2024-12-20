<?php
session_start();

if(!isset($_SESSION["user_id"]) || ($_SESSION['user_role']!='faculty' && $_SESSION['user_role']=='admin' )){
    header("Location: ../../logout.php");
    exit;
}
include("../../database.php");
// connecting server
$c = connect_database("localhost", 'thoth', 'Thoth_0900');
$id = $_SESSION["user_id"];
$attendance_course = $_GET["courseTable"];
$students = mysqli_query($c, "Select * from $attendance_course;");
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Asad">

    <title>UE Attendance Management System - Attendance</title>

    <!-- Custom fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
   
</head>

<body id="page-top">
    <!-- including tempalate first part -->
    <?php include('template_p1.php');?>
<script>
    document.getElementById('Home').classList.remove('active'); 
    document.getElementById('Attendance').classList.add('active');
</script>
        <!-- main content starts here -->
        <div class="container-fluid">
           
        <!-- DataTales Example -->
      
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Courses Teaching</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="submit_attendance.php?courseTable=<?php echo $attendance_course;?>" method="POST">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php 
                                    while ($data = mysqli_fetch_assoc($students)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $data['st_id'];?></td>
                                            <td><?php echo $data['st_name'];?></td>
                                            <td>
                                            <input type="radio" id="present_<?php echo $data['st_id'];?>" name="attendance_<?php echo $data['st_id'];?>" value="present">
                                              <label for="present_<?php echo $data['st_id'];?>">Present</label>
                                              <input type="radio" id="absent_<?php echo $data['st_id'];?>" name="attendance_<?php echo $data['st_id'];?>" value="absent">
                                              <label for="absent_<?php echo $data['st_id'];?>">Absent</label>
                                            </td>
                                        </tr>
                                    <?php 
                                    }
                                    ?>
                                       
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


        </div>
        <!-- main content ends here -->

    <!-- including template second part -->
    <?php include('template_p2.php');?>




</body>

</html>