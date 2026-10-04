
<?php

// server configuration
define('SERVER_NAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'db_examiq');

// email sender configuration
define('ADMIN_EMAIL', 'raj.tripathi.090806@gmail.com');
define('APP_PASSWORD', 'kcvs gwjq rpoq jhbt');
define('ADMIN_NAME', 'ExamiQ'); // display name for the sender's email



// establishing connection with the server
$conn = mysqli_connect(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);
if (!$conn) { die("Database Connection Failed: " . mysqli_connect_error()); }



// starting the session if not already started
if (session_status() === PHP_SESSION_NONE) { session_start(); }



// using the following line of code to enable the try-catch block in php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

?>
