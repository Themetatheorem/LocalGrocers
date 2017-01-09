<!DOCTYPE html>
<html lang="en">
<?php include 'head.inc.php'; ?>

<div id="wrapper">
	<div id="menu">
		<!-- Menu is in an unordered list to allow horizontal mapping across the top -->
		<ul>
			<li><a href="Home.php">Home</a></li>
			<li><a href="Submit.php">Add New Store</a></li>
			<li><a href="Register.php">Register</a></li>
			<li><a class="active" href="Search.php">Search</a></li>
			<?php include 'loggedInCheck.inc.php'; ?>
		</ul>
	</div>

	<div id="content">
		<?php
		$id=$_GET['id'];

		try{
			$pdo = new PDO('mysql:host=localhost;dbname=localgrocers','root','password');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = $pdo->prepare("SELECT * FROM `stores` WHERE `ID` = '$id'");
			$sql->execute();
			$record = $sql->fetch(PDO::FETCH_ASSOC);
			echo "<h2>".$record['StoreName']."</h2>";
			echo "
			<h3>Address:</h3>
			<p>".$record['StoreLocation']."</p>
			";
		}catch(PDOException $s){
			echo "Error : " .$s->getMessage();
		}
		?>
		<img src="metro-logo.png" /> <!-- This is only here to represent the picture of the location -->
		<h3>Map:</h3>
		<div id="map"></div>
		<script src= "https://maps.googleapis.com/maps/api/js?key=AIzaSyCFpBvjJfv3pbe2BpiteiuyEcPgm5ypxSg&callback=initMap">
		</script>

		<?php
		$id=$_GET['id'];

		try{
			$pdo = new PDO('mysql:host=localhost;dbname=localgrocers','root','password');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = $pdo->prepare("SELECT * FROM `reviews` WHERE `StoreID` = '$id'");
			$sql->execute();
			$record = $sql->fetch(PDO::FETCH_ASSOC);
			$numRows = $sql->rowCount();

				if($numRows > 0){
					echo "
					<table style='width:100%'>
					<tr>
					<th>user</th>
					<th>Review</th>
					</tr>
					";
					$r=0;
					while($r < $numRows){
						echo"
						<td>".$record['Username']."</td>
						<td>".$record['StoreReview']."</td>
						";
						$r++;
					}
				}else{
					echo "0 results found";
				}
		}catch(PDOException $s){
			echo "Error : " .$s->getMessage();
		}
		?>
		
		<!--<iframe src="https://maps.google.com/maps?q=Fortinos+1579+Main+St.+W,+Hamilton,+ON+L8S+1E6&output=embed"></iframe>
		<h3>Reviews:</h3>
		<h4>Meet Pandya</h4>
		<p>Best grocery store I have shopped at in years! Glad I made the switch!</p>
		<h4>Dragan Erak</h4>
		<p>Boo! I could not find my special Serbian raspberries at this store. I'm going to the place my baka recommended instead! :(</p>
		<h4>Rob Gorrie</h4>
		<p>Meh... It's aight</p>
	-->


</div>

<footer id="footer">
	<h6>This is the footer of the page. It might include contact information of FAQ's.</h6>
</footer>
</div>
</body>
</html>