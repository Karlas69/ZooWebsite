<?php
include("config.php");
// Start session
session_start();
// Check if user is logged and existing session
if(isset($_SESSION['logat'])) {
// Content for user logged
    Header("Location: Management.php");
} else {
// Redirecting to login page
    Header("Location: index.php");
}
?>