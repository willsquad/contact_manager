<?php

// Set the database access information as constants:
DEFINE ('DB_USER', 'demo_DB_user');
DEFINE ('DB_PASSWORD', 'G004AAARXQ');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'contact_manager_2914');

// Make the connection:

$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if($dbc->connect_errno) {
	die("Connection failed:" . $dbc->connect_error);
}

// Set the character set:
mysqli_set_charset($dbc, 'utf8');



// Omit the closing PHP tag to avoid 'headers already sent' errors!