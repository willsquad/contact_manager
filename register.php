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
            $e = $_POST['email'];
            $_SESSION['reg_email'] = $e;     
        } else {
            $reg_errors['email'] = 'Please enter a valid email address.';
        }
        
        // Check for a last name:
        if (preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['fn'])) {
            $fn = (string)$_POST['fn'];
            $_SESSION['reg_fn'] = $fn;
        } else {
            $reg_errors['first_name'] = 'Please enter your first name.';
            
        }

        // Check for a last name:
        if (preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['ln'])) {
            $ln = (string)$_POST['ln'];
            $_SESSION['reg_ln'] = $ln;
        } else {
            $reg_errors['last_name'] = 'Please enter your last name.';
        }
        
        // Check for a password and match against the confirmed password:
        
        if (($_POST['pass1'] === $_POST['pass2']) && (strlen($_POST['pass1']) <= 60)) {
            $p = $_POST['pass1'];
            $p = get_password_hash($p, $dbc);
        } else {
            $reg_errors['pass2'] = 'Your password did not match the confirmed password.';
        }
        
        $unique_id = md5(uniqid(time(), true));
        $user_activation_code = $unique_id.getToken(32);
        
        $u_reg_time = time();

        // Function to get the client IP address
        function get_client_ip() {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
            $ipaddress = 'UNKNOWN';
            
            if (!filter_var($ipaddress, FILTER_VALIDATE_IP) === false) {
            return $ipaddress;
            } else {
            $ipaddress = 0;
            return $ipaddress;
            }
            
        }
        
        $ipaddress = get_client_ip();

        $stmt = $dbc->prepare("SELECT `u_id` FROM `users_1792` WHERE u_email = ? LIMIT 1");
					
        /* Bind variables to the prepared statement */
        $stmt->bind_param("s", $e);
        
        /* execute query */
        $stmt->execute();
        
        /* Get the result */
        $r = $stmt->get_result();
    
        
        /* Get the number of rows */
        if($r->num_rows === 1) { /* Match found, cannot register user */
            $reg_errors['user_exists'] = 'Sorry, a user account with this email already exists. <a href="forgot-password.php" style="color: #fff; text-decoration: underline;">Click here</a> to reset your password.';
        }
        
        
        if (empty($reg_errors)) { // If everything's OK...

           
                    
                    $stmt = $dbc->prepare("INSERT INTO users_1792 (u_fname, u_lname, u_email, u_pass, u_reg_time, u_user_ip, u_unique_id) VALUES (?, ?, ?, ?, ?, INET6_ATON(?), ?)");
                
                    $stmt->bind_param("ssssiss", $fn, $ln, $e, $p, $u_reg_time, $ipaddress, $user_activation_code);
                    
                    $stmt->execute();
                    
                   
                    if($dbc->affected_rows === 1) {		// LOGIN
                        

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
							echo "Sorry, that email and password combination was not right.";

							
							 $stmt->close();
							 $dbc->close();
							 exit();
						}
                         
                    } else {
                        $stmt->close();
                        $dbc->close();	
                        //echo "Sorry, you could not be registerd due to a system error.";
                        header("Location:".BASE_URL."register.php");
                        exit();
                    }

                
                $dbc->close();
                

    
            /*** Procedural code removed from here ***/
            
        } // End of empty($reg_errors) IF.
        else {
                    
                    
            $_SESSION['reg_errors'] = '';
            
            foreach($reg_errors as $errors) {
                $_SESSION['reg_errors'] .= '<div><i class="material-icons">warning</i> '.$errors.'</div>';
                
            }
            
            $dbc->close();
            header("Location:".BASE_URL."register.php");
            exit();
        }
    
    } // End of the main form submission conditional.
    
    // Need the form functions script, which defines create_form_input():
    // The file may already have been included by the header.
    
    else {
        
        /* if Request Method != POST */
       
        
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>
        <?php echo (isset($title)? $title : 'Contact Manager | Register') ?>
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
            if(isset($_SESSION['reg_errors'])) {
                echo $_SESSION['reg_errors'];
            }
        ?>
    </div>
    <div class="container-fluid login_container">
        <div class="row login_container_row">

        <div class="col-12 logo">Contact<br>Manager</div>

            <div class="col-12 col-md-8 col-ld-5 col-xl-5 login_box">
                <form id="register_form" action="register.php" method="post">
                <div class="row">
                    <div class="login_input_container fn_container col-12 col-sm-6">
                        <input type="text" name="fn" id="fn" placeholder="first name" value="<?php echo (isset($_SESSION['reg_fn'])?htmlspecialchars($_SESSION['reg_fn']):''); ?>" required>
                        <i class="material-icons username_icon">person</i>
                    </div>
                    <div class="login_input_container ln_container col-12 col-sm-6">
                        <input type="text" name="ln" id="ln" placeholder="last name" value="<?php echo (isset($_SESSION['reg_ln'])?htmlspecialchars($_SESSION['reg_ln']):''); ?>" required>
                        <i class="material-icons username_icon">person</i>
                    </div>
                    <div class="login_input_container col-12">
                        <input type="email" name="email" id="email_address" placeholder="email" value="<?php echo (isset($_SESSION['reg_email'])?htmlspecialchars($_SESSION['reg_email']):''); ?>" required>
                        <i class="material-icons username_icon">email</i>
                    </div>
                    <div class="login_input_container col-12">
                        <input type="password" id="password" pattern=".{6,}" title="password should contain atleast 6 characters" name="pass1" placeholder="password" required>
                        <i class="material-icons username_icon">lock</i>
                    </div>
                    <div class="login_input_container col-12">
                        <input type="password" id="confirm_password" pattern=".{6,}" title="password should contain atleast 6 characters" name="pass2" placeholder="confirm password" required>
                        <i class="material-icons username_icon">lock</i>
                    </div>
                    
                    <div class="login_input_container col-12">
                        <button type="submit" id="register_button">Register</button>
                    </div>
                </div>
                    
                </form>
                <div class="additional_options">
                    <a href="forgot-password.php" class="option">Password</a>
                    <a href="login.php" class="option">Login</a>
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