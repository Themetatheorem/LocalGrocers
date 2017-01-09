<?php
session_start();
if (isset($_SESSION['isLoggedIn'])) {
	echo '<li><a href="Logout.php">Logout</a></li>';
}else {
	echo '<script text="text/javascript"> alert("Please log in") </script>';
	echo '<li><a href="Login.php">Login</a></li>';
}
?>