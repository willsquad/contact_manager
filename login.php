<?php
	
	// Require the configuration before any PHP code as the configuration controls error reporting:
	require('./include/config.inc.php');
    // The config file also starts the session.
    
    if(isset($_SESSION['user_id'])) {
        header("Location:".BASE_URL);
        exit();
    }
	
	// Require the database connection:
	require(MYSQL);
	
	$basename = basename($_SERVER['PHP_SELF']);
		
    //redirect_invalid_user();
    
    // For storing registration errors:
		$reg_errors = array();
		
		// Check for a form submission:
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			
			// Check for an email address:
			if ((filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === $_POST['email']) && (strlen($_POST['email']) <= 50)) {
					
				//$email_hash = md5( strtolower( trim($_POST['email']) ) );
                $e = $_POST['email'];
                $_SESSION['reg_email'] = $e;
				
				/* ideticon : https://www.gravatar.com/avatar/05d539ce0c31f79865017189565b0448?d=identicon */
				
			} else {
				$reg_errors['email'] = 'Please enter a valid email address.';
			}
			
			
			// Check for a password and match against the confirmed password:
			
			if ((isset($_POST['password'])) && (strlen($_POST['password']) <= 60)) {
				$p = $_POST['password'];
				$p = get_password_hash($p, $dbc);
			} else {
				$reg_errors['password'] = 'Please type in your password.';
			}
			
			
			if (empty($reg_errors)) { // If everything's OK...
					
					/* Prepare statement */
					$stmt = $dbc->prepare("SELECT `u_id` as user_id, `u_fname`, `u_lname`, `u_email`, `u_pass`, `u_reg_time`, `u_profile_pic`, INET_NTOA(u_user_ip) as user_ip FROM `users_1792` WHERE u_email = ? AND u_pass = ? LIMIT 1");
					
					/* Bind variables to the prepared statement */
					$stmt->bind_param("ss", $e, $p);
					
					/* execute query */
					$stmt->execute();
					
					 /* Get the result */
					$r = $stmt->get_result();
				
					
					/* Get the number of rows */
					if($r->num_rows === 1) { /* Match found, registered user */
						 
						 while($data = $r->fetch_assoc()) {
							$_SESSION['user_id'] = $data['user_id'];
							$_SESSION['u_email'] = $data['u_email'];
							$_SESSION['user_ip'] = $data['user_ip'];
							$_SESSION['u_fname'] = $data['u_fname'];
							$_SESSION['u_lname'] = $data['u_lname'];
							$_SESSION['u_reg_time'] = $data['u_reg_time'];
							$_SESSION['u_profile_pic'] = $data['u_profile_pic'];
						 }
						 
						  /* free results */
						 $stmt->free_result();
						 
						 /* close statement */
						 $stmt->close();
						 
	
						/* close connection */
						 $dbc->close();
						 
						 /* redirect user to the main page */
						 header("Location:".BASE_URL);
						 
						 /* Stop the page */
						 exit();
						 
					} else {
						
						$_SESSION['login_error'] = '<div><i class="material-icons">warning</i> Sorry, that email and password combination does not exist.</div>';
						
						/* close connection */
						$dbc->close();
						
						/* redirect user to the login page */
						header("Location:".BASE_URL."login.php");
						
						/* stop the script */
						exit();
					}
					
					
					$dbc->close();
					
				} else {
					// The email address or username is not available.
					
					$_SESSION['login_error'] = '<div><i class="material-icons">warning</i> Uh-oh, something went wrong. Please check your Email and Password again.</div>';
					$dbc->close();
					header("Location:".BASE_URL."login.php");
					exit();
				}
		
				/*** Procedural code removed from here ***/
				
			} // The file may already have been included by the header.
	
	

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>
        <?php echo (isset($title)? $title : 'Contact Manager | Login') ?>
    </title>
    <link rel="stylesheet" href="_files/css/bootstrap.css">
    <link rel="stylesheet" href="_files/css/style.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Open+Sans:300,400,600" rel="stylesheet">
</head>

<body class="">


    <div class="error_div animated slideInDown">
        <?php
            if(isset($_SESSION['login_error'])) {
                echo $_SESSION['login_error'];
            }
        ?>
    </div>

    <div class="container-fluid login_container">
        <div class="row login_container_row">

            
            
            <div class="col-12 logo">Contact<br>Manager</div>

            <div class="col-12 col-md-8 col-ld-5 col-xl-5 login_box">
                <form id="login_form" action="login.php" method="post">
                    <div class="login_input_container">
                        <input type="email" name="email" id="email_address" placeholder="email" value="<?php echo (isset($_SESSION['reg_email'])?htmlspecialchars($_SESSION['reg_email']):''); ?>" required>
                        <i class="material-icons username_icon">email</i>
                    </div>
                    <div class="login_input_container">
                        <input type="password" pattern=".{6,}" title="password should contain atleast 6 characters" name="password" id="password" placeholder="password" required>
                        <i class="material-icons username_icon">lock</i>
                    </div>
                    
                    <button type="submit" id="login_button">Login</button>
                </form>
                <div class="additional_options">
                    <a href="forgot-password.php" class="option">Password</a>
                    <a href="register.php" class="option">Register</a>
                </div>
            </div>    
        </div><!-- END OF ROW  -->
    </div><!-- END OF CONTAINER FLUID  -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="_files/js/main.js"></script> -->

    <?php
    
    // remove all session variables
    session_unset(); 

    // destroy the session 
    session_destroy(); 
    
    ?>

</body>

</html>