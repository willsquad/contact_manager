<?php
// Require the configuration before any PHP code as the configuration controls error reporting:
require('../include/config.inc.php');
// The config file also starts the session.

// Require the database connection:
require(MYSQL);


$user_id = $_SESSION['user_id']; // Replace with the real loggin in user's id from SESSION
		

if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){

    
    if(isset($_POST['search_term']) && (strlen($_POST['search_term']) <= 50)) {
            
        $search_term = (string)$_POST['search_term'];
        $search_term_like = "%{$search_term}%";
        
        $stmt = $dbc->prepare("SELECT * FROM contacts_8521 WHERE added_by_u_id = ? AND is_deleted_contact = 0 AND (c_fname LIKE ? OR c_email LIKE ? OR c_organization LIKE ? OR c_phone LIKE ? OR c_lname LIKE ?) ORDER BY c_added_time DESC LIMIT 100");
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
    } else if (isset($_POST['alphabet_filter_type']) && isset($_POST['alphabet_letter'])) {
        
        $search_term = (string)$_POST['alphabet_letter'];
        $alphabet_filter_type = (int)$_POST['alphabet_filter_type'];

        if($alphabet_filter_type == 1) { // Alphabets from A - Z
            $search_term_like = "{$search_term}%";
        
            $stmt = $dbc->prepare("SELECT * FROM contacts_8521 WHERE added_by_u_id = ? AND is_deleted_contact = 0 AND c_lname LIKE ? ORDER BY c_added_time DESC LIMIT 100");
            $stmt->bind_param("is", $user_id, $search_term_like);
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
                    $row_array['c_added_time'] = if_not_empty($data['c_added_time']);

                    array_push($return_arr,$row_array);
                }
                /*header("Content-Type: application/json", true);
                echo json_encode($data);*/
                echo json_encode($return_arr);
            } else {
                $return_arr = array();
                echo json_encode($return_arr);
            }
        } else if ($alphabet_filter_type == 2) { // ALL Results
            echo 2;
        }
        
    } else if(isset($_POST['load_more_type']) && isset($_POST['load_more_value'])) {
       
        $load_more_value = (int)$_POST['load_more_value'];
        
        $stmt = $dbc->prepare("SELECT * FROM contacts_8521 WHERE added_by_u_id = ? AND is_deleted_contact = 0 AND c_added_time < ? ORDER BY c_added_time DESC LIMIT 25");
        $stmt->bind_param("ii", $user_id, $load_more_value);
        $stmt->execute();
        $r = $stmt->get_result();
        $stmt->free_result();
        $stmt->close();
                            
        if($r && ($r->num_rows > 0)) {
            
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
                $row_array['c_added_time'] = if_not_empty($data['c_added_time']);

                array_push($return_arr,$row_array);
            }
            /*header("Content-Type: application/json", true);
            echo json_encode($data);*/
            echo json_encode($return_arr);
        } else {
           echo 2;
        }
    }

}

?>
    