<?php
session_start();
session_unset();   // remove all admin session variables
session_destroy(); // destroy session
header("Location: index.php"); // back to admin login page
exit;
