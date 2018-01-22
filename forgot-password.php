<?php
    
    
    require("sendgrid-php/sendgrid-php.php");


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
        

        $stmt = $dbc->prepare("SELECT `u_fname`, `u_lname`, `u_email`, `u_unique_id`  FROM `users_1792` WHERE u_email = ? LIMIT 1");
					
        /* Bind variables to the prepared statement */
        $stmt->bind_param("s", $e);
        
        /* execute query */
        $stmt->execute();
        
        /* Get the result */
        $r = $stmt->get_result();
    
        
        /* Get the number of rows */
        if($r->num_rows == 1) { /* Match found, send reset link */

            while($data = $r->fetch_assoc()) {
                $u_email = $data['u_email'];
                $u_fname = $data['u_fname'];
                $u_lname = $data['u_lname'];
                $u_unique_id = $data['u_unique_id'];
            }

            $u_fullname = $u_fname.' '.$u_lname;

            /* free results */
            $stmt->free_result();
            
            /* close statement */
            $stmt->close();
            

        /* close connection */
            $dbc->close();


            /************** Set Values here **************/
            $mail_to_address = $u_email;
            /*$mail_to_address_CC = "willsquad.aj@gmail.com";*/
            $mailed_from_display_address = "mail@contactmanager.com";

            $subject = "Password reset";
            
            $message_part = "<div style=\"font-size: 16px;margin-top: 30px;font-family:Helvetica;\">We've received a password reset request for this account. If you wish to proceed, <a href=\"".BASE_URL."reset-password.php?e=$u_email&u=".$u_unique_id."\">click here</a> to create a new password. \n\n Please ignore this message if you did not make this request or if you've remembered your password.</div> \n\n\n";

            $message = nl2br($message_part);
       
            $from = new SendGrid\Email("Contact Manager | Password Reset", $mailed_from_display_address);
            $subject = $subject;
            $to = new SendGrid\Email($u_fullname, $mail_to_address);
            $content = new SendGrid\Content("text/html", $message);
            $mail = new SendGrid\Mail($from, $subject, $to, $content);
            $apiKey = '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';
            $sg = new \SendGrid($apiKey);
            $response = $sg->client->mail()->send()->post($mail);

            $_SESSION['success'] = '<div class="success"><i class="material-icons">check</i>Password reset link has been successfully sent to your registered email.</div>';


            header("Location:".BASE_URL."forgot-password.php");
            exit();

        } else {
            // Email does not exist in the DB, but don't let the user know this as it's a security issue.
            $reg_errors['email_not_found'] = "Uh, oh. Something went wrong. Please try again later.";
        }
        
        
        if (empty($reg_errors)) { // If everything's OK...
            
            
        } // End of empty($reg_errors) IF.
        else {
                    
                    
            $_SESSION['reg_errors'] = '';
            
            foreach($reg_errors as $errors) {
                $_SESSION['reg_errors'] .= '<div><i class="material-icons">warning</i> '.$errors.'</div>';
                
            }
            
            $dbc->close();
            header("Location:".BASE_URL."forgot-password.php");
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
        <?php echo (isset($title)? $title : 'Contact Manager | Forgot Password') ?>
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
            if(isset($_SESSION['success'])){
                echo $_SESSION['success'];
            }else if(isset($_SESSION['reg_errors'])) {
                echo $_SESSION['reg_errors'];
            }
        ?>
    </div>


    <div class="container-fluid login_container">
        <div class="row login_container_row">

        <div class="col-12 logo">Contact<br>Manager</div>

            <div class="col-12 col-md-8 col-ld-5 col-xl-5 login_box">
                <form id="password_form" action="forgot-password.php" method="post">
                    <div class="login_input_container">
                        <input type="email" name="email" id="email_address" placeholder="registered email" value="<?php echo (isset($_SESSION['reg_email'])?htmlspecialchars($_SESSION['reg_email']):''); ?>" required>
                        <i class="material-icons username_icon">email</i>
                    </div>                    
                    
                    <button type="submit" id="password_button">Reset Password</button>
                </form>
                <div class="additional_options">
                    <a href="login.php" class="option">Login</a>
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