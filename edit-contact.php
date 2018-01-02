<?php include('include/header.php'); ?>

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
                <img src="_files/images/profile2.jpg" alt="">
                <div class="user_image_text">Change Photo</div>
            </div>
            <div class="user_name_div">
                <div class="contact_text">Edit Contact</div>
                <div class="user_name">Jane Doe</div>
            </div>
        </div>

        <div class="dashboard_rhs__add_contact_mid_bar__rhs hidden-md-down">
            <button class="save_and_close">Save &amp; Close</button>
            <button class="cancel">Cancel</button>
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
                                <img src="_files/images/profile2.jpg" alt="">
                                <div class="user_image_text">Change Photo</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    First Name:
                                </div>
                                <div class="block_value">
                                    <input type="text" value="Jane">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Last Name:
                                </div>
                                <div class="block_value">
                                    <input type="text" value="Doe">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Phone:
                                </div>
                                <div class="block_value">
                                    <input type="text" value="+1234567890">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Email:
                                </div>
                                <div class="block_value">
                                    <input type="text" value="jane@doemail.com">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Organization:
                                </div>
                                <div class="block_value">
                                    <input type="text" value="Doemail, Inc">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Job Title:
                                </div>
                                <div class="block_value">
                                    <input type="text" value="Business Analyst">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                            <div class="add_card__info_block_div__info_block">
                                <div class="block_title">
                                    Work Phone:
                                </div>
                                <div class="block_value last">
                                    <input type="text" value="+1234567891">
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
                                            <input type="text" value="Goodall">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Date of Birth:
                                        </div>
                                        <div class="block_value last">
                                            <input type="text" value="-">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Gender:
                                        </div>
                                        <div class="block_value last">
                                            <input type="text" value="Female">
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
                                            <input type="text" value="janedoe.com">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Facebook:
                                        </div>
                                        <div class="block_value">
                                            <input type="text" value="facebook.com/janedoe">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Linkedin:
                                        </div>
                                        <div class="block_value last">
                                            <input type="text" value="linkedin.com/janedoe">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 add_card__info_block_div">
                                    <div class="add_card__info_block_div__info_block">
                                        <div class="block_title">
                                            Twitter:
                                        </div>
                                        <div class="block_value last">
                                            <input type="text" value="twitter.com/janedoe">
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
</div>
<!-- END OF RHS  -->

<?php include('include/footer.php'); ?>