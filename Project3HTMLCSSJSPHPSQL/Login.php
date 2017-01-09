<!DOCTYPE html>
<html lang="en">
<?php include 'head.inc.php'; ?>

<div id="wrapper">
	<div id="menu">
<!--<h1>Menu</h1>
	<a href="">Homepage</a><a href="">Contact Us</a>-->
	<ul>
		<li><a href="Home.php">Home</a></li>
		<li><a href="Submit.php">Add New Store</a></li>
		<li><a href="Register.php">Register</a></li>
		<li><a href="Search.php">Search</a></li>
		<li><a class="active" href="Login.php">Login</a></li>
	</ul>
</div>
<div id="content">
	<form class="login-form" action="" method="post" >
		<p class="message"> Not Registered? <a href="Register.php">Create an account.</a></p>
		<input type="text" name="username" placeholder="Username" required /> <br />
		<input type="password" name="password" placeholder="Password" required /> <br />
		<input type="submit" name="submit" value="Login" /> <br />
	</form>
</div>
<?php include 'footer.inc.php' ?>
</div>

<?php
echo"Connection Started";
if(isset($_POST["submit"])) {
	echo"Post is set to Submit";
	try{
	$pdo = new PDO('mysql:host=localhost;dbname=localgrocers','root','password');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$usercheck = $_POST['username'];
	$passwordcheck = $_POST['password'];
	if(isset($_POST["username"])&isset($_POST["password"])){
		$sql = $pdo->prepare("SELECT `Name`, `Username`, `Email`, `Passwordhash`, `Salt` FROM `users` WHERE `Username` = '$usercheck'");
		$sql->execute();
		$record = $sql->fetch(PDO::FETCH_ASSOC);
		if($record["Username"] == $usercheck & $record["Passwordhash"] == hash('sha256', $record['Salt'].$passwordcheck)){
			echo "Record check works";
			session_start();
			$_SESSION['isLoggedIn'] = true;
				//header('Location:Home.php');
			echo "<script type='text/javascript'> alert('Logged In');</script>";
			echo"Log in successful";
			echo $record["Username"];
			echo $record["Passwordhash"];
			exit();
		}
	}else{	
		echo "<script type='text/javascript'> alert('Incomplete login information');</script>";
		//header('Location: Login.php');
	}
}
catch(PDOException $s){
			echo "Error : " .$s->getMessage();
}	
	/*
	foreach ($record as $entry){
		echo "in foreach";
		if($_POST['username']==$entry['Username']&hash('sha256', $entry['Salt'].$_POST['password']==$entry['Passwordhash'])){
			echo "in if";
			session_start();
			$_SESSION['isLoggedIn'] = true;
				//header('Location:Home.php');
			echo "<script type='text/javascript'> alert('Logged In');</script>";
			echo"Log in successful";
			exit();
		}
	}*/
	$pdo = null;
//header('Location: Login.php');
}
?>

</body>
</html>