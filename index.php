<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo (isset($title)? $title : 'Contact Manager') ?></title>
    <link rel="stylesheet" href="_files/css/bootstrap.css">
    <link rel="stylesheet" href="_files/css/style.css">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Open+Sans:300,400,600" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-4 col-lg-3 col-xl-2 dashboard_lhs">
            <div class="dashboard_lhs__logo_div">
                <h2 class="dashboard_lhs__logo_div__logo">Contact<br>Manager</h2>
            </div>
            <div class="dashboard_lhs__user_div">
                <img src="_files/images/profile.jpg" alt="">
                <div class="dashboard_lhs__user_div__name_div">John Doe <i class="material-icons">arrow_drop_down</i></div>
            </div>
            <div class="dashboard_lhs__nav_div">
                <a href="" class="dashboard_lhs__nav_div__nav_item active"><i class="material-icons">contacts</i> Contacts</a>
                <a href="" class="dashboard_lhs__nav_div__nav_item"><i class="material-icons">settings</i> Settings</a>
                <a href="" class="dashboard_lhs__nav_div__nav_item"><i class="material-icons">power_settings_new</i> Logout</a>
            </div>
        </div>
        <div class="col-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 dashboard_rhs">
            <div class="dashboard_rhs__contacts_top_bar">
                <div class="dashboard_rhs__contacts_top_bar__page_heading"><i class="material-icons">contacts</i> Contacts</div>
                <div class="dashboard_rhs__contacts_top_bar__search"><i class="material-icons search_icon">search</i> <input type="search" placeholder="Search Everything..."></div>
                <div class="dashboard_rhs__contacts_top_bar__icons">
                    <i class="material-icons">notifications</i>
                    <i class="material-icons">more_horiz</i>
                </div>
            </div>
            <div class="dashboard_rhs__contacts_mid_bar">
                <div class="dashboard_rhs__contacts_mid_bar__lhs">
                    <button class="add_new_button"><i class="material-icons">add</i> Add New</button>
                </div>
                <div class="dashboard_rhs__contacts_mid_bar__rhs">
                    <i class="material-icons">view_list</i>
                    <i class="material-icons">filter_list</i>
                </div>
            </div>
            <div class="dashboard_rhs__contacts_content">
                <div class="dashboard_rhs__contacts_content__row row ">
                    <div class="dashboard_rhs__contacts_content__card_div col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="dashboard_rhs__contacts_content__card_div__card"></div>
                    </div>
                    <div class="dashboard_rhs__contacts_content__card_div col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="dashboard_rhs__contacts_content__card_div__card"></div>
                    </div>
                    <div class="dashboard_rhs__contacts_content__card_div col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="dashboard_rhs__contacts_content__card_div__card"></div>
                    </div>
                    <div class="dashboard_rhs__contacts_content__card_div col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="dashboard_rhs__contacts_content__card_div__card"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>