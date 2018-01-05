$(document).ready(function() {

    var absolute_link = "http://localhost:55001/contact_manager";

    /** Trigger the file upload click when the profile icon image is clicked on mobile screens **/
    $(document).on('click', '.user_image_img', function() {
        $(this).closest('.user_image').find('.user_img_file').click();
    });


    /** User Image Preview **/
    var fileTypes = ['jpg', 'jpeg', 'png'];
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
                $('.logo_file_error').removeClass('display');

                //populate formdata
                contact_formData.append('contact_img_file', $('#user_img_file_desktop').prop('files')[0]);
                contact_formData.append('contact_img_file_mobile', $('#user_img_file_mobile').prop('files')[0]);
            } else {
                 $('.logo_file_error').addClass('display').html('<span class="fa fa-exclamation-triangle"></span> Sorry, only .jpeg, .jpg and .png files are allowed. Please try again with a different image.');
            }
        }
    }
    
    $(".user_img_file").change(function(){ // When the file-upload-input changes
        if($(this).get(0).files.length > 0){ // only if a file is selected
            var fileSize = $(this).get(0).files[0].size; // get filesize
            if(fileSize <= 1024000) { // if filesize less than or equal to 250KB
                readURL(this); // change url
                $('.logo_size_error').removeClass('display'); // remove error-message's display class
            } else { // show error message
                $('.logo_size_error').addClass('display').html('<span class="fa fa-exclamation-triangle"></span> Uh-oh, file size exceeded the upload limit of 1 MB. Please try again with a different image.');
                //alert("Uh-oh, file size exceedes the upload limit of 250KB. Please try again with a different image");
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

        //var contact_save_type = 1;

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
            url: ''+absolute_link+'/included/save_contact.php',
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
    $(document).on('click', 'a.cancel_add_contact', function() {
        window.location.href=window.location.href;    
    });


});