$(document).ready(function() {

    var absolute_link = "http://localhost:55001/contact_manager";

    /** Trigger the file upload click when the profile icon image is clicked on mobile screens **/
    $(document).on('click', '.user_image_img', function() {
        $(this).closest('.user_image').find('.user_img_file').click();
    });


    /** User Image Preview **/
    var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
    var contact_formData = new FormData();

    function readURL(input) {

        if (input.files && input.files[0]) {
            
            var extension = input.files[0].name.split('.').pop().toLowerCase(); //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types
            
            if(isSuccess) {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    $('.user_image_img').attr('src', e.target.result);
                };
        
                reader.readAsDataURL(input.files[0]);
                //$('.logo_file_error').removeClass('display');

                //populate formdata
                contact_formData.append('contact_img_file', $('#user_img_file_desktop').prop('files')[0]);
                contact_formData.append('contact_img_file_mobile', $('#user_img_file_mobile').prop('files')[0]);
            } else {
                 //$('.logo_file_error').addClass('display').html('<span class="fa fa-exclamation-triangle"></span> Sorry, only .jpeg, .jpg and .png files are allowed. Please try again with a different image.');
                 alert("Sorry, only JPEG, JPG, PNG and GIF files are allowed. Please try again with a different image.");
            }
        }
    }
    
    $(".user_img_file").change(function(){ // When the file-upload-input changes
        if($(this).get(0).files.length > 0){ // only if a file is selected
            var fileSize = $(this).get(0).files[0].size; // get filesize
            if(fileSize <= 1024000) { // if filesize less than or equal to 1MB
                readURL(this); // change url
                //$('.logo_size_error').removeClass('display'); // remove error-message's display class
            } else { // show error message
                //$('.logo_size_error').addClass('display').html('<span class="fa fa-exclamation-triangle"></span> Uh-oh, file size exceeded the upload limit of 1 MB. Please try again with a different image.');
                alert("Uh-oh, file size exceeded the upload limit of 1 MB. Please try again with a different image.");
            }
          }
    });
    /** User Image Preview **/


    /** Add New Contact **/
    $(document).on('submit', '#add_contact_form', function() {
        var save_contact_button = $('.save_and_close');
        var contact_save_type = $('.save_and_close').attr('data-type');

        var contact_cid = save_contact_button.attr('data-cid');
        var contact_fname = $("#contact_fname").val();
        var contact_lname = $("#contact_lname").val();
        var contact_phone = $("#contact_phone").val();
        var contact_email = $("#contact_email").val();
        var contact_organization = $("#contact_organization").val();
        var contact_jobTitle = $("#contact_jobTitle").val();
        var contact_workPhone = $("#contact_workPhone").val();
        var contact_mname = $("#contact_mname").val();
        var contact_dob = $("#contact_dob").val();
        var contact_gender = $("#contact_gender").val();
        var contact_website = $("#contact_website").val();
        var contact_facebook = $("#contact_facebook").val();
        var contact_linkedin = $("#contact_linkedin").val();
        var contact_twitter = $("#contact_twitter").val();

        contact_formData.append('contact_save_type', contact_save_type);
        contact_formData.append('contact_cid', contact_cid);
        contact_formData.append('contact_fname', contact_fname);
        contact_formData.append('contact_lname', contact_lname);
        contact_formData.append('contact_phone', contact_phone);
        contact_formData.append('contact_email', contact_email);
        contact_formData.append('contact_organization', contact_organization);
        contact_formData.append('contact_jobTitle', contact_jobTitle);
        contact_formData.append('contact_workPhone', contact_workPhone);
        contact_formData.append('contact_mname', contact_mname);
        contact_formData.append('contact_dob', contact_dob);
        contact_formData.append('contact_gender', contact_gender);
        contact_formData.append('contact_website', contact_website);
        contact_formData.append('contact_facebook', contact_facebook);
        contact_formData.append('contact_linkedin', contact_linkedin);
        contact_formData.append('contact_twitter', contact_twitter);

        // Send data
        $.ajax({
            url: 'included/save_contact.php',
            type: 'POST',
            processData: false, // important
            contentType: false, // important
            dataType : 'json',
            data : contact_formData,
            beforeSend: function() {
              save_contact_button.html('Saving...'); // change submit button text
            },
            success: function() {
                if(contact_save_type ==1) {
                    save_contact_button.html('Redirecting'); // reset submit button text
                    window.location.replace(absolute_link+"/")
                } else if(contact_save_type == 2) {
                    save_contact_button.html('Saved'); // reset submit button text
                }
            },
            error: function(e) {
              console.log(e);
            }
        });

        return false;
    });
    /** Add New Contact **/

    /** Reset/Refresh page **/
    $(document).on('click', 'a.cancel_add_contact_js', function() {
        window.location.href=window.location.href;    
    });
    /** Reset/Refresh page **/

    /** Add to Favorites **/
    $(document).on('click', '.favorite_icon_js', function() {

        var self = $(this);
        var data_fav = self.attr('data-fav');
        var unique_card_id = self.attr('data-cid');
        
        $.ajax({
            url: 'included/save_contact.php',
            type: 'POST',
            dataType: 'text',
            data: {'fav_uid' : unique_card_id, 'fav_type' : data_fav},
            beforeSend:function() {
                
            },
            success:function() {
                
                if(data_fav == 0) {
                    self.attr('data-fav', 1);
                    self.find('i').addClass('active');
                } else if (data_fav == 1) {
                    self.attr('data-fav', 0);
                    self.find('i').removeClass('active');
                }
                
            },
            error: function(e) {
                console.log(e);
            }
        });

        return false;
    });
    /** Add to Favorites **/

    /** SEARCH FILTER **/
    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;  //time in ms, 0.5 second for example
    var $input = $('#search_contacts');

    //on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        $('.loading_icon').text('autorenew').addClass('rotating');
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping () {
        var self = $input;
        if(self.val().length >= 1) {
            var search_value = self.val();
            $.ajax({
                url: 'included/search_filter.php',
                type: 'POST',
                dataType: 'JSON',
                data: {'search': 1, 'search_term': search_value},
                beforeSend: function(){
                },
                success: function(data){
                    $('.loading_icon').text('').removeClass('rotating');
                    //console.log(data.length); // Results
                    if(data.length>0) { // If atlest one result is returned
                        $('.dashboard_rhs__contacts_content__row').contents().hide();
                        //$('.pagination').contents().hide();
                        $('.no_contacts_found').hide();
                        
                        for (var x in data) {

                            //data[x]['link']

                            // Don't forget to add a search_contact_js class to each contact cards so that those can be removed when required.

                            $('<div class="dashboard_rhs__contacts_content__card_div search_contact_js col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4"><div class="dashboard_rhs__contacts_content__card_div__card" data-cid="'+data[x]['c_unique_id']+'"><div class="checkbox_fav_settings_container"><div class="checkbox_div"><input type="checkbox" class="contacts_checkbox"></div><div class="favorite_icon favorite_icon_js" data-cid="'+data[x]['c_unique_id']+'" data-fav="'+data[x]['c_favorite']+'"><i class="material-icons '+((data[x]['c_favorite'] == 1)?'active':'')+'">favorite</i></div><div class="settings_icon"> <i class="material-icons">settings</i> </div> </div> <div class="row"> <div class="dashboard_rhs__contacts_content__card_div__card__image_div col-sm-6 col-md-4 col-lg-4"> <a href="contact.php?u='+data[x]['c_id']+'"><img src="_files/images/'+data[x]['c_profile_pic']+'" alt=""> </a></div><div class="dashboard_rhs__contacts_content__card_div__card__details col-sm-6 col-md-8 col-lg-8"> <a href="contact.php?u='+data[x]['c_id']+'"> <h3>'+data[x]['c_fname']+" "+data[x]['c_lname']+'</h3> <p> <i class="material-icons">phone</i> '+data[x]['c_phone']+'</p> <p> <i class="material-icons">email</i> '+data[x]['c_email']+'</p> <p> <i class="material-icons">business</i> '+data[x]['c_organization']+'</p> </a> </div> </div> </div> </div>').appendTo('.dashboard_rhs__contacts_content__row').slideDown('slow');
                        }
                    } else {
                        //$('.pagination').contents().hide();
                        $('.dashboard_rhs__contacts_content__row').contents().hide();
                        $('.no_contacts_found').show();
                        $('.loading_icon').text('').removeClass('rotating');
                    }
                },
                error: function(){
                    
                }
            });
        } else if(self.val().length == 0) {
            //$('.pagination').contents().show();
            $('.dashboard_rhs__contacts_content__row .search_contact_js').remove(); // remove the search results 
            $('.no_contacts_found').hide();
            $('.dashboard_rhs__contacts_content__row').contents().show();  // show the hidden contents    
            $('.loading_icon').text('').removeClass('rotating');
        }
    }
    /** SEARCH FILTER **/


});