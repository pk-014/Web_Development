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
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $semester_offered = $_POST['semester_offered'];
    $assigned_to = $_POST['assigned_to'];
    $query = "update courses set assigned_to='$assigned_to',
            semester_offered='$semester_offered', course_name='$course_name'
             where course_code='$course_code';";
    echo $query;
    if (mysqli_query($c, $query)) {
        header("Location: courses.php");
    }
}

?>