<?php

// Require the configuration before any PHP code as the configuration controls error reporting:
require('./include/config.inc.php');

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();

header("Location:".BASE_URL."login.php");