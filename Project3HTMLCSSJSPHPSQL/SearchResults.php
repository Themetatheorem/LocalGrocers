<!DOCTYPE html>
<html lang="en">
<?php include 'head.inc.php'; ?>

<div id="wrapper">
	<div id="menu">
		<ul>
			<li><a href="Home.php">Home</a></li>
			<li><a href="Submit.php">Add New Store</a></li>
			<li><a href="Register.php">Register</a></li>
			<li><a class="active" href="Search.php">Search</a></li>
			<?php include 'loggedInCheck.inc.php'; ?>
		</ul>
	</div>

	<div id="content">
		<h1>Search</h1>
		<div id="map"></div>
		<script src= "https://maps.googleapis.com/maps/api/js?key=AIzaSyCFpBvjJfv3pbe2BpiteiuyEcPgm5ypxSg&callback=initMap">
		</script>

	<?php
	if (isset($_POST['submit'])&isset($_POST['search'])) {
		$searchstr = $_POST['search'];
		try{
			$pdo = new PDO('mysql:host=localhost;dbname=localgrocers','root','password');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = $pdo->prepare("SELECT * FROM `stores` WHERE `StoreName` = '$searchstr'");
				$sql->execute();
				$record = $sql->fetch(PDO::FETCH_ASSOC);
				$numRows = $sql->rowCount();

				if($numRows > 0){
					echo "
					<table style='width:100%'>
					<tr>
					<th>Name</th>
					<th>Location</th>
					<th>Map</th>
					</tr>
					";
					$r=0;
					while($r < $numRows){
						echo"
						<td><a href='Details.php?id=".$record['ID']."'>".$record['StoreName']."</a></td>
						<td>".$record['StoreLocation']."</td>
						<td><iframe src='https://maps.google.com/maps?q=".$record['StoreLocation']."&output=embed'></iframe></td>
						";
						$r++;
					}
				}else{
					echo "0 results found";
				}
		}catch(PDOException $s){
		echo "Error : " .$s->getMessage();
	}
}else{
	echo "<script type='text/javascript'> alert('Please enter a search query');</script>";
}
?>

<!-- 		<table style="width:100%">
			<tr>
				<th>Name</th>
				<th>Location</th>
				<th>Hours</th>
				<th>Map</th>
			</tr>
			<tr>
				<td><a href="Details.php">Fortinos</a></td> This is the only active link on the page for now. It takes the user to more Details
				<td>1579 Main St. W,<br /> Hamilton, ON L8S 1E6</td>
				<td>All Days:<br />7AM-10PM</td>
				<td>
					<iframe src="https://maps.google.com/maps?q=Fortinos+1579+Main+St.+W,+Hamilton,+ON+L8S+1E6&output=embed"></iframe>
				</td>
			</tr>
			<tr>
				<td><a href="">Metro</a></td>
				<td>1585 Mississauga Valley Blvd.,<br /> Mississauga, ON L5A 3W9</td>
				<td>Week Days:<br />Open 24 hours<br />Saturday:<br />7AM-12AM<br />Sunday:<br />12AM-10PM</td>
				<td>
					<iframe src="https://maps.google.com/maps?q=Fortinos+1579+Main+St.+W,+Hamilton,+ON+L8S+1E6&output=embed"></iframe>
				</td>
			</tr>
			<tr>
				<td><a href="">WalMart</a></td>
				<td>100 City Centre Dr.,<br /> Mississauga, ON L5B 2C9</td>
				<td>All Days:<br />7AM-11PM</td>
				<td>
					<iframe src="https://maps.google.com/maps?q=Fortinos+1579+Main+St.+W,+Hamilton,+ON+L8S+1E6&output=embed"></iframe>
				</td>
			</tr>
		</table> -->
	</div>
</div>
</body>
</html>