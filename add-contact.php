<?php 

include('include/header.php'); 

// config file is included in the header

$cid = md5(uniqid(time(), true)).getToken(32);

?>

<!-- START OF RHS  -->
<div class="col-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 dashboard_rhs">

    <!-- START OF TOP BAR  -->
    <div class="dashboard_rhs__contacts_top_bar">
        <div class="dashboard_rhs__contacts_top_bar__page_heading">
            <i class="material-icons">contacts</i> Contacts</div>
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

    <!-- START OF MID BAR  -->
    <div class="dashboard_rhs__contacts_mid_bar dashboard_rhs__add_contact_mid_bar">
        <div class="dashboard_rhs__add_contact_mid_bar__lhs">
            <a  href="index.php">
                <i class="material-icons">arrow_back</i>
            </a>
        </div>

        <div class="dashboard_rhs__add_contact_mid_bar__center">
            <div class="user_image hidden-sm-down">
                <img class="user_image_img user_image_img_desktop" src="_files/images/profile_icon.png" alt="">
                <input type='file' id="user_img_file_desktop" class="user_img_file user_img_file_desktop" name="user_img_file_desktop">
                <div class="user_image_text">Add Photo</div>
            </div>
            <div class="user_name_div">
                <div class="contact_text">Create Contact</div>
                <div class="user_name">Add New Contact</div>
            </div>
        </div>
    <form id="add_contact_form" name="add_contact_form" method="post" action="#">
        <div class="dashboard_rhs__add_contact_mid_bar__rhs hidden-md-down">
            <button type="submit" class="save_and_close" data-cid="<?php echo $cid;?>" data-type="1">Save &amp; Close</button>
            <a class="cancel_add_contact">Cancel</a>
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
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 add_card_div">
                <div class="add_card">
                    <div class="add_card__card_heading">
                        Contact Details
                    </div>

                    <div class="row add_card__content_row">

                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div hidden-md-up">
                            <div class="user_image">
                                <img class="user_image_img user_image_img_mobile" src="_files/images/profile_icon.png" alt="">
                                <input type='file' id="user_img_file_mobile" class="user_img_file user_img_file_mobile" name="user_img_file_mobile">
                                <div class="user_image_text">Add Photo</div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    First Name:
                                </div>
                                <div class="block_value">
                                    <input type="text" id="contact_fname" class="contact_fname contact_fname_js" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Last Name:
                                </div>
                                <div class="block_value">
                                    <input type="text" id="contact_lname" class="contact_lname contact_lname_js">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Phone:
                                </div>
                                <div class="block_value">
                                    <input type="phone" id="contact_phone" class="contact_phone contact_phone_js">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Email:
                                </div>
                                <div class="block_value">
                                    <input type="email" id="contact_email" class="contact_email contact_email_js">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Organization:
                                </div>
                                <div class="block_value">
                                    <input type="text" id="contact_organization" class="contact_organization contact_organization_js">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Job Title:
                                </div>
                                <div class="block_value">
                                    <input type="text" id="contact_jobTitle" class="contact_jobTitle contact_jobTitle_js">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Work Phone:
                                </div>
                                <div class="block_value last">
                                    <input type="text" id="contact_workPhone" class="contact_workPhone contact_workPhone_js">
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
                    <div class="col-12 add_card_div">
                        <div class="add_card add_card_small">

                            <div class="add_card__card_heading">
                                Other Info
                            </div>

                            <div class="row add_card__content_row">
                                <div class="col-12 col-sm-12 col-md-4 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Middle Name:
                                        </div>
                                        <div class="block_value last">
                                            <input type="text" id="contact_mname" class="contact_mname contact_mname_js">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Date of Birth:
                                        </div>
                                        <div class="block_value last">
                                            <input type="date" id="contact_dob" class="contact_dob contact_dob_js">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Gender:
                                        </div>
                                        <div class="block_value last">
                                            <select id="contact_gender" name="contact_gender contact_gender_js" id="contact_gender">
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                                <option value="O">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END OF INFO CARD  -->


                    <!-- START OF INFO CARD  -->
                    <div class="col-12 add_card_div">
                        <div class="add_card add_card_small">

                            <div class="add_card__card_heading">
                                Social
                            </div>

                            <div class="row add_card__content_row">
                                <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Website:
                                        </div>
                                        <div class="block_value">
                                            <input type="text" id="contact_website" class="contact_website contact_website_js">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Facebook:
                                        </div>
                                        <div class="block_value">
                                            <input type="text" id="contact_facebook" class="contact_facebook contact_facebook_js">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Linkedin:
                                        </div>
                                        <div class="block_value last">
                                            <input type="text" id="contact_linkedin" class="contact_linkedin contact_linkedin_js">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Twitter:
                                        </div>
                                        <div class="block_value last">
                                            <input type="text" id="contact_twitter" class="contact_twitter contact_twitter_js">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END OF INFO CARD  -->
                    </form>

                </div>
            </div>

        </div>
    </div>
    <!-- END OF RHS CONTENT  -->
</div>
<!-- END OF RHS  -->

<?php include('include/footer.php'); ?>