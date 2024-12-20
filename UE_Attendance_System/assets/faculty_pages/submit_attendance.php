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

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $text = "Submitted By: ".$id."<br>Course Code: ".str_replace("_students","",$attendance_course)." <br>Date: ".date("Y/m/d")."<hr>"."<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>";
    while ($data = mysqli_fetch_assoc($students)) {
        
        $text.= "<tr><td>".$data['st_id']."</td><td>".$data['st_name']."</td>
            <td>".$_POST["attendance_".$data['st_id']]."</td></tr>";        
    }
    $text.= "</table>";
    echo $text;
}
?>

