<?php
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION['user_role']!='admin'){
    header("Location: ../../logout.php");
    exit;
}
include("../../database.php");
// connecting server
$c = connect_database("localhost", 'thoth', 'Thoth_0900');
$key = $_GET['courseCode'];
$query = "SELECT * FROM courses where course_code='$key';";
// echo $query; 
$data = mysqli_fetch_assoc(mysqli_query($c, $query));
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

    <!-- Custom fonts for this template-->
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
    document.getElementById('Courses').classList.add('active');
</script>
        <!-- main content starts here -->
        <div class="container-fluid d-flex justify-content-center">
        <form method="POST" action="edit_course_submit.php" class="user" style="width:60%">
            <br>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="course_code">Course Code</label>
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" name="course_code"
                                            value="<?php echo $data['course_code'];?>" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="course_name">Course Name</label>
                                        <input type="text" class="form-control form-control-user"  name="course_name"
                                        value="<?php echo $data['course_name'];?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="semester">Semester Offered</label>
                                    <input type="number" class="form-control form-control-user" name="semester_offered"
                                    value="<?php echo $data['semester_offered'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="assigned">Assigned to</label>
                                    <input type="text" class="form-control form-control-user" name="assigned_to"
                                    value="<?php echo $data['assigned_to'];?>">
                                </div>
                                
                                <br>
                                <input type="submit"class="btn btn-success btn-user btn-block" value="Update">
                                <!-- <a href="login.html" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </a> -->
                                
                            </form>

        </div>
        <!-- main content ends here -->

    <!-- including template second part -->
    <?php include('template_p2.php');?>


<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>let table = new DataTable('#dataTable',{
    'ordering':false,
});</script>
</body>

</html>