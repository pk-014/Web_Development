<?php
function connect_database($server_name, $username, $user_password){
    $conn = mysqli_connect($server_name, $username, $user_password);
    if ($conn) {
        $dbs = mysqli_query($conn, 'show databases;');
        $flag = false;
        while($db = mysqli_fetch_assoc($dbs)){
            if($db['Database']=='UE'){
                $flag = true;
            }
        }
        if($flag){
            mysqli_close($conn);
            $connection = mysqli_connect($server_name, $username, $user_password, 'UE');
            if(!$connection){
                header('Location: error.php');
                die("Connection failed: " . mysqli_connect_error());
            }
            return $connection;
        }
        else{
            try {
                $sql = mysqli_query($conn, 'create database UE;');
                if($sql){
                    mysqli_close($conn);
                    $connection = mysqli_connect($server_name, $username, $user_password, 'UE');
                    if(!$connection){
                        header('Location: error.php');
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    return $connection;
                }
            } catch (Exception $e) {
                echo $e;
            }
            
        }
    }
    else{
        return false;
    }
}

function connect_staff_table($connection){
    try {

        $sql = mysqli_query($connection, 'show tables;');
        while($table = mysqli_fetch_array($sql, MYSQLI_NUM)){
            if($table[0] == 'staff'){
                return true;
            }
        }
        $query = "CREATE TABLE staff 
        (id VARCHAR(10) PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        contact VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(50) NOT NULL UNIQUE,
        hashed_password VARCHAR(255) NOT NULL,
        user_role ENUM('admin', 'faculty') NOT NULL , 
        user_status ENUM('active', 'disabled') NOT NULL);";
        
        if (mysqli_query($connection, $query)) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        // header('Location: error.php');
        die("Connection failed: " . mysqli_connect_error());
        
    }
    
}

function connect_registration_table($connection){
    try {
        $sql = mysqli_query($connection, 'show tables;');
        while($table = mysqli_fetch_array($sql, MYSQLI_NUM)){
            if($table[0] == 'registration'){
                return true;
            }
        }
        $query = "CREATE TABLE registration 
        (id INT PRIMARY KEY AUTO_INCREMENT,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        contact VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(50) NOT NULL UNIQUE,
        hashed_password VARCHAR(255) NOT NULL);";
        
        if (mysqli_query($connection, $query)) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        header('Location: error.php');
        die("Connection failed: " . mysqli_connect_error());
        
    }
    
}




?>