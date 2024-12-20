<?php
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION['user_role']!='admin'){
    header("Location: ../../logout.php");
    exit;
}
include("../../database.php");
// connecting server
$c = connect_database("localhost", 'thoth', 'Thoth_0900');
$courses = mysqli_query($c, 'Select * from courses ORDER BY `assigned_to` DESC');

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Asad">

    <title>UE Attendance Management System - Courses</title>

    <!-- Custom fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Table CDN -->
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" rel="stylesheet" />
    
    <!-- Custom styles-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
   
</head>

<body id="page-top">
    <!-- including tempalate first part -->
    <?php include('template_p1.php');?>
<script>
    document.getElementById('Home').classList.remove('active'); 
    document.getElementById('Courses').classList.add('active');
</script>
        <!-- main content starts here -->
        <div class="container-fluid">
           
        <!-- DataTales Example -->
         <div class="d-flex justify-content-end">
         <a href="add_course.php" class="btn btn-primary align-right">Add Course</a>
         </div>
<br>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Courses</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Course Code</th>
                                            <th>Course Name</th>
                                            <th>Semester Offered</th>
                                            <th>Assigned to</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Course Code</th>
                                            <th>Course Name</th>
                                            <th>Semester Offered</th>
                                            <th>Assigned to</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                    while ($data = mysqli_fetch_assoc($courses)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $data['course_code'];?></td>
                                            <td><?php echo $data['course_name'];?></td>
                                            <td><?php echo $data['semester_offered'];?></td>
                                            <td><?php echo $data['assigned_to'];?></td>
                                            <td>
                                                <a href="edit_course.php?courseCode=<?php echo $data['course_code'];?>" class="btn btn-success" >
                                                Edit
                                                </a> 
                                                
                                            </td>
                                        </tr>
                                    <?php 
                                    }
                                    ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


        </div>
        <!-- main content ends here -->

    <!-- including template second part -->
    <?php include('template_p2.php');?>


    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>let table = new DataTable('#dataTable',{
    'ordering':false,
});</script>
<style>
    label[for=dt-length-0]{
        margin-left: 14px;
    }
</style>

</body>

</html>