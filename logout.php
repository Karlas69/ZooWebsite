<?php
session_start();
session_unset();
session_destroy();
unset($_SESSION['logat']);
header("Location: index.php");
?>