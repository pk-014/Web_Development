<?php
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION['user_role']!='admin'){
    header("Location: ../../logout.php");
    exit;
}
include("../../database.php");
// connecting server
$c = connect_database("localhost", 'thoth', 'Thoth_0900');
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $course_code = $_POST['course'];
    $staff_id = $_POST['userID'];
    $query = "update courses set assigned_to='$staff_id' where course_code='$course_code';";
    if (mysqli_query($c, $query)) {
        header("Location: courses.php");
    }
}

?>