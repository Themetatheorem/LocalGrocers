<!DOCTYPE html>
<html lang="en">
<?php include 'head.inc.php'; ?>

<div id="wrapper">
	<div id="menu">
		<!-- Menu is in an unordered list to allow horizontal mapping across the top -->
		<ul>
			<li><a href="Home.php">Home</a></li>
			<li><a class="active" href="Submit.php">Add New Store</a></li>
			<li><a href="Register.php">Register</a></li>
			<li><a href="Search.php">Search</a></li>
			<?php include 'loggedInCheck.inc.php'; ?>
		</ul>
	</div>
	<!-- This php code below ensures that the page is only visible when user is logged in -->
	<?php 
	if (!isset($_SESSION['isLoggedIn'])) {
		exit();
	}
	?>
	<div id="content">
		<form class="submit_form" method="post" name="submit_form" id="searchcontent" action="">
			<!-- Form to Submit a Review-->
			<label>Store Name:</label>
			<input type="text" name="StoreName" placeholder="Store Name"> <br />
			<label>Store Address:</label>
			<input type="text" name="StoreLocation" placeholder="Store Address">
			<span>Format: 1579 Main St. W, Hamilton, ON L8S 1E6</span> <br />
			<!--<label>Store Review (625 characters):</label>
			<textarea name="StoreReview" cols="40" rows="6" placeholder="Store Review"></textarea> <br /> -->
			<label>Longitude:</label>
			<input type="text" id="Longitude" name="Longitude" placeholder="Longitude"> <br />
			<label>Latitude:</label>
			<input type="text" id="Latitude" name="Latitude" placeholder="Latitude"> <br />

			<input type="submit" name="submit" value="Submit" onclick="return validate(this);">
			<input type="submit" name="submit" value="Upload an Image" onclick="">
		</form>
		<p id="status">Click the button to get your current coordinates.</p>
		<input type="submit" name="submit" value="Find Current Location" onclick="getLocation();">
	</div>

	<?php
	echo"Connection Started";
	if(isset($_POST["submit"])) {
		
		//Server side validation for submission
		$Storename = trim($_POST['StoreName']);
		$StoreLocation = trim($_POST['StoreLocation']);
		//$StoreReview = trim($_POST['StoreReview']);
		$Latitude = trim($_POST['Latitude']);
		$Longitude = trim($_POST['Longitude']);
		
		//Each case has it's own preg_match statement validating their respective parameters
		if(!isset($_POST['StoreName'])){
			echo "<script type='text/javascript'> alert('Enter a Store Name'); </script>";
		}elseif (!(preg_match("/^[0-9a-zA-Z ]*$/", $Storename))){
			echo "<script type='text/javascript'> alert('Store Name can only contain English characters and numbers'); </script>";
			exit();
		}
		if(!isset($_POST['StoreLocation'])){
			echo "<script type='text/javascript'> alert('Enter the Store Location'); </script>";
		}elseif (!(preg_match("/^[0-9a-zA-Z,. ]*$/", $StoreLocation))){
			echo "<script type='text/javascript'> alert('Store Location can only contain English characters and numbers'); </script>";
			exit();
		}
		/*if(!isset($_POST['StoreReview'])){
			echo "<script type='text/javascript'> alert('Enter the first Store Review'); </script>";
		}elseif (!(preg_match("/^[0-9a-zA-Z]*$/", $StoreReview))){
			echo "<script type='text/javascript'> alert('Email is not in correct format'); </script>";
			exit();
		}*/
		if(!isset($_POST['Latitude'])){
			echo "<script type='text/javascript'> alert('Enter the Latitude coordinates of the store'); </script>";
		}elseif (!(preg_match("/-?[0-9]/", $Latitude))){
			echo "<script type='text/javascript'> alert('Latitude only takes positive and negative integers'); </script>";
			exit();
		}
		if(!isset($_POST['Longitude'])){
			echo "<script type='text/javascript'> alert('Enter the Longitude coordinates of the store'); </script>";
		}elseif (!(preg_match("/-?[0-9]/", $Longitude))){
			echo "<script type='text/javascript'> alert('Longitude only takes positive and negative integers'); </script>";
			exit();
		}
		
		echo"Post is set to Submit"; //Test notice: Seeing this means It's working!


		//Pushing vaidated form data to the database
		try {
			$pdo = new PDO('mysql:host=localhost;dbname=localgrocers','root','password');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO `stores` (`StoreName`, `StoreLocation`, `Longitude`, `Latitude`) VALUES ('".$_POST["StoreName"]."','".$_POST["StoreLocation"]."','".$_POST["Longitude"]."','".$_POST["Latitude"]."')";
			if($pdo->query($sql)){
				echo "<script type='text/javascript'> alert('New Record Inserted Successfully');</script>";
			} else {
				echo "<script type='text/javascript'> alert('Data not successfully Inserted');</script>";
			}
			$pdo = null;
		} catch(PDOException $e) {
			echo "User not created. Error: " .$e->getMessage();
		}
		//header('Location: Submit.php');
	}
	?>
	<?php include 'footer.inc.php' ?>
</div>
</body>
</html>