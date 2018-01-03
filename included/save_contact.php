<?php
// Require the configuration before any PHP code as the configuration controls error reporting:
require('../include/config.inc.php');
// The config file also starts the session.

// Require the database connection:
require(MYSQL);
		

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){

	if(isset($_POST['contact_fname']) && isset($_POST['contact_lname']) && isset($_POST['contact_phone']) && isset($_POST['contact_email']) && isset($_POST['contact_organization']) && isset($_POST['contact_jobTitle']) && isset($_POST['contact_workPhone']) && isset($_POST['contact_mname']) && isset($_POST['contact_dob']) && isset($_POST['contact_gender']) && isset($_POST['contact_website']) && isset($_POST['contact_facebook']) && isset($_POST['contact_linkedin']) && isset($_POST['contact_twitter']) && isset($_POST['contact_save_type'])) {

        // For storing registration errors:
		$reg_errors = array();
		$contact_save_type = (int)$_POST['contact_save_type']; /** if company_type == 0, then it's the primary company, else if it's 1, it's a new company,  **/
		
		if($contact_save_type == 1) { /* Add new Contact*/
            
            

            if(isset($_FILES['contact_img_file'])) {
                $sourcePath_logo = $_FILES['contact_img_file']['tmp_name'];       // Storing source path of the file in a variable
                $targetPath_logo = BASE_URI."_files/images/".$_FILES['contact_img_file']['name']; // Target path where file is to be stored
                move_uploaded_file($sourcePath_logo,$targetPath_logo) ;    // Moving Uploaded file
                
                
                /* $stmt = $dbc->prepare("UPDATE coming_soon_table SET c_profile_pic = ? WHERE c_id = ?");
                $stmt->bind_param("s", $_FILES['logo_img_file']['name'], $c_id);
                $stmt->execute(); */
                
            } else if(isset($_FILES['contact_img_file_mobile'])) {
                $sourcePath_logo = $_FILES['contact_img_file_mobile']['tmp_name'];       // Storing source path of the file in a variable
                $targetPath_logo = BASE_URI."_files/images/".$_FILES['contact_img_file_mobile']['name']; // Target path where file is to be stored
                move_uploaded_file($sourcePath_logo,$targetPath_logo) ;    // Moving Uploaded file
                
                
                
            } else {
                // Do Nothing save the default profile pic url
    
                
            }
			
		}
		
	}

}

?>
    