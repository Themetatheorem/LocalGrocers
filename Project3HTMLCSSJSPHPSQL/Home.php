<!DOCTYPE html>
<html lang="en">
<?php include 'head.inc.php'; ?>

<div id="wrapper">
	<div id="menu">
<!--<h1>Menu</h1>
	<a href="">Homepage</a><a href="">Contact Us</a>-->
	<ul>
		<li><a class="active" href="Home.php">Home</a></li>
		<li><a href="Submit.php">Add New Store</a></li>
		<li><a href="Register.php">Register</a></li>
		<li><a href="Search.php">Search</a></li>
		<?php include 'loggedInCheck.inc.php'; ?>
	</ul>
</div>
<div id="content">
	<h1>Freshest of the Fresh</h1>
	<p>This section will show grocers with the best reviews. <br /> <br />
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
	<footer id="footer">
		<h6>This is the footer of the page. It might include contact information of FAQ's.</h6>
	</footer>
</div>
</body>
</html>