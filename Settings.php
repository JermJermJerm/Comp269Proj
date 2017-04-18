<?php 
	
	/* CONNECT TO DB */
		$dsn = "mysql:host=localhost;dbname=studentsdb";
		$user = 'root';
		$pass = '';
		
		/*
			PDO / PHP Data object that we provide args in order to connect to the database
			Will be used to execute commands to get and change records
		*/
		Try {
		$db = new PDO($dsn, $user, $pass);
		} catch (PDOException $err) {
			
			//Print out the error code if we can't
			$error = $err->getMessage();
			echo "<h2>Error: " . $error . "</h2>"; 
		}
	/* CONNECT TO DB */
	
	/* LIST ALL COOKIES */
	echo('<h2>all cookies:</h2>');
	print_r($_COOKIE);
	/* LIST ALL COOKIES */
	
	/* TODO: Use this block to greet user on login
	if($_COOKIE['username'] == NULL){
		echo('<h1> No username detected </h1>');
	}
	else if ($_COOKIE['username'] != NULL){
		echo('<h1> stored username is ' . $__COOKIE['username'] . '</h1>');
	} */
	
	
	/* Fetch user details to display in input elements, for updating user details */
	
	####### TO DO: MAKE SURE WE ADJUST getUserDetailsQuery TO SEARCH BY USERNAME FROM COOKIE! #######
	####### TO DO: MAKE SURE WE ADJUST getUserDetailsQuery TO SEARCH BY USERNAME FROM COOKIE! #######
		$getUserDetailsQuery = "SELECT userFirstName, userMiddleName, userLastName, userPW, userEmail, userName FROM userstable WHERE userName ='this'";
	####### TO DO: MAKE SURE WE ADJUST getUserDetailsQuery TO SEARCH BY USERNAME FROM COOKIE! #######
	####### TO DO: MAKE SURE WE ADJUST getUserDetailsQuery TO SEARCH BY USERNAME FROM COOKIE! #######
	$getUserDetails = $db->prepare($getUserDetailsQuery); #prepare query
	$getUserDetails->execute(); #execute query
	$userDetails = $getUserDetails->fetch(); #fetch values - will only get 1 row as an array
	
	echo('<h2>all cookies:</h2>');
	print_r($userDetails);
	
	echo('\n $userDetails[userFirstName] = ' . $userDetails['userFirstName']);
?>


<html>

<head>
	<!-- CSS and JS -->
	<link href="styles.php" type="text/css" rel="stylesheet"/>
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
		<input name="fname" type="text" placeholder="FirstName" 
			<?php echo('value="' . $userDetails['userFirstName']) . '"'; ?>
		/>
		
		<br>
		
		<label>Middle name:</label>
		<input name="midname" type="text" placeholder="MiddleName" 
			<?php echo('value="' . $userDetails['userMiddleName']) . '"'; ?>
		/>
		
		<br>
		
		<label>Last name:</label>
		<input name="lname" type="text" placeholder="LastName" 
			<?php echo('value="' . $userDetails['userLastName']) . '"'; ?>
		/>
		
		<br>
		
		<label>New password:</label>
		<input name="newPass" type="text" placeholder="NewPW" />
		
		<br>
		
		<label>Old password:</label>
		<input name="oldPW1" type="text" placeholder="OldPW" />
		
		<br>
		
		<label>Re-enter old password:</label>
		<input name="oldPW2" type="text" placeholder="OldPW2" />
		
		<br>
		
		<label>Email:</label>
		<input name="email" type="text" placeholder="Email" 
			<?php echo('value="' . $userDetails['userEmail']) . '"'; ?>
		/>
		
		<br>
		
		<label>Username: (Automatically checks for availability) </label>
		<input type="text" placeholder="UserName" />
		
		<br>
		
		<input type="submit" value="Save settings"/>
	</form>

</body>

</html>