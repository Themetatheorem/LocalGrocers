//script for Google Map API
function initMap() {
	//hardcoded values for markers
	var value = {lat:43.2589, lng:-79.9205};
	var value1 = {lat:43.2553, lng:-79.9289};
	var value2 = {lat:43.5921, lng:-79.6257};
	var value3 = {lat:43.5927, lng:-79.6430};
	//map initialization according to map id
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 8,
		center: value
	});
	//map marker initializations
	var marker = new google.maps.Marker({
		position: value,
		map: map
	});
	var marker1 = new google.maps.Marker({
		position: value1,
		map: map
	});
	var marker2 = new google.maps.Marker({
		position: value2,
		map: map
	});
	var marker3 = new google.maps.Marker({
		position: value3,
		map: map
	});
};
//This function is supposed to have a single value, but it's not working. initMap function will create a placeholder map for this.
/*function initMapDet() {}
	var mapdet = new google.maps.Map(document.getElementById('mapdet'), {
		zoom: 8,
		center: value1
	});
	var marker1det = new google.maps.Marker({
		position: value1,
		map: mapdetail
	});*/

//Geolocation functions retrieved from example provided in Avenue
function getLocation() {
	//This function either displays the user's current location, or the error that they have encountered.
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		document.getElementBykId("status").innerHTML="Geolocation is not supported by this browser.";
	}
};
function showPosition(position) {
		//This function retrieves the coordinates determined by the browser's Geolocation method.
		document.getElementById("status").innerHTML = "Latitude: " + position.coords.latitude + ", Longitude: " + position.coords.longitude;
		var x = position.coords.latitude;
		var y = position.coords.longitude;
		var usercoord = {lat:x, lng:y};
		var mapholder = new google.maps.Map(document.getElementById('mapholder'),{
			zoom: 15,
			center: usercoord
		});
		//marker for geolocation retrieved coordinates
		var usermarker = new google.maps.Marker({
			position: usercoord,
			map:mapholder
		});
	};
	function showError(error) {
		//error cases and corresponding messages
		var msg = "";
		switch(error.code) {
			case error.PERMISSION_DENIED:
			msg = "User denied the request for Geolocation."
			break;
			case error.POSITION_UNAVAILABLE:
			msg = "Location information is unavailable."
			break;
			case error.TIMEOUT:
			msg = "The request to get user location timed out."
			break;
			case error.UNKNOWN_ERROR:
			msg = "An unknown error occurred."
			break;
		}
		document.getElementById("status").innerHTML = msg;
	};
/*
NOT USING THIS FUNCTION BECAUSE IT SEEMS TO BREAK SOMEWHERE
function options = {
	//This function enlists the options for my Geolocator, for higher accuracy.
	enableHighAccuracy: true,
};*/
function validate(form) {
	//Used minimal form validation to ensure that all fields are filled since they are only textboxes
	if (document.submit_form.StoreName.value == "") {
		window.alert("No Store Name entered.");
		document.submit_form.StoreName.focus();
		return false;
	}
	if (document.submit_form.StoreLocation.value == "") {
		window.alert("No Store Address entered.");
		document.submit_form.StoreLocation.focus();
		return false;
	}
	if (document.submit_form.StoreReview.value == "") {
		window.alert("Please add the first review of the store.");
		document.submit_form.StoreReview.focus();
		return false;
	}
	if (document.submit_form.Longitude.value == "" || document.submit_form.Latitude.value == "") {
		window.alert("Please enter the Latitude and Longitude of the store location.");
		document.submit_form.Longitude.focus();
		return false;
	}
	//checks if latitude and longitude fields are numbers.
	if (isNaN(document.submit_form.Longitude.value) || isNaN(document.submit_form.Latitude.value)) {
		window.alert("Only numbers can be put in the Latitude and Longitude fields");
		document.submit_form.Longitude.focus();
		return false;
	}
	return true;
}
//The following function was taken from the slides provided in class to stop scripting attacks on website.
function escapeHtml(str) {
	var div =
	document.createElement('div');
	div.appendChild(
		document.createTextNode(str)
		);
	return div.innerHTML;
};