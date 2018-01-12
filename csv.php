<?php 
// Set the database access information as constants:
DEFINE ('DB_USER', 'demo_DB_user');
DEFINE ('DB_PASSWORD', 'G004AAARXQ');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'contact_manager_2914');

// Make the connection:

$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
$user_id = 1;
//echo $to_export_array[$i];

$result = $dbc->query("SELECT `c_id`, `c_fname`, `c_lname`, `c_mname`, `c_email`, `c_phone`, `c_organization`, `c_jobTitle`, `c_workPhone`, `c_dob`, `c_gender`, `c_website`, `c_linkedin`, `c_twitter`, `c_facebook` FROM `contacts_8521` WHERE `added_by_u_id` = $user_id AND `is_deleted_contact` = 0");


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
        $columnNames[] = $colName;
    }
}

//Setup the filename that our CSV will have when it is downloaded.
$fileName = 'contacts.csv';

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
