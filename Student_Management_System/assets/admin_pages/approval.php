<?php
session_start();
if(!isset($_SESSION["user_id"]) || $_SESSION['user_role']!='admin'){
    header("Location: ../../logout.php");
    exit;
}
include("../../database.php");
// connecting server
$c = connect_database("localhost", 'thoth', 'Thoth_0900');
if ($_SERVER['REQUEST_METHOD']=="POST") {
    $oldID = $_POST["oldID"];
    $id = $_POST['userID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $psw = $_POST['psw'];
    $role = $_POST['userRole'];
    $status = 'active';
    $query = "insert into staff(id, firstname, lastname, contact, email, hashed_password, user_role, user_status) value
            ('$id','$fname','$lname','$contact','$email','$psw','$role','$status')";
    if (mysqli_query($c, $query)) {
        $query = "delete from registration where id = '$oldID'";
        if (mysqli_query($c, $query)) {
            header('Location: registrations.php');
        }
        else {
            echo "Not deleted";
        }
        // header('Location: registrations.php');
    }
    else {
        echo "Not Inserted";
    }
}



?>