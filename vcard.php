<?php
// Require the configuration before any PHP code as the configuration controls error reporting:
require('./include/config.inc.php');
// The config file also starts the session.

// Require the database connection:
require(MYSQL);

$user_id = $_SESSION['user_id'];

if(isset($_GET['u']) && !isset($_GET['contacts'])) {

    $c_id = (int)$_GET['u'];

    
    function exportContactVCF($c_id, $dbc, $user_id){

        $result = $dbc->query("SELECT `c_id`, `c_fname`, `c_lname`, `c_mname`, `c_email`, `c_phone`, `c_organization`, `c_jobTitle`, `c_workPhone`, `c_profile_pic` FROM `contacts_8521` WHERE `added_by_u_id` = $user_id AND `is_deleted_contact` = 0 AND `c_id` = $c_id LIMIT 1");

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
                $c_profile_pic = $data['c_profile_pic'];
            }

                $c_fullname = $c_fname." ".$c_lname;
    
        
                $dataArray ="BEGIN:VCARD\r\nVERSION:4.0\r\nN:$c_fname;$c_lname\r\nFN:$c_fullname\r\nORG:$c_organization\r\nTITLE:$c_jobTitle\r\nPHOTO;MEDIATYPE=image/jpg:".BASE_URL."_files/images/$c_profile_pic\r\nTEL;TYPE=work,voice;VALUE=uri:tel:$c_workPhone\r\nTEL;TYPE=home,voice;VALUE=uri:$c_phone\r\nEMAIL:$c_email\r\nEND:VCARD\r\n";
            }
        
    
        
        $data = $dataArray;
        
        $size = strlen($data);
        
        $filename = "contact.vcf";
        
        header("Content-Type: application/octet-stream");
        
        header("Content-Length: $size");
        
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        header("Content-Transfer-Encoding: binary");
        
        return $data;
        
    }
     
    //NOTE : You can add multiple contacts or get them from database to generate all contacts VCF file.
        
    echo exportContactVCF($c_id, $dbc, $user_id);
   

} else if(!isset($_GET['u']) && isset($_GET['contacts']) && isset($_GET['count'])) {

    $to_export_contacts = json_decode($_GET['contacts']);
    $item_count = (int)$_GET['count'];

    $array=array_map('intval', $to_export_contacts); /*Convert array values from strings to integers using array may intval*/
    $array = implode("','",$to_export_contacts); /* Wrap array integers with quotes, there won't be quotes at the beginning and end, add that in the query */

    //echo $array;
    
    function exportContactVCF($array, $dbc, $user_id){

        $result = $dbc->query("SELECT  `c_fname`, `c_lname`, `c_mname`, `c_email`, `c_phone`, `c_organization`, `c_jobTitle`, `c_workPhone`, `c_profile_pic` FROM `contacts_8521` WHERE `added_by_u_id` = $user_id AND `is_deleted_contact` = 0 AND `c_id` IN ('".$array."')");

        if($result->num_rows > 0) { // Results found

            $dataArray = "";
            
            while($data = $result->fetch_assoc()) {
                $c_fname = $data['c_fname'];
                $c_lname = $data['c_lname'];
                $c_mname = $data['c_mname'];
                $c_email = $data['c_email'];
                $c_phone = $data['c_phone'];
                $c_organization = $data['c_organization'];
                $c_jobTitle = $data['c_jobTitle'];
                $c_workPhone = $data['c_workPhone'];
                $c_profile_pic = $data['c_profile_pic'];

                $c_fullname = $c_fname." ".$c_lname;
    
        
                $dataArray .="BEGIN:VCARD\r\nVERSION:4.0\r\nN:$c_fname;$c_lname\r\nFN:$c_fullname\r\nORG:$c_organization\r\nTITLE:$c_jobTitle\r\nPHOTO;MEDIATYPE=image/jpg:".BASE_URL."_files/images/$c_profile_pic\r\nTEL;TYPE=work,voice;VALUE=uri:tel:$c_workPhone\r\nTEL;TYPE=home,voice;VALUE=uri:$c_phone\r\nEMAIL:$c_email\r\nEND:VCARD\r\n";
            }

                
        }
        
    
        
        $data = $dataArray;
        
        $size = strlen($data);
        
        $filename = "contacts.vcf";
        
        header("Content-Type: application/octet-stream");
        
        header("Content-Length: $size");
        
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        header("Content-Transfer-Encoding: binary");
        
        return $data;
        
    }
     
    //NOTE : You can add multiple contacts or get them from database to generate all contacts VCF file.
        
    echo exportContactVCF($array, $dbc, $user_id);
   

} else { // Contacts Array is not set. | So export all contacts.

    function exportContactVCF($dbc, $user_id){

        $result = $dbc->query("SELECT `c_id`, `c_fname`, `c_lname`, `c_mname`, `c_email`, `c_phone`, `c_organization`, `c_jobTitle`, `c_workPhone`, `c_profile_pic` FROM `contacts_8521` WHERE `added_by_u_id` = $user_id AND `is_deleted_contact` = 0 ORDER by `c_added_time` DESC");

        if($result->num_rows > 0) { // Results found

            $dataArray = "";
            
            while($data = $result->fetch_assoc()) {
                $c_fname = $data['c_fname'];
                $c_lname = $data['c_lname'];
                $c_mname = $data['c_mname'];
                $c_email = $data['c_email'];
                $c_phone = $data['c_phone'];
                $c_organization = $data['c_organization'];
                $c_jobTitle = $data['c_jobTitle'];
                $c_workPhone = $data['c_workPhone'];
                $c_profile_pic = $data['c_profile_pic'];

                $c_fullname = $c_fname." ".$c_lname;
    
        
                $dataArray .="BEGIN:VCARD\r\nVERSION:4.0\r\nN:$c_fname;$c_lname\r\nFN:$c_fullname\r\nORG:$c_organization\r\nTITLE:$c_jobTitle\r\nPHOTO;MEDIATYPE=image/jpg:".BASE_URL."_files/images/$c_profile_pic\r\nTEL;TYPE=work,voice;VALUE=uri:tel:$c_workPhone\r\nTEL;TYPE=home,voice;VALUE=uri:$c_phone\r\nEMAIL:$c_email\r\nEND:VCARD\r\n";
            }

                
        }
        
    
        
        $data = $dataArray;
        
        $size = strlen($data);
        
        $filename = "contacts.vcf";
        
        header("Content-Type: application/octet-stream");
        
        header("Content-Length: $size");
        
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        header("Content-Transfer-Encoding: binary");
        
        return $data;
        
    }
     
    //NOTE : You can add multiple contacts or get them from database to generate all contacts VCF file.
        
    echo exportContactVCF($dbc, $user_id);
}