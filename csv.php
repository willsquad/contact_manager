<?php
// Require the configuration before any PHP code as the configuration controls error reporting:
require('./include/config.inc.php');
// The config file also starts the session.

// Require the database connection:
require(MYSQL);

$user_id = $_SESSION['user_id'];

function filter_colname($colname) {
    switch ($colname) {
        case "serial_number":
            return "#";
            break;
        case "c_fname":
            return "First Name";
            break;
        case "c_lname":
            return "Last Name";
            break;
        case "c_lname":
            return "Last Name";
            break;
        case "c_mname":
            return "Middle Name";
            break;
        case "c_email":
            return "Email";
            break;
        case "c_phone":
            return "Phone";
            break;
        case "c_organization":
            return "Organization";
            break;
        case "c_jobTitle":
            return "Job Title";
            break;
        case "c_workPhone":
            return "Work Phone";
            break;
        case "c_dob":
            return "Date of Birth";
            break;
        case "c_gender":
            return "Gender";
            break;
        case "c_website":
            return "Website";
            break;
        case "c_linkedin":
            return "Linkedin";
            break;
        case "c_twitter":
            return "Twitter";
            break;
        case "c_facebook":
            return "Facebook";
            break;
        default:
            return '';
    }
}

if(isset($_GET['contacts']) && isset($_GET['count'])) {

    $to_export_contacts = json_decode($_GET['contacts']);
    $item_count = (int)$_GET['count'];

    $array=array_map('intval', $to_export_contacts); /*Convert array values from strings to integers using array may intval*/
    $array = implode("','",$to_export_contacts); /* Wrap array integers with quotes, there won't be quotes at the beginning and end, add that in the query */

    //echo $array;

    $result = $dbc->query("SELECT  `c_fname`, `c_lname`, `c_mname`, `c_email`, `c_phone`, `c_organization`, `c_jobTitle`, `c_workPhone`, `c_dob`, `c_gender`, `c_website`, `c_linkedin`, `c_twitter`, `c_facebook` FROM `contacts_8521` WHERE `added_by_u_id` = $user_id AND `is_deleted_contact` = 0 AND `c_id` IN ('".$array."')");

    /* $result = $dbc->query("SELECT  @s:=@s+1 as `serial_number`, `c_fname`, `c_lname`, `c_mname`, `c_email`, `c_phone`, `c_organization`, `c_jobTitle`, `c_workPhone`, `c_dob`, `c_gender`, `c_website`, `c_linkedin`, `c_twitter`, `c_facebook` FROM `contacts_8521`,(SELECT @s:= 0) AS s WHERE `added_by_u_id` = $user_id AND `is_deleted_contact` = 0 AND `c_id` IN ('".$array."')"); */


    if($result->num_rows > 0) { // Results found
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        exit();
    }


    //Get the column names.
    $columnNames = array();
    if(!empty($rows)){
        //We only need to loop through the first row of our result
        //in order to collate the column names.
        $firstRow = $rows[0];
        foreach($firstRow as $colName => $val){
            $columnNames[] = filter_colname($colName);
        }
    }

    //Setup the filename that our CSV will have when it is downloaded.
    $fileName = 'selected-contacts.csv';

    //Set the Content-Type and Content-Disposition headers to force the download.
    header('Content-Type: application/excel');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    //Open up a file pointer
    $fp = fopen('php://output', 'w');

    //Start off by writing the column names to the file.
    fputcsv($fp, $columnNames);

    //Then, loop through the rows and write them to the CSV file.
    foreach ($rows as $row) {
        fputcsv($fp, $row);
    }

    //Close the file pointer.
    fclose($fp);
   

} else { // Contacts Array is not set.
    //echo $to_export_array[$i];

    $result = $dbc->query("SELECT  `c_fname`, `c_lname`, `c_mname`, `c_email`, `c_phone`, `c_organization`, `c_jobTitle`, `c_workPhone`, `c_dob`, `c_gender`, `c_website`, `c_linkedin`, `c_twitter`, `c_facebook` FROM `contacts_8521` WHERE `added_by_u_id` = $user_id AND `is_deleted_contact` = 0");
    /* $result = $dbc->query("SELECT  @s:=@s+1 as `serial_number`, `c_fname`, `c_lname`, `c_mname`, `c_email`, `c_phone`, `c_organization`, `c_jobTitle`, `c_workPhone`, `c_dob`, `c_gender`, `c_website`, `c_linkedin`, `c_twitter`, `c_facebook` FROM `contacts_8521`,(SELECT @s:= 0) AS s WHERE `added_by_u_id` = $user_id AND `is_deleted_contact` = 0"); */


    if($result->num_rows > 0) { // Results found
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        exit();
    }


    //Get the column names.
    $columnNames = array();
    if(!empty($rows)){
        //We only need to loop through the first row of our result
        //in order to collate the column names.
        $firstRow = $rows[0];
        foreach($firstRow as $colName => $val){
            $columnNames[] = filter_colname($colName);
        }
    }

    //Setup the filename that our CSV will have when it is downloaded.
    $fileName = 'all-contacts.csv';

    //Set the Content-Type and Content-Disposition headers to force the download.
    header('Content-Type: application/excel');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    //Open up a file pointer
    $fp = fopen('php://output', 'w');

    //Start off by writing the column names to the file.
    fputcsv($fp, $columnNames);

    //Then, loop through the rows and write them to the CSV file.
    foreach ($rows as $row) {
        fputcsv($fp, $row);
    }

    //Close the file pointer.
    fclose($fp);
}
    
