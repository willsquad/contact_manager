<?php
// Require the configuration before any PHP code as the configuration controls error reporting:
require('../include/config.inc.php');
// The config file also starts the session.

// Require the database connection:
require(MYSQL);


$user_id = 1; // Replace with the real loggin in user's id from SESSION
		

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){

	if(isset($_POST['search']) && isset($_POST['search_term'])) {


		
    }
    
    if(isset($_POST['search_term']) && (strlen($_POST['search_term']) <= 50)) {
            
        $search_term = (string)$_POST['search_term'];
        $search_term_like = "%{$search_term}%";
        
        $stmt = $dbc->prepare("SELECT * FROM contacts_8521 WHERE added_by_u_id = ? AND is_deleted_contact<> 1 AND (c_fname LIKE ? OR c_email LIKE ? OR c_organization LIKE ? OR c_phone LIKE ? OR c_lname LIKE ?) LIMIT 100");
        $stmt->bind_param("isssss", $user_id, $search_term_like, $search_term_like, $search_term_like, $search_term_like, $search_term_like);
        $stmt->execute();
        $r = $stmt->get_result();
        $stmt->free_result();
        $stmt->close();
                            
        if($r && $r->num_rows > 0) {
            
            $return_arr = array();
            
            while($data = $r->fetch_assoc()) {
                $row_array['base_url'] = BASE_URL;
                $row_array['c_id'] = $data['c_id'];
                $row_array['c_unique_id'] = $data['c_unique_id'];
                $row_array['c_favorite'] = $data['c_favorite'];
                $row_array['c_profile_pic'] = $data['c_profile_pic'];
                $row_array['c_fname'] = $data['c_fname'];
                $row_array['c_lname'] = $data['c_lname'];
                $row_array['c_phone'] = if_not_empty($data['c_phone']);
                $row_array['c_email'] = if_not_empty($data['c_email']);
                $row_array['c_organization'] = if_not_empty($data['c_organization']);

                array_push($return_arr,$row_array);
            }
            /*header("Content-Type: application/json", true);
            echo json_encode($data);*/
            echo json_encode($return_arr);
        } else {
            $return_arr = array();
            echo json_encode($return_arr);
        }
    }

}

?>
    