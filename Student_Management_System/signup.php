
<?php
// including database related functions
include('database.php');
// connecting database
$conn = connect_database("localhost", 'thoth', 'Thoth_0900');
// checking request method
if($_SERVER['REQUEST_METHOD']=='POST'){
    // accessing data post by user
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $hashedpassword = hash('sha256' , $_POST['password']); //passsword stored in hashed form
    if($conn){
        // connecting registration table
        $connect_table = connect_registration_table($conn);
        if($connect_table){
            // inserting data into registration table
            $query = "insert into registration(firstname, lastname, contact, email, hashed_password) 
            values ('$fname', '$lname', '$contact', '$email','$hashedpassword');";
            try {
                $sql = mysqli_query($conn, $query);
                if($sql){
                    // displaying success message
                    $message = '<div class="alert alert-success alert-dismissible fade show" role="alert" id="message_alert">
      <strong>Registered Successfully!</strong> You will receive an email with more details.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="close_alert()" style="background:none;border:none;">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
                    echo $message;
                }
            else{
                // displaying error message
                $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="message_alert">
      <strong>Registeration Failed!</strong> You will receive an email with more details.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="close_alert()" style="background:none;border:none;">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
                    echo $message;
            }

            } catch (Exception $e) {
                // displaying error message
                $message = '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="message_alert">
      <strong>Registeration Failed!</strong> You will receive an email with more details.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="close_alert()" style="background:none;border:none;">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
                    echo $message;
            }
            
    }
}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Font -->
	<!-- <link rel="stylesheet" href="assets/css/material-icon/css/material-design-iconic-font.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"> 
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Other CDN -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet"> -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- Custom CSS -->
     <link rel="stylesheet" href="assets/css/style.css">
    <title>Sign Up - UE Attendance System</title>
</head>
<body>
<section class="signup" style="margin-top: 2em;" >
            <div class="container">
                <div class="signup-content" > 
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="" onsubmit="return validate()" >
                            <div class="form-group">
                                <label for="fname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="fname" id="fname" required placeholder="First Name"/>
                            </div>
                            <div class="form-group">
                                <label for="lname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="lname" id="lname" required placeholder="Last Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" required placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="contact"><i class="zmdi zmdi-phone"></i></label>
                                <input type="tel" name="contact" id="contact" required placeholder="Your Contact"/>
                            </div>
                            <div class="form-group">
                                
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass"  required placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass"  required placeholder="Repeat your password"/>
                                
                            </div>
                            <!-- <div class="form-group">
                                <span id="error" style="color: red;"></span>
                                <input type="checkbox" name="agree-term" id="agree-term" required class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I certify that the information I have provided is accurate and complete.</label>
                            </div> -->
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="https://img.freepik.com/free-vector/privacy-policy-concept-illustration_114360-7853.jpg?t=st=1733234917~exp=1733238517~hmac=ebe3aacad30bd60e66fb307c7d7a4095f1528bfdd06c1ad4031dc84faa51fb50&w=740" alt="sing up image"></figure>
                        <a href="./" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>


<script>
function close_alert() {
    document.getElementById('message_alert').style.display='none';
}
function validate() {
    // let fname = document.getElementById('fname');
    // let lname = document.getElementById('lname');
    // let email = document.getElementById('email');
    // let contact = document.getElementById('contact');
    let password = document.getElementById('pass');
    let re_password = document.getElementById('re_pass');
    
    if (password.value !== re_password.value) {
    alert('Passwords do not match.');
    // document.getElementById('error').textContent = '*';  
    password.focus();
    return false;}
    else{
        return true;
    }
  
}


</script>
</body>
</html>


