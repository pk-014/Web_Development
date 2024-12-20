<?php
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION['user_role']!='admin'){
    header("Location: ../../logout.php");
    exit;
}
include("../../database.php");
// connecting server
$c = connect_database("localhost", 'thoth', 'Thoth_0900');
$id = $_GET['userId'];
$query = "SELECT * FROM staff where id='$id';";
$data = mysqli_fetch_assoc(mysqli_query($c, $query));
$courses = mysqli_query($c, 'select * from courses');
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Asad">

    <title>UE Attendance Management System - Home</title>

    <!-- Custom fonts for this template-->
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
    document.getElementById('Faculty').classList.add('active');
</script>
        <!-- main content starts here -->
        <div class="container-fluid d-flex justify-content-center">
        <form method="POST" action="assign_course_submit.php" class="user" style="width:60%">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" name="fname"
                                            value="<?php echo $data['firstname'];?>" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName" name="lname"
                                        value="<?php echo $data['lastname'];?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email"
                                    value="<?php echo $data['email'];?>" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="contact"
                                    value="<?php echo $data['contact'];?>" readonly>
                                </div>
                                <div class="form-group hidden">
                                    <input type="hidden" class="form-control form-control-user" id="exampleInputEmail" name="psw"
                                    value="<?php echo $data['hashed_password'];?>" >
                                </div>
                                    <div class="form-row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input required type="text" class="form-control form-control-user" id="ID" name="userID"
                                            value="<?php echo $data['id'];?>" readonly>
                                    </div>
                                    <div class="form-group col-sm-6 mb-3 mb-sm-0">
                                    <select required id="role" class="form-control form-control-user" name="course">
                                        <option selected disabled value="">Choose Course</option>
                                        <?php while ($data = mysqli_fetch_assoc($courses)) {
                                        ?>
                                            <option value="<?php echo $data['course_code'];?>"><?php echo $data['course_name']?></option>
                                        <?php }?>
                                    </select>
                                    </div>
                                </div>
                                <br>
                                <input type="submit"class="btn btn-success btn-user btn-block" value="Assign Course">
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