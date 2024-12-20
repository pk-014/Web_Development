
<?php
// starting session
session_start();
// including database related functions
include('database.php');
// connecting server
$c = connect_database("localhost", 'thoth', 'Thoth_0900');
// checking request method
if ($_SERVER['REQUEST_METHOD']=='POST') {
    // retreiving data post by user
    $user_id = strtolower($_POST['uid']); //concerting to lowercase
    $user_password = hash('sha256' , $_POST['upassword']); //hasing the password
    if($c){
        // connecting staff table
        $connect_table = connect_staff_table($c);
        if($connect_table){
            // getting user data from database
            $sql = "select * from staff where id='$user_id';";
			$result = mysqli_fetch_assoc(mysqli_query($c, $sql));
            // $fetched_password = $result["hashed_password"];
			// $user_status = $result["user_status"];
            // checking whether user is active and valid password
            if ($user_password == $result["hashed_password"] && $result["user_status"] == "active") {
				// saving credentials in session
				$_SESSION["user_id"] = $result["id"];
				$_SESSION["user_name"] = $result["firstname"]." ". $result["lastname"];
				$_SESSION["user_contact"] = $result["contact"];
				$_SESSION["user_email"] = $result["email"];
                $_SESSION['user_role'] = $result['user_role'];
                // displaying success message
                // $message = '<div class="alert alert-success alert-dismissible fade show" role="alert" id="message_alert">
                // <strong>Welcome </strong>'.$_SESSION["user_name"].'
                // <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="close_alert()" style="background:none;border:none;">
                // <span aria-hidden="true">&times;</span>
                // </button>
                // </div>';
                // echo $message;
				// echo "<script>window.alert('Welcome $_SESSION['user_name'].')</script>";
                if($result["user_role"] == "admin"){
                    // redirecting to admin page
                    header('Location: assets/admin_pages/index.php');
                }
                else{    
				// redirecting
				header('Location: assets/faculty_pages/index.php');
                }
            }
            else{
                // Displaying user not found message
                $message = '<div class="alert alert-danger alert-dismissible w-auto show"  role="alert" id="message_alert">
                <strong>User Not Found!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="close_alert()" style="background:none;border:none;">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
                echo $message;
                // echo "<script>window.alert('User not matched')</script>";
                // header('Location: ./');
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
    <!-- other CDN -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- Custom CSS -->
     <link rel="stylesheet" href="assets/css/style.css">
    <title>UE Attendance System</title>
</head>
<body>
	<!-- <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Have an account?</h3>
		      	<form action="" class="signin-form" method="POST">
		      		<div class="form-group">
		      			<input name="uid" "text" class="form-control" placeholder="User ID" required>
		      		</div>
	            <div class="form-group">
	              <input name="upassword" id="password-field" type="password" class="form-control" placeholder="Password" required>
	              <span id="eye-open" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="cursor: pointer;" onclick="toggle()"></span>
                  <span id="eye-close" toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password" style="cursor: pointer;visibility: hidden;" onclick="toggleAgain()"></span>
	            </div>
	            <div class="form-group">
	            	<input type="submit" class="form-control btn btn-primary submit px-3" value="Sign In">
	            </div>
	            <div class="form-group d-md-flex">
	            	
								<div class="center w-100 text-md-center">
									<span>Not a member? </span><a href="#" style="color: #fbceb5">Sign Up</a>
								</div>
	            </div>
	          </form>
	          <p class="w-100 text-center" style="visibility: hidden;">&mdash; Or Sign In With &mdash;</p>
	          <div class="social d-flex text-center" style="visibility: hidden;">
	          	<a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
	          	<a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section> -->

        <!-- Sing in  Form -->
        <section class="sign-in " style="margin-top: 2em;">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="https://img.freepik.com/free-vector/mobile-login-concept-illustration_114360-83.jpg?t=st=1733234325~exp=1733237925~hmac=9d6547971810dac10e844d87424826fa36d2fcb36f0f8eb52a1961c7c2d8f7a0&w=740" alt="sing up image"></figure>
                        <a href="signup.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign In</h2>
                        <form method="POST" class="register-form" id="login-form" action="">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="uid" id="your_name" required placeholder="Your ID"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="upassword" required id="your_pass" placeholder="Password"/>
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div> -->
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <!-- <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>

    



	
    <script>
        function close_alert() {
    document.getElementById('message_alert').style.display='none';
}
        // function toggle(){
        //     document.getElementById('password-field').setAttribute('type','text');
        //     document.getElementById('eye-close').style.visibility='visible';
        //     document.getElementById('eye-open').style.visibility='hidden';
        // }
        // function toggleAgain(){
        //     document.getElementById('password-field').setAttribute('type','password');
        //     document.getElementById('eye-close').style.visibility='hidden';
        //     document.getElementById('eye-open').style.visibility='visible';
        // }
    </script>
  <!-- <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="assets/js/script.js"></script> -->

	</body>
</html>