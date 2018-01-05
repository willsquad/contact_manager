<?php 

include('include/header.php'); 

$user_id = 1;

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
                <div class="dashboard_rhs__contacts_mid_bar">
                    <div class="dashboard_rhs__contacts_mid_bar__lhs">
                        <a class="add_new_button" href="add-contact.php">
                            <i class="material-icons">add</i> Add New
                        </a>
                    </div>
                    <div class="dashboard_rhs__contacts_mid_bar__rhs">
                        <div class="dashboard_rhs__contacts_mid_bar__rhs__search hidden-md-down">
                            <i class="material-icons search_icon">search</i>
                            <input type="search" placeholder="Find contacts">
                            <i class="material-icons loading_icon rotating">autorenew</i>
                        </div>
                        <!-- <i class="material-icons">view_list</i> -->
                        <i class="material-icons">filter_list</i>
                    </div>
                </div>
                <!-- END OF MID BAR  -->

                <!-- START OF RHS CONTENT  -->
                <div class="dashboard_rhs__contacts_content">
                    <div class="dashboard_rhs__contacts_content__row row ">

                    <?php 
                        $result = $dbc->query("SELECT `c_id`, `c_fname`, `c_lname`, `c_mname`, `c_email`, `c_phone`, `c_organization`, `c_profile_pic`, `c_unique_id` FROM `contacts_8521` WHERE `added_by_u_id` = $user_id");
                        if($result->num_rows > 0) { // Results found
                            while($data = $result->fetch_assoc()) {
                                echo '<div class="dashboard_rhs__contacts_content__card_div col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4">
                                            <div class="dashboard_rhs__contacts_content__card_div__card" data-cid="'.$data['c_unique_id'].'">
                                                
                                                    <div class="checkbox_fav_settings_container">
                                                        <div class="checkbox_div">
                                                            <input type="checkbox">
                                                        </div>
                                                        <div class="favorite_icon">
                                                            <i class="material-icons">favorite</i>
                                                        </div>
                    
                                                        <div class="settings_icon">
                                                            <i class="material-icons">settings</i>
                                                        </div>
                                                    </div>
                                                
                
                                                <div class="row">
                                                    <div class="dashboard_rhs__contacts_content__card_div__card__image_div col-sm-6 col-md-4 col-lg-4">
                                                        <a href="contact.php?u='.$data['c_id'].'">
                                                            <img src="_files/images/'.$data['c_profile_pic'].'" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="dashboard_rhs__contacts_content__card_div__card__details col-sm-6 col-md-8 col-lg-8">
                                                        <a href="contact.php?u='.$data['c_id'].'">
                                                            <h3>'.$data['c_fname']." ".$data['c_lname'].'</h3>
                                                            <p>
                                                                <i class="material-icons">phone</i> '.if_not_empty($data['c_phone']).'</p>
                                                            <p>
                                                                <i class="material-icons">email</i> '.if_not_empty($data['c_email']).'</p>
                                                            <p>
                                                                <i class="material-icons">business</i> '.if_not_empty($data['c_organization']).'</p>
                                                        </a>
                                                    </div>
                                                </div>
                
                                            </div>
                                        </div>';
                            }
                        } else {
                            echo '<h3 class="no_results_found">No contacts found!</h3>';
                        }
                    ?>
                        <!-- <div class="dashboard_rhs__contacts_content__card_div col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <div class="dashboard_rhs__contacts_content__card_div__card">

                                <div class="checkbox_fav_settings_container">
                                    <div class="checkbox_div">
                                        <input type="checkbox">
                                    </div>
                                    <div class="favorite_icon">
                                        <i class="material-icons">favorite</i>
                                    </div>

                                    <div class="settings_icon">
                                        <i class="material-icons">settings</i>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="dashboard_rhs__contacts_content__card_div__card__image_div col-sm-6 col-md-4 col-lg-4">
                                        <img src="_files/images/profile2.jpg" alt="">
                                    </div>
                                    <div class="dashboard_rhs__contacts_content__card_div__card__details col-sm-6 col-md-8 col-lg-8">
                                        <h3>Jane Doe</h3>
                                        <p>
                                            <i class="material-icons">phone</i> +1234567890</p>
                                        <p>
                                            <i class="material-icons">email</i> jane@doemail.com</p>
                                        <p>
                                            <i class="material-icons">business</i> Doemail, Inc</p>
                                    </div>
                                </div>

                            </div>
                        </div> -->

                        

                        <!-- <div class="dashboard_rhs__contacts_content__card_div col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4">
                            <div class="dashboard_rhs__contacts_content__card_div__card"></div>
                        </div> -->

                    </div>
                </div>
                <!-- END OF RHS CONTENT  -->
            </div>
            <!-- END OF RHS  -->

<?php include('include/footer.php'); ?>