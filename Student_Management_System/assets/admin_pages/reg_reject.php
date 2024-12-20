<?php
session_start();
if(!isset($_SESSION["user_id"]) || $_SESSION['user_role']!='admin'){
    header("Location: ../../logout.php");
    exit;
}
include("../../database.php");
// connecting server
$c = connect_database("localhost", 'thoth', 'Thoth_0900');
if ($_SERVER['REQUEST_METHOD']=="GET") {
    $id = $_GET["regId"];
    $query = "delete from registration where id = '$id'";
    if (mysqli_query($c, $query)) {
        header('Location: registrations.php');
    }
    else {
        echo "Not deleted";
    }
}



?>