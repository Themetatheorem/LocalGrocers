<!DOCTYPE html>
<html lang="en">
<?php include 'head.inc.php'; ?>

<div id="wrapper">
	<div id="menu">
		<!-- Menu is in an unordered list to allow horizontal mapping across the top -->
		<ul>
			<li><a href="Home.php">Home</a></li>
			<li><a href="Submit.php">Add New Store</a></li>
			<li><a class="active" href="Register.php">Register</a></li>
			<li><a href="Search.php">Search</a></li>
			<?php include 'loggedInCheck.inc.php'; ?>
		</ul>
	</div>
	<div id="content">
		<form id="searchcontent" method="post">
			<!-- Form to register a new user -->
			<p class="message"> Already Registered? <a href="Login.php">Login here</a></p>
			<label>Name:</label>
			<input type="text" name="name" placeholder="Name" required><span class="form-diagnostic" ></span> <br />
			<label>Username:</label>
			<input type="text" name="username" placeholder="Username" required><span class="form-diagnostic" ></span> <br />
			<label>Email:</label>
			<input type="email" name="email" placeholder="JohnDoe@thelocalgrocers.ca" required><span class="form-diagnostic" ></span> <br />
			<label>Password:</label>
			<input type="password" name="password" placeholder="Password" required><span class="form-diagnostic" ></span> <br />
			<input type="submit" name="submit" value="Submit">
		</form>
	</div>
	<?php include 'footer.inc.php' ?>
</div>
<?php
echo"Connection Started";
if(isset($_POST["submit"])) {
	session_start();
	$name = trim($_POST['name']);
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	if(!isset($_POST['name'])){
		echo "<script type='text/javascript'> alert('Enter a name'); </script>";
	}elseif (!(preg_match("/^[a-zA-Z]*$/", $name))){
		echo "<script type='text/javascript'> alert('Name only takes English alphabet'); </script>";
		exit();
	}
	if(!isset($_POST['username'])){
		echo "<script type='text/javascript'> alert('Enter a username'); </script>";
	}elseif (!(preg_match("/^[0-9a-zA-Z]*$/", $username))){
		echo "<script type='text/javascript'> alert('Username is restricted to numbers and letters'); </script>";
		exit();
	}
	if(!isset($_POST['email'])){
		echo "<script type='text/javascript'> alert('Enter a valid email address'); </script>";
	}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo "<script type='text/javascript'> alert('Email is not in correct format'); </script>";
		exit();
	}
	echo"Post is set to Submit";
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=localgrocers','root','password');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$salt = bin2hex(openssl_random_pseudo_bytes(20));
		$Passwordhash = hash('sha256', $salt.$_POST["password"]);
		$sql = "INSERT INTO `users` (`Name`, `Username`, `Email`, `Passwordhash`, `Salt`) VALUES ('".$_POST["name"]."','".$_POST["username"]."','".$_POST["email"]."','$Passwordhash','$salt')";
		if($pdo->query($sql)){
			echo "<script type='text/javascript'> alert('New Record Inserted Successfully');</script>";
			echo "Connected Successfully. Account created";
		} else {
			echo "<script type='text/javascript'> alert('Data not successfully Inserted');</script>";
		}
		$pdo = null;
	} catch(PDOException $e) {
		echo "User not created. Error: " .$e->getMessage();
	}
	header('Location: Login.php');
}
?>
</body>
</html>