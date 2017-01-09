<?php
session_start();
unset($_SESSION['isLoggedIn']);
echo '<script text="text/javascript"> alert("You have been logged out") </script>';
header('Location: Login.php');
?>