<?php 

include('include/header.php');

?>

<!-- START OF RHS  -->
<div class="col-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 dashboard_rhs animated fadeIn">

    <!-- START OF TOP BAR  -->
    <div class="dashboard_rhs__contacts_top_bar">
        <div class="dashboard_rhs__contacts_top_bar__page_heading">
            <a class="top_bar_contacts_a" href="<?php echo BASE_URL;?>">
                <i class="material-icons">contacts</i> Contacts
            </a>
        </div>
        <div class="dashboard_rhs__contacts_top_bar__search hidden-md-down">
            <i class="material-icons search_icon">search</i>
            <input type="search" placeholder="Search Everything...">
        </div>
        <div class="dashboard_rhs__contacts_top_bar__icons">
            <i class="material-icons">notifications</i>
            <i class="material-icons">more_horiz</i>
        </div>

    </div>
    <!-- END OF TOP BAR  -->

    <?php
if(isset($_GET['u'])) {
    $c_id = (int)$_GET['u'];

    $result = $dbc->query("SELECT `c_id`, `c_fname`, `c_lname`, `c_mname`, `c_email`, `c_phone`, `c_organization`, `c_jobTitle`, `c_workPhone`, `c_dob`, `c_gender`, `c_profile_pic`, `c_website`, `c_linkedin`, `c_twitter`, `c_facebook`, `c_additionalSocial`, `c_additionalPhones`, `c_additionalEmails`, `c_unique_id`, `c_added_time`, `c_modified_time`, `c_favorite`, `added_by_u_id` FROM `contacts_8521` WHERE `c_id` = $c_id LIMIT 1");
    if($result->num_rows == 1) { // Results found
        while($data = $result->fetch_assoc()) {
            $c_fname = $data['c_fname'];
            $c_lname = $data['c_lname'];
            $c_mname = $data['c_mname'];
            $c_email = $data['c_email'];
            $c_phone = $data['c_phone'];
            $c_organization = $data['c_organization'];
            $c_jobTitle = $data['c_jobTitle'];
            $c_workPhone = $data['c_workPhone'];
            $c_dob = $data['c_dob'];
            $c_gender = $data['c_gender'];
            $c_profile_pic = $data['c_profile_pic'];
            $c_website = $data['c_website'];
            $c_linkedin = $data['c_linkedin'];
            $c_twitter = $data['c_twitter'];
            $c_facebook = $data['c_facebook'];
            $c_additionalSocial = $data['c_additionalSocial'];
            $c_additionalPhones = $data['c_additionalPhones'];
            $c_additionalEmails = $data['c_additionalEmails'];
            $c_unique_id = $data['c_unique_id'];
            $c_added_time = $data['c_added_time'];
            $c_modified_time = $data['c_modified_time'];
            $c_favorite = $data['c_favorite'];
            $added_by_u_id = $data['added_by_u_id'];
        }
?>


        <!-- START OF MID BAR  -->
        <div class="dashboard_rhs__contacts_mid_bar dashboard_rhs__view_contact_mid_bar">
            <div class="dashboard_rhs__view_contact_mid_bar__lhs">
                <a href="<?php echo BASE_URL;?>">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>

            <div class="dashboard_rhs__view_contact_mid_bar__center">
                <div class="user_image">
                    <img src="_files/images/<?php echo $c_profile_pic; ?>" alt="">
                </div>
                <div class="user_name_div">
                    <div class="contact_text">Contact</div>
                    <div class="user_name">
                        <?php echo $c_fname; ?>
                        <?php echo $c_lname; ?>
                    </div>
                </div>
            </div>

            <div class="dashboard_rhs__view_contact_mid_bar__rhs hidden-md-down">
                <a href="edit-contact.php?u=<?php echo $c_id; ?>">
                    <i class="material-icons">edit</i>
                </a>
                <div class="favorite_icon favorite_icon_js" data-fav="<?php echo $c_favorite;?>" data-cid="<?php echo $c_unique_id;?>">
                    <i class="material-icons <?php echo (($c_favorite == 1)?'active':'') ?>">favorite</i>
                </div>
                <i class="material-icons">share</i>
            </div>

            <div class="dashboard_rhs__add_contact_mid_bar__rhs hidden-lg-up">
                <i class="material-icons">more_vert</i>
            </div>

        </div>
        <!-- END OF MID BAR  -->

        <!-- START OF RHS CONTENT  -->
        <div class="dashboard_rhs__contacts_content">
            <div class="dashboard_rhs__contacts_content__row row ">

                <!-- START OF INFO CARD  -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 info_card_div">
                    <div class="info_card">
                        <div class="info_card__card_heading">
                            Contact Details
                        </div>

                        <div class="row info_card__content_row">
                            <div class="col-12 col-sm-12 col-md-6 info_card__info_block_div">
                                <div class="info_card__info_block_div__info_block">
                                    <div class="block_title">
                                        First Name:
                                    </div>
                                    <div class="block_value">
                                        <?php echo if_not_empty($c_fname); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 info_card__info_block_div">
                                <div class="info_card__info_block_div__info_block">
                                    <div class="block_title">
                                        Last Name:
                                    </div>
                                    <div class="block_value">
                                        <?php echo if_not_empty($c_lname); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 info_card__info_block_div">
                                <div class="info_card__info_block_div__info_block">
                                    <div class="block_title">
                                        Phone:
                                    </div>
                                    <div class="block_value">
                                        <a href="tel:<?php echo if_not_empty($c_phone); ?>">
                                            <?php echo if_not_empty($c_phone); ?>
                                        </a>   
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 info_card__info_block_div">
                                <div class="info_card__info_block_div__info_block">
                                    <div class="block_title">
                                        Email:
                                    </div>
                                    <div class="block_value">
                                        <a href="mailto:<?php echo if_not_empty($c_email); ?>">
                                            <?php echo if_not_empty($c_email); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 info_card__info_block_div">
                                <div class="info_card__info_block_div__info_block">
                                    <div class="block_title">
                                        Organization:
                                    </div>
                                    <div class="block_value">
                                        <?php echo if_not_empty($c_organization); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 info_card__info_block_div">
                                <div class="info_card__info_block_div__info_block">
                                    <div class="block_title">
                                        Job Title:
                                    </div>
                                    <div class="block_value">
                                        <?php echo if_not_empty($c_jobTitle); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 info_card__info_block_div">
                                <div class="info_card__info_block_div__info_block">
                                    <div class="block_title">
                                        Work Phone:
                                    </div>
                                    <div class="block_value last">
                                        <?php echo if_not_empty($c_workPhone); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF INFO CARD  -->


                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                    <div class="row">
                        <!-- START OF INFO CARD  -->
                        <div class="col-12 info_card_div">
                            <div class="info_card info_card_small">

                                <div class="info_card__card_heading">
                                    Other Info
                                </div>

                                <div class="row info_card__content_row">
                                    <div class="col-12 col-sm-12 col-md-4 info_card__info_block_div">
                                        <div class="info_card__info_block_div__info_block">
                                            <div class="block_title">
                                                Middle Name:
                                            </div>
                                            <div class="block_value last">
                                                <?php echo if_not_empty($c_mname); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-4 info_card__info_block_div">
                                        <div class="info_card__info_block_div__info_block">
                                            <div class="block_title">
                                                Date of Birth:
                                            </div>
                                            <div class="block_value last">
                                                <?php echo if_not_empty_date($c_dob); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-4 info_card__info_block_div">
                                        <div class="info_card__info_block_div__info_block">
                                            <div class="block_title">
                                                Gender:
                                            </div>
                                            <div class="block_value last">
                                                <?php echo if_not_empty_gender($c_gender); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END OF INFO CARD  -->


                        <!-- START OF INFO CARD  -->
                        <div class="col-12 info_card_div">
                            <div class="info_card info_card_small">

                                <div class="info_card__card_heading">
                                    Social
                                </div>

                                <div class="row info_card__content_row">
                                    <div class="col-12 col-sm-12 col-md-6 info_card__info_block_div">
                                        <div class="info_card__info_block_div__info_block">
                                            <div class="block_title">
                                                Website:
                                            </div>
                                            <div class="block_value">
                                                <a href="<?php echo if_not_empty($c_website); ?>">
                                                    <?php echo if_not_empty($c_website); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-6 info_card__info_block_div">
                                        <div class="info_card__info_block_div__info_block">
                                            <div class="block_title">
                                                Facebook:
                                            </div>
                                            <div class="block_value">
                                                <a href="<?php echo if_not_empty($c_facebook); ?>">
                                                    <?php echo if_not_empty($c_facebook); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-6 info_card__info_block_div">
                                        <div class="info_card__info_block_div__info_block">
                                            <div class="block_title">
                                                Linkedin:
                                            </div>
                                            <div class="block_value last">
                                                <a href="<?php echo if_not_empty($c_linkedin); ?>">
                                                    <?php echo if_not_empty($c_linkedin); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-6 info_card__info_block_div">
                                        <div class="info_card__info_block_div__info_block">
                                            <div class="block_title">
                                                Twitter:
                                            </div>
                                            <div class="block_value last">
                                                <a href="<?php echo if_not_empty($c_twitter); ?>">
                                                    <?php echo if_not_empty($c_twitter); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END OF INFO CARD  -->

                    </div>
                </div>

            </div>
        </div>
        <!-- END OF RHS CONTENT  -->

        <?php
    } else {
        ?>
            <!-- START OF MID BAR  -->
            <div class="dashboard_rhs__contacts_mid_bar dashboard_rhs__view_contact_mid_bar">
                <div class="dashboard_rhs__view_contact_mid_bar__lhs">
                    <a href="index.php">
                        <i class="material-icons">arrow_back</i>
                    </a>
                </div>

                <div class="dashboard_rhs__view_contact_mid_bar__center">

                    <div class="user_name_div">
                    <div class="user_name">
                        Invalid Contact!
                    </div>
                    </div>
                </div>

                <div class="dashboard_rhs__view_contact_mid_bar__rhs hidden-md-down">
                   
                </div>

                <div class="dashboard_rhs__add_contact_mid_bar__rhs hidden-lg-up">
                    
                </div>

            </div>
            <!-- END OF MID BAR  -->

            <!-- START OF RHS CONTENT  -->
            <div class="dashboard_rhs__contacts_content">
                <div class="dashboard_rhs__contacts_content__row row ">

                    <!-- START OF INFO CARD  -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 info_card_div">
                    </div>
                </div>
            </div>
            <?php
    }
} else {
    
}

?>

</div>
<!-- END OF RHS  -->
<?php

include('include/footer.php'); ?>