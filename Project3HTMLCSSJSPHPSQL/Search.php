<!DOCTYPE html>
<html lang="en">
<?php 

include 'head.inc.php';
?>

<div id="wrapper">
	<div id="menu">
		<!-- Menu is in an unordered list to allow horizontal mapping across the top -->
		<ul>
			<li><a href="Home.php">Home</a></li>
			<li><a href="Submit.php">Submit a Review</a></li>
			<li><a href="Register.php">Register</a></li>
			<li><a class="active" href="Search.php">Search</a></li>
			<?php include 'loggedInCheck.inc.php'; ?>
		</ul>
	</div>
	<div id="content">
		<form id="searchcontent" action="SearchResults.php" method="post">
			<!-- Form to make button and "enter" key to push to SearchResults.htm page -->
			<input type="text" name="search" placeholder="Search">
			<br />
			<br />
			<input type="submit" name="submit" value="Submit">
			<br />
			<br />
		</form>
		<input type="submit" id="test" name="submit" value="Your Location" onclick="getLocation()">
		<p id="status">Click the button to get your coordinates.</p>
		<div id="mapholder"></div>
		<script src= "https://maps.googleapis.com/maps/api/js?key=AIzaSyCFpBvjJfv3pbe2BpiteiuyEcPgm5ypxSg&callback=initMap">
		</script>
	</div>
	<?php include 'footer.inc.php' ?>
</div>
</body>
</html>