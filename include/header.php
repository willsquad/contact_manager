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
        <?php echo (isset($title)? $title : 'Contact Manager') ?>
    </title>
    <link rel="stylesheet" href="_files/css/bootstrap.css">
    <link rel="stylesheet" href="_files/css/style.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Open+Sans:300,400,600" rel="stylesheet">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- START OF LHS  -->
            <div class="col-12 col-sm-4 col-lg-3 col-xl-2 dashboard_lhs">
                <div class="dashboard_lhs__logo_div">
                    <h2 class="dashboard_lhs__logo_div__logo">Contact
                        <br>Manager</h2>
                </div>
                <div class="dashboard_lhs__user_div">
                    <img src="_files/images/profile.jpg" alt="">
                    <div class="dashboard_lhs__user_div__name_div">John Doe
                        <i class="material-icons">arrow_drop_down</i>
                    </div>
                </div>
                <div class="dashboard_lhs__nav_div">
                    <a href="<?php echo BASE_URL;?>" class="dashboard_lhs__nav_div__nav_item active">
                        <i class="material-icons">contacts</i> Contacts</a>
                    <a href="" class="dashboard_lhs__nav_div__nav_item">
                        <i class="material-icons">settings</i> Settings</a>
                    <a href="" class="dashboard_lhs__nav_div__nav_item">
                        <i class="material-icons">power_settings_new</i> Logout</a>
                </div>
            </div>
            <!-- END OF LHS  -->