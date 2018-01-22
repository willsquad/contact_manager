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

        // Check for the hidden unique id:
        if ((filter_var($_POST['unique_id'], FILTER_SANITIZE_STRING) === $_POST['unique_id']) && (strlen($_POST['unique_id']) == 64)) {      
            $u_unique_id = (string)$_POST['unique_id'];
            $_SESSION['reg_unique_id'] = $u_unique_id;     
        } else {
            
        }
        
        
        // Check for a password and match against the confirmed password:
        
        if (($_POST['pass1'] === $_POST['pass2']) && (strlen($_POST['pass1']) <= 60)) {
            $p = $_POST['pass1'];
            $p = get_password_hash($p, $dbc);
        } else {
            $reg_errors['pass2'] = 'Your password did not match the confirmed password.';
        }
        

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

        $stmt = $dbc->prepare("SELECT `u_id`, `u_email` FROM `users_1792` WHERE u_email = ? AND u_unique_id = ? LIMIT 1");
					
        /* Bind variables to the prepared statement */
        $stmt->bind_param("ss", $e, $u_unique_id);
        
        /* execute query */
        $stmt->execute();
        
        /* Get the result */
        $r = $stmt->get_result();
    
        
        /* Get the number of rows */
        if($r->num_rows === 1) { /* Match found, update credentials */

            while($data = $r->fetch_assoc()) {
                $u_email = $data['u_email'];
                $u_id = $data['u_id'];
            }

             /*** CHANGE UNIQUE CODE  ***/
            $unique_id = md5(uniqid(time(), true));
            $user_activation_code = $unique_id.getToken(32);

            $stmt = $dbc->prepare("UPDATE users_1792 SET `u_pass` = ?, `u_user_ip` = INET6_ATON(?), `u_unique_id` = ? WHERE `u_email` = ? AND `u_id` = ?");		

            $stmt->bind_param("sssss", $p, $ipaddress, $user_activation_code, $u_email, $u_id);

            $stmt->execute();

            /* close statement */
            $stmt->close();
            
            
        } else {
            $reg_errors['user_exists'] = 'Sorry, this user account does not exist. Please try again later.';
            header("Location:".BASE_URL."forgot-password.php");
            exit();
        }
        
        
        if (empty($reg_errors)) { // If everything's OK... No messages to display

            
        } // End of empty($reg_errors) IF.
        else {
                    
                    
            $_SESSION['reg_errors'] = '';
            
            foreach($reg_errors as $errors) {
                $_SESSION['reg_errors'] .= '<div><i class="material-icons">warning</i> '.$errors.'</div>';
                
            }
            
            $dbc->close();
            header("Location:".BASE_URL."reset-password.php");
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
        <?php echo (isset($title)? $title : 'Contact Manager | Reset Password') ?>
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
                <form id="register_form" action="reset-password.php" method="post">
                <div class="row">
                    <div class="login_input_container col-12">
                        <input type="email" name="email" id="email_address" placeholder="email" value="<?php echo (isset($_GET['e'])?htmlspecialchars($_GET['e']):''); ?>" required>
                        <input type="hidden" name="unique_id" value="<?php echo (isset($_GET['u'])?htmlspecialchars($_GET['u']):''); ?>" required>
                        <i class="material-icons username_icon">email</i>
                    </div>
                    <div class="login_input_container col-12">
                        <input type="password" id="password" pattern=".{6,}" title="password should contain atleast 6 characters" name="pass1" placeholder="new password" required>
                        <i class="material-icons username_icon">lock</i>
                    </div>
                    <div class="login_input_container col-12">
                        <input type="password" id="confirm_password" pattern=".{6,}" title="password should contain atleast 6 characters" name="pass2" placeholder="confirm password" required>
                        <i class="material-icons username_icon">lock</i>
                    </div>
                    
                    <div class="login_input_container col-12">
                        <button type="submit" id="register_button">Change Password</button>
                    </div>
                </div>
                    
                </form>
                <div class="additional_options">
                    <a href="login.php" class="option">Login</a>
                    <a href="register.php" class="option">Register</a>
                </div>
            </div>    
        </div><!-- END OF ROW  -->
    </div><!-- END OF CONTAINER FLUID  -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <?php
    
    // remove all session variables
    session_unset(); 

    // destroy the session 
    session_destroy(); 
    
    ?>
</body>

</html>