<?php
// Require the configuration before any PHP code as the configuration controls error reporting:
require('../include/config.inc.php');
// The config file also starts the session.

// Require the database connection:
require(MYSQL);


$user_id = $_SESSION['user_id']; // Replace with the real loggin in user's id from SESSION
		

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){

	if(isset($_POST['contact_fname']) && isset($_POST['contact_cid']) && isset($_POST['contact_lname']) && isset($_POST['contact_phone']) && isset($_POST['contact_email']) && isset($_POST['contact_organization']) && isset($_POST['contact_jobTitle']) && isset($_POST['contact_workPhone']) && isset($_POST['contact_mname']) && isset($_POST['contact_dob']) && isset($_POST['contact_gender']) && isset($_POST['contact_website']) && isset($_POST['contact_facebook']) && isset($_POST['contact_linkedin']) && isset($_POST['contact_twitter']) && isset($_POST['contact_save_type'])) {

        $added_by_u_id = $user_id;

        $c_unique_id = filter_var($_POST['contact_cid'], FILTER_SANITIZE_STRING);
        $c_unique_id_snip = substr($c_unique_id, 0, 10);

        $c_added_time = time();

        $c_fname = filter_var($_POST['contact_fname'], FILTER_SANITIZE_STRING);
        $c_lname = filter_var($_POST['contact_lname'], FILTER_SANITIZE_STRING);
        $c_phone = filter_var($_POST['contact_phone'], FILTER_SANITIZE_NUMBER_INT);
        $c_email = filter_var($_POST['contact_email'], FILTER_SANITIZE_EMAIL);
        $c_organization = filter_var($_POST['contact_organization'], FILTER_SANITIZE_STRING);
        $c_jobTitle = filter_var($_POST['contact_jobTitle'], FILTER_SANITIZE_STRING);
        $c_workPhone = filter_var($_POST['contact_workPhone'], FILTER_SANITIZE_NUMBER_INT);
        $c_mname = filter_var($_POST['contact_mname'], FILTER_SANITIZE_STRING);
        $c_dob = filter_var($_POST['contact_dob'], FILTER_SANITIZE_NUMBER_INT);
        $c_gender = filter_var($_POST['contact_gender'], FILTER_SANITIZE_STRING);
        $c_website = filter_var($_POST['contact_website'], FILTER_SANITIZE_URL);
        $c_facebook = filter_var($_POST['contact_facebook'], FILTER_SANITIZE_URL);
        $c_linkedin = filter_var($_POST['contact_linkedin'], FILTER_SANITIZE_URL);
        $c_twitter = filter_var($_POST['contact_twitter'], FILTER_SANITIZE_URL);

        $c_profile_pic = "profile_icon.png";


        // For storing registration errors:
		$reg_errors = array();
		$contact_save_type = (int)$_POST['contact_save_type']; /** if company_type == 0, then it's the primary company, else if it's 1, it's a new company,  **/
		
        if($contact_save_type == 1) { /* Add new Contact*/
            
            $stmt = $dbc->prepare("INSERT INTO contacts_8521 (`c_fname`, `c_lname`, `c_mname`, `c_email`, `c_phone`, `c_organization`, `c_jobTitle`, `c_workPhone`, `c_dob`, `c_gender`, `c_profile_pic`, `c_website`, `c_linkedin`, `c_twitter`, `c_facebook`, `c_unique_id`, `added_by_u_id`, `c_added_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `c_fname` = ?, `c_lname` = ?, `c_mname` = ?, `c_email` = ?, `c_phone` = ?, `c_organization` = ?, `c_jobTitle` = ?, `c_workPhone` = ?, `c_dob` = ?, `c_gender` = ?, `c_website` = ?, `c_linkedin` = ?, `c_twitter` = ?, `c_facebook` = ?");		

            $stmt->bind_param("ssssssssssssssssiissssssssssssss", $c_fname, $c_lname, $c_mname, $c_email, $c_phone, $c_organization, $c_jobTitle, $c_workPhone, $c_dob, $c_gender, $c_profile_pic, $c_website, $c_linkedin, $c_twitter, $c_facebook, $c_unique_id, $added_by_u_id, $c_added_time, $c_fname, $c_lname, $c_mname, $c_email, $c_phone, $c_organization, $c_jobTitle, $c_workPhone, $c_dob, $c_gender, $c_website, $c_linkedin, $c_twitter, $c_facebook);

            $stmt->execute();
            //$stmt->close();
            
            //printf("Error: %s.\n", $stmt->error);
            
            /* echo "\n".$dbc->affected_rows."\n";
            echo "\n".$stmt->num_rows."\n"; */
            

            if($dbc->affected_rows == 1) {// insert successful

                $last_insert_id = $dbc->insert_id;

                if(isset($_FILES['contact_img_file'])) {

                    $errors     = array();
                    $maxsize    = 1024000;
                    $acceptable = array(
                        'image/jpeg',
                        'image/jpg',
                        'image/gif',
                        'image/png'
                    );

                    if(($_FILES['contact_img_file']['size'] >= $maxsize) || ($_FILES["contact_img_file"]["size"] == 0)) {
                        $errors[] = 'File too large. File must be less than 1 MB.';
                    }

                    if(!in_array($_FILES['contact_img_file']['type'], $acceptable) && (!empty($_FILES["contact_img_file"]["type"]))) {
                        $errors[] = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
                    }

                    if(count($errors) === 0) {
                        $sourcePath_logo = $_FILES['contact_img_file']['tmp_name'];       // Storing source path of the file in a variable
                        $image_new_filename = $c_unique_id_snip."-".$_FILES['contact_img_file']['name'];
                        $targetPath_logo = BASE_URI."_files/images/".$image_new_filename; // Target path where file is to be stored
                        move_uploaded_file($sourcePath_logo,$targetPath_logo) ;    // Moving Uploaded file
                        
                        $stmt2 = $dbc->prepare("UPDATE contacts_8521 SET c_profile_pic = ? WHERE c_id = ?");
                        $stmt2->bind_param("si", $image_new_filename, $last_insert_id);
                        $stmt2->execute();
                    } else {
                        foreach($errors as $error) {
                            echo '<script>alert("'.$error.'");</script>';
                        }

                        die(); //Ensure no more processing is done
                    }
                    
                } else if(isset($_FILES['contact_img_file_mobile'])) {

                    $errors     = array();
                    $maxsize    = 1024000;
                    $acceptable = array(
                        'image/jpeg',
                        'image/jpg',
                        'image/gif',
                        'image/png'
                    );

                    if(($_FILES['contact_img_file_mobile']['size'] >= $maxsize) || ($_FILES["contact_img_file_mobile"]["size"] == 0)) {
                        $errors[] = 'File too large. File must be less than 1 MB.';
                    }

                    if(!in_array($_FILES['contact_img_file_mobile']['type'], $acceptable) && (!empty($_FILES["contact_img_file_mobile"]["type"]))) {
                        $errors[] = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
                    }

                    if(count($errors) === 0) {
                        $sourcePath_logo = $_FILES['contact_img_file_mobile']['tmp_name'];       // Storing source path of the file in a variable
                        $image_new_filename = $c_unique_id_snip."-".$_FILES['contact_img_file_mobile']['name'];
                        $targetPath_logo = BASE_URI."_files/images/".$image_new_filename; // Target path where file is to be stored
                        move_uploaded_file($sourcePath_logo,$targetPath_logo) ;    // Moving Uploaded file
                        
                        $stmt2 = $dbc->prepare("UPDATE contacts_8521 SET c_profile_pic = ? WHERE c_id = ?");
                        $stmt2->bind_param("si", $image_new_filename, $last_insert_id);
                        $stmt2->execute();
                    } else {
                        foreach($errors as $error) {
                            echo '<script>alert("'.$error.'");</script>';
                        }

                        die(); //Ensure no more processing is done
                    }
                    
                } else {
                    // Do Nothing save the default profile pic url
        
                    
                }
            

                /** Required for the button to show 'Saved', i.e for the success block to trigger **/
                /* Return JSON */
                echo json_encode("Saved");

            } else {
                // insert failed
            
                /** Required for the button to show 'Saved', i.e for the success block to trigger **/
                /* Return JSON */
                echo json_encode("Failed!");
            }

            $dbc->close();
			
        }/* End of contact save type = 1 , i.e add New   */
        
        else if ($contact_save_type == 2) {  /** contact save type = 2 , i.e Edit Contact   */

            $c_modified_time = time();
            
            $stmt = $dbc->prepare("UPDATE contacts_8521 SET `c_fname` = ?, `c_lname` = ?, `c_mname` = ?, `c_email` = ?, `c_phone` = ?, `c_organization` = ?, `c_jobTitle` = ?, `c_workPhone` = ?, `c_dob` = ?, `c_gender` = ?, `c_website` = ?, `c_linkedin` = ?, `c_twitter` = ?, `c_facebook` = ?, `c_modified_time` = ? WHERE `c_unique_id` = ?");		

            $stmt->bind_param("ssssssssssssssis", $c_fname, $c_lname, $c_mname, $c_email, $c_phone, $c_organization, $c_jobTitle, $c_workPhone, $c_dob, $c_gender, $c_website, $c_linkedin, $c_twitter, $c_facebook, $c_modified_time, $c_unique_id);

            $stmt->execute();
            //$stmt->close();
            
            //printf("Error: %s.\n", $stmt->error);
            
            /* echo "\n".$dbc->affected_rows."\n";
            echo "\n".$stmt->num_rows."\n"; */
            

            if(isset($_FILES['contact_img_file'])) {

                $errors     = array();
                $maxsize    = 1024000;
                $acceptable = array(
                    'image/jpeg',
                    'image/jpg',
                    'image/gif',
                    'image/png'
                );

                if(($_FILES['contact_img_file']['size'] >= $maxsize) || ($_FILES["contact_img_file"]["size"] == 0)) {
                    $errors[] = 'File too large. File must be less than 1 MB.';
                }

                if(!in_array($_FILES['contact_img_file']['type'], $acceptable) && (!empty($_FILES["contact_img_file"]["type"]))) {
                    $errors[] = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
                }

                if(count($errors) === 0) {
                    $sourcePath_logo = $_FILES['contact_img_file']['tmp_name'];       // Storing source path of the file in a variable
                    $image_new_filename = $c_unique_id_snip."-".$_FILES['contact_img_file']['name'];
                    $targetPath_logo = BASE_URI."_files/images/".$image_new_filename; // Target path where file is to be stored
                    move_uploaded_file($sourcePath_logo,$targetPath_logo) ;    // Moving Uploaded file
                    
                    
                    $stmt2 = $dbc->prepare("UPDATE contacts_8521 SET c_profile_pic = ?, c_modified_time = ? WHERE c_unique_id = ?");
                    $stmt2->bind_param("sis", $image_new_filename, $c_modified_time, $c_unique_id);
                    $stmt2->execute();
                } else {
                    foreach($errors as $error) {
                        echo '<script>alert("'.$error.'");</script>';
                    }

                    die(); //Ensure no more processing is done
                }
                
            } else if(isset($_FILES['contact_img_file_mobile'])) {

                $errors     = array();
                $maxsize    = 1024000;
                $acceptable = array(
                    'image/jpeg',
                    'image/jpg',
                    'image/gif',
                    'image/png'
                );

                if(($_FILES['contact_img_file_mobile']['size'] >= $maxsize) || ($_FILES["contact_img_file_mobile"]["size"] == 0)) {
                    $errors[] = 'File too large. File must be less than 1 MB.';
                }

                if(!in_array($_FILES['contact_img_file_mobile']['type'], $acceptable) && (!empty($_FILES["contact_img_file_mobile"]["type"]))) {
                    $errors[] = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
                }

                if(count($errors) === 0) {
                    $sourcePath_logo = $_FILES['contact_img_file_mobile']['tmp_name'];       // Storing source path of the file in a variable
                    $image_new_filename = $c_unique_id_snip."-".$_FILES['contact_img_file_mobile']['name'];
                    $targetPath_logo = BASE_URI."_files/images/".$image_new_filename; // Target path where file is to be stored
                    move_uploaded_file($sourcePath_logo,$targetPath_logo) ;    // Moving Uploaded file
                    
                    $stmt2 = $dbc->prepare("UPDATE contacts_8521 SET c_profile_pic = ?, c_modified_time = ? WHERE c_unique_id = ?");
                    $stmt2->bind_param("sis", $image_new_filename, $c_modified_time, $c_unique_id);
                    $stmt2->execute();
                } else {
                    foreach($errors as $error) {
                        echo '<script>alert("'.$error.'");</script>';
                    }

                    die(); //Ensure no more processing is done
                }
                
            } else {
                // Do Nothing save the default profile pic url
    
                
            }

            $dbc->close();

            /* Return JSON */
            echo json_encode("Saved");

        }
		
	} else if(isset($_POST['fav_uid']) && isset($_POST['fav_type'])) {
        $c_unique_id = filter_var($_POST['fav_uid'], FILTER_SANITIZE_STRING);
        $fav_type = (int)$_POST['fav_type'];

        if($fav_type == 0) {
            $stmt0 = $dbc->prepare("UPDATE contacts_8521 SET c_favorite = 1 WHERE c_unique_id = ? AND added_by_u_id = ?");
            $stmt0->bind_param("si", $c_unique_id, $user_id);
            $stmt0->execute();
        } else if ($fav_type == 1) {
            $stmt0 = $dbc->prepare("UPDATE contacts_8521 SET c_favorite = 0 WHERE c_unique_id = ? AND added_by_u_id = ?");
            $stmt0->bind_param("si", $c_unique_id, $user_id);
            $stmt0->execute();
        }
        
        echo "Saved";

    }   
    else if(isset($_POST['to_delete']) && isset($_POST['count'])) {
        
        $to_delete_array = json_decode($_POST['to_delete']);
        $item_count = (int)$_POST['count'];

        if($item_count > 0) {
											
            for($i = 0; $i < $item_count; $i++) {
            
                //echo $to_delete_array[$i];

                $stmt0 = $dbc->prepare("UPDATE contacts_8521 SET is_deleted_contact = 1 WHERE c_id = ? AND added_by_u_id = ?");
                $stmt0->bind_param("ii", $to_delete_array[$i], $user_id);
                $stmt0->execute();
                
            }
            
        }
        
        
        echo "Contact(s) Deleted";
    }

}

?>
    