<?php
	
	// Require the configuration before any PHP code as the configuration controls error reporting:
	require('./include/config.inc.php');
	// The config file also starts the session.
	
	// Require the database connection:
	require(MYSQL);
	
	$basename = basename($_SERVER['PHP_SELF']);
		
	//redirect_invalid_user();
	
	

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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



    <div class="container-fluid login_container">
        <div class="row login_container_row">

        <div class="col-12 logo">Contact<br>Manager</div>

            <div class="col-12 col-md-8 col-ld-5 col-xl-5 login_box">
                <form id="login_form" action="#" method="post">
                    <div class="login_input_container">
                        <input type="text" id="login_username" placeholder="email">
                        <i class="material-icons username_icon">email</i>
                    </div>
                    <div class="login_input_container">
                        <input type="text" id="login_password" placeholder="password">
                        <i class="material-icons username_icon">lock</i>
                    </div>
                    
                    
                    <button id="login_button">Login</button>
                </form>
                <div class="additional_options">
                    <a href="forgot-password.php" class="option">Password</a>
                    <a href="register.php" class="option">Register</a>
                </div>
            </div>    
        </div><!-- END OF ROW  -->
    </div><!-- END OF CONTAINER FLUID  -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="_files/js/main.js"></script>
</body>

</html>