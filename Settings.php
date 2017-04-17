<?php 
	if($_COOKIE['userID'] == NULL){
		echo('<h1> No UserID detected </h1>');
	}
	else if ($_COOKIE['userID'] != NULL){
		echo('<h1> stored userID is ' . $_COOKIE['userID'] . '</h1>');
	}
?>


<html>

<head>
	<!-- CSS and JS -->
	<link href="main.css" type="text/css" rel="stylesheet"/>
</head>

<body>
	<div class="topBanner">
		<p>Do What Now?</p>
	</div>
	
	<ul class="navUL">
		<li><a href="#">Home</a></li>
		<li><a href="#">Settings</a></li>
		<li><a href="#">Projects</a></li>
		<li><a href="#">Teams</a></li>
		<li><a href="./PHP_Scripts/signout.php" >Sign out</a></li>
	</ul>
	<br> 

	<h1>Settings</h1>
	
	<form action="changeSettings.php" method="POST" id="settingsForm">
	
		<label>First name:</label>
		<input type="text" placeholder="FirstName" />
		
		<br>
		
		<label>Middle name:</label>
		<input type="text" placeholder="MiddleName" />
		
		<br>
		
		<label>Last name:</label>
		<input type="text" placeholder="LastName" />
		
		<br>
		
		<label>New password:</label>
		<input type="text" placeholder="NewPW" />
		
		<br>
		
		<label>Old password:</label>
		<input type="text" placeholder="OldPW" />
		
		<br>
		
		<label>Re-enter old password:</label>
		<input type="text" placeholder="OldPW2" />
		
		<br>
		
		<label>Email:</label>
		<input type="text" placeholder="Email" />
		
		<br>
		
		<label>Username: (Automatically checks for availability) </label>
		<input type="text" placeholder="UserName" />
		
		<br>
		
		<input type="submit" value="Save settings"/>
	</form>

</body>

</html>