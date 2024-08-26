

<!DOCTYPE html>
<html>
<head>
	  <title>Login page</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="#">
        <img src="assets/images/vlogo.jpeg" alt="Logo" style="height: 40px;">
      </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link text-white mr-3" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white mr-3" href="index.php#about">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white mr-3" href="index.php#contact">Contact Us</a>
        </li>
         </ul>
    </div>
    </nav>




	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="assets/images/vlogo.jpeg" class="brand_logo" alt="Logo">
					</div>
				</div>



				<?php
        /*Certainly! The PHP isset() function is used to check if a
         variable is set and is not NULL. In the context of your code
          snippet, if(isset($_GET['sign-up'])){ ?>, it’s checking if the sign-up index
           exists within the global $_GET array and that it is not NULL. */
				if(isset($_GET['sign-up'])){
          ?>

<div class="d-flex justify-content-center form_container">
					<form method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="su_username" class="form-control input_user"  placeholder="USERID">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="text" name="su_firstname" class="form-control input_pass"  placeholder="First Name">
						</div>

            <div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="text" name="su_lastname" class="form-control input_pass"  placeholder="Last Name">
						</div>

            <div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="su_password" class="form-control input_pass"  placeholder="password">
						</div>

						<div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="su_retype_password" class="form-control input_pass" placeholder="Retype Password" required />
                                </div>

							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="sign_up_btn" class="btn login_btn">Sign Up</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						<!-- ?sign-up=1 is a query string parameter that can be used by the website to show the sign-up form-->
						Already registered? <a href="login.php" class="ml-2"><button class="btn login_btn">Sign In</button></a>
					</div>

          <?php         
				}


        else if(isset($_GET['admin-sign'])){
          ?>
<div class="d-flex justify-content-center form_container">
<form method="POST">
<div class="input-group mb-3">
  <div class="input-group-append">
    <span class="input-group-text"><i class="fas fa-user"></i></span>
  </div>
  <input type="text" name="a_username" class="form-control input_user" placeholder="Admin Id" required/>
</div>
<div class="input-group mb-2">
  <div class="input-group-append">
    <span class="input-group-text"><i class="fas fa-key"></i></span>
  </div>
  <input type="password" name="a_password" class="form-control input_pass" placeholder="Admin Password" required/>
</div>


  <div class="d-flex justify-content-center mt-3 login_container">
<button type="submit" name="a_sign_in_btn" class="btn login_btn">Login</button>
</div>
</form>   
</div>


<div class="mt-4">
					<div class="d-flex justify-content-center links">
						<!-- ?sign-up=1 is a query string parameter that can be used by the website to show the sign-up form-->
						Login as Voter <a href="login.php" class="ml-2"><button class="btn login_btn">Sign In</button></a>
					</div>

<?php

        }



				else{
				?>
          <div class="d-flex justify-content-center form_container">
					<form method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" placeholder="USERID" required/>
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" placeholder="password" required/>
						</div>
						

							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="loginBtn" class="btn login_btn">Login</button>
				   </div>
					</form>   
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						<!-- ?sign-up=1 is a query string parameter that can be used by the website to show the sign-up form-->
						Don't have an account? <a href="signup.php?sign-up=1" class="ml-2"><button class="btn login_btn">Sign Up</button></a>
					</div>
				</div>

        <div class="mt-4">
					<div class="d-flex justify-content-center links">
						<!-- ?sign-up=1 is a query string parameter that can be used by the website to show the sign-up form-->
						Login as admin <a href="?admin-sign=1" class="ml-2"><button class="btn login_btn">Admin Login</button></a>
					</div>
				</div>
			
				<?php
                    }



           


                    
                ?>

                <?php 
                    if(isset($_GET['registered']))
                    {
                ?>
                        <span class="bg-white text-success text-center my-3">  Account created but not verified! </span>
                <?php
                    }else if(isset($_GET['invalid'])) {
                ?>
                        <span class="bg-white text-danger text-center my-3"> Passwords mismatched, please try again! </span>
                <?php
                    }else if(isset($_GET['not_registered'])) {
                ?>
                        <span class="bg-white text-warning text-center my-3"> Sorry, you are not registered! </span>
                <?php
                    }else if(isset($_GET['invalid_access'])) {
                ?>
                        <span class="bg-white text-danger text-center my-3"> Invalid username or password! </span>
                <?php
                    }else if(isset($_GET['invalid_status'])) {
                        ?>
                                <span class="bg-white text-danger text-center my-3"> Yet to verify! </span>
                        <?php
                            }
                ?>

			</div>
		</div>
	</div>


  <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>









  </body>
</html>






<?php

require_once("admin/inc/config.php");


if(isset($_POST['a_sign_in_btn']))
    {
        $a_username = mysqli_real_escape_string($db, $_POST['a_username']);
        $a_password = mysqli_real_escape_string($db, $_POST['a_password']);
        

        // Query Fetch / SELECT
        $fetchingData = mysqli_query($db, "SELECT * FROM e_admin WHERE  a_id= '". $a_username ."'") or die(mysqli_error($db));

        
        if(mysqli_num_rows($fetchingData) > 0)
        {
            $data = mysqli_fetch_assoc($fetchingData);

            if($a_username == $data['a_id'] AND $a_password == $data['a_pass'])
            {	
              session_start();
              $_SESSION['username'] = $data['a_id'];
              // $_SESSION['admin_id'] = $data['a_id'];
              
              ?>
				<script> location.assign("admin/index.php?homepage=1"); </script>
		<?php

            }else {
        ?>
                <script> location.assign("login.php?admin-sign=1&invalid_access=1"); </script>
        <?php
            }


        }else {
    ?>
            <script> location.assign("login.php?admin-sign=1&not_registered=1"); </script>
    <?php

        }

    }









else if(isset($_POST['sign_up_btn']))
{
	$su_username = mysqli_real_escape_string($db, $_POST['su_username']);
	$su_firstname = mysqli_real_escape_string($db, $_POST['su_firstname']);
	$su_lastname = mysqli_real_escape_string($db, ($_POST['su_lastname']));
	$su_password = mysqli_real_escape_string($db, sha1($_POST['su_password']));
	$su_retype_password = mysqli_real_escape_string($db, sha1($_POST['su_retype_password']));
    $status = "InActive";

	if($su_password == $su_retype_password)
        {
            // Insert Query 

            mysqli_query($db, "INSERT INTO voter(username, f_name, l_name, pass, v_status) VALUES
			('". $su_username ."', '". $su_firstname ."', '". $su_lastname ."', '". $su_password ."', '". $status ."')") or die(mysqli_error($db));

        ?>
            <script> location.assign("login.php?sign-up=1&registered=1"); </script>
        <?php

        }else {
    ?>
            <script> location.assign("login.php?sign-up=1&invalid=1"); </script>
    <?php
        }

}
else if(isset($_POST['loginBtn']))
    {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, sha1($_POST['password']));
        

        // Query Fetch / SELECT
        $fetchingData = mysqli_query($db, "SELECT * FROM voter WHERE  username= '". $username ."'") or die(mysqli_error($db));

        
        if(mysqli_num_rows($fetchingData) > 0)
        {
            $data = mysqli_fetch_assoc($fetchingData);

            if($username == $data['username'] AND $password == $data['pass'])
            {


                if ($data['v_status'] == 'Active') {
                    session_start();
                    $_SESSION['username'] = $data['f_name'];
                    $_SESSION['user_id'] = $data['v_id'];
                    ?>
                    <script> location.assign("voters/index.php"); </script>
                    <?php
                     } else {
                        ?>
                       <script> location.assign("login.php?invalid_status=1"); </script>
                        <?php
                    }

            }else {
        ?>
                <script> location.assign("login.php?invalid_access=1"); </script>
        <?php
            }


        }else {
    ?>
            <script> location.assign("signup.php?sign-up=1&not_registered=1"); </script>
    <?php

        }

    }





?>
