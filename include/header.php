<?php
	
	// Require the configuration before any PHP code as the configuration controls error reporting:
	require('./include/config.inc.php');
	// The config file also starts the session.
	
	// Require the database connection:
	require(MYSQL);
	
	$basename = basename($_SERVER['PHP_SELF']);
		
	redirect_invalid_user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>
        <?php echo (isset($title)? $title : 'Contact Manager') ?>
    </title>
    <link rel="stylesheet" href="_files/css/bootstrap.css">
    <link rel="stylesheet" href="_files/css/style.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Open+Sans:300,400,600" rel="stylesheet">
</head>

<body class="">



    <div class="container-fluid">
        <div class="row">


        <div class="prompt_overlay col-12">
            <div class="prompt_message_div col-12 col-sm-6 col-md-7 col-lg-5 col-xl-4 animated slideInDown">
                <p>Are you sure you want to delete <span id="delete_contact_count"></span> contact(s)?</p>
                
                <div class="prompt_button_container">
                    <button class="prompt_button confirm_delete">Yes</button>
                    <button class="prompt_button cancel_delete">No</button>
                </div>
            </div>
            <div class="prompt_no_contacts_selected_div col-12 col-sm-6 col-md-7 col-lg-5 col-xl-4 animated slideInDown">
                <p>Please select a contact to proceed.</p>
                <div class="prompt_button_container">
                    <button class="prompt_button cancel_delete">Close</button>
                </div>
            </div>

            <div class="prompt_export_contacts col-12 col-sm-6 col-md-7 col-lg-5 col-xl-4 animated slideInDown">
                <p>Please select the export format.</p>
                <div class="prompt_button_container">
                    <button class="prompt_button export_csv">.csv</button>
                    <button class="prompt_button export_vcf">.vcf</button>
                    <button class="prompt_button cancel_delete cancel_delete_export"><i class="material-icons">close</i></button>
                </div>
            </div>
        </div>

            <!-- START OF LHS  -->
            <div class="col-12 col-sm-4 col-lg-3 col-xl-2 dashboard_lhs hidden-xs-down">
                <div class="dashboard_lhs__logo_div">
                    <h2 class="dashboard_lhs__logo_div__logo">Contact
                        <br>Manager</h2>
                </div>
                <div class="dashboard_lhs__user_div">
                    <img src="_files/images/<?php echo $_SESSION['u_profile_pic']; ?>" alt="">
                    <div class="dashboard_lhs__user_div__name_div"><?php echo $_SESSION['u_fname'].' '.$_SESSION['u_lname']; ?>
                        <i class="material-icons">arrow_drop_down</i>
                    </div>
                </div>
                <div class="dashboard_lhs__nav_div">
                    <a href="<?php echo BASE_URL;?>" class="dashboard_lhs__nav_div__nav_item active">
                        <i class="material-icons">contacts</i> Contacts</a>
                    <a href="#" class="dashboard_lhs__nav_div__nav_item">
                        <i class="material-icons">settings</i> Settings</a>
                    <a href="logout.php" class="dashboard_lhs__nav_div__nav_item">
                        <i class="material-icons">power_settings_new</i> Logout</a>
                </div>
            </div>

            <div class="col-12 col-sm-4 col-lg-3 col-xl-2 dashboard_lhs dashboard_lhs_xs hidden-sm-up">
                <div class="dashboard_lhs__logo_div">
                    <a href="<?php echo BASE_URL;?>">
                        <h2 class="dashboard_lhs__logo_div__logo"><i class="material-icons">contacts</i> Cm</h2>
                    </a>
                </div>
                <div class="xs_menu_button" data-status="0">
                    <i class="material-icons">menu</i>
                </div>
            </div>


            <div class="mobile_menu_content hidden-sm-up">
                <div class="mobile_menu_content__container">
                    <div class="mobile_menu_content__user_div">
                        <img src="_files/images/<?php echo $_SESSION['u_profile_pic']; ?>" alt="">
                        <div class="mobile_menu_content__user_div__name_div"><?php echo $_SESSION['u_fname'].' '.$_SESSION['u_lname']; ?>
                            <i class="material-icons">arrow_drop_down</i>
                        </div>
                    </div>
                    <div class="mobile_menu_content__nav_div">
                        <a href="<?php echo BASE_URL;?>" class="mobile_menu_content__nav_div__nav_item active">
                            <i class="material-icons">contacts</i> Contacts</a>
                        <a href="#" class="mobile_menu_content__nav_div__nav_item">
                            <i class="material-icons">settings</i> Settings</a>
                        <a href="#" class="mobile_menu_content__nav_div__nav_item">
                            <i class="material-icons">power_settings_new</i> Logout</a>
                    </div>
                </div>
                
            </div>
            <!-- END OF LHS  -->