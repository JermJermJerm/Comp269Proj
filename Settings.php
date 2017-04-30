<?php 
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
        
        $username = filter_input(INPUT_COOKIE, 'username');
	/* Fetch user details to display in input elements, for updating user details */
	$getUserDetailsQuery = "SELECT userFirstName, userMiddleName, userLastName, userPW, userEmail, userName"
                        . " FROM userstable WHERE userName ='" . $username . "'";
	$getUserDetails = $db->prepare($getUserDetailsQuery); #prepare query
	$getUserDetails->execute(); #execute query
	$userDetails = $getUserDetails->fetch(); #fetch values - will only get 1 row as an array
        $getUserDetails->closeCursor();
	
	echo('<h2>Welcome, ' . $username . ' </h2>');
	#print_r($userDetails); #debug to see the results that we fetched
	
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
		<!--<li><a href="index.php">Home</a></li>
		<li><a href="Teams.html">Teams</a></li>-->
		<li><a href="Settings.php">Settings</a></li>
		<li><a href="Projects.php">Projects</a></li>
		<li><a href="./PHP_Scripts/signout.php" >Sign out</a></li>
	</ul>
	<br> 

	<h1>Settings</h1>
	
	<form action="./PHP_Scripts/changeSettings.php" method="POST" id="settingsForm">
	
		<label>First name:</label>
		<input name="fname" type="text" placeholder="FirstName" 
			<?php echo('value="' . $userDetails['userFirstName'] . '"'); ?>
		/>
		
		<br>
		
		<label>Middle name:</label>
		<input name="midname" type="text" placeholder="MiddleName" 
			<?php echo('value="' . $userDetails['userMiddleName'] . '"'); ?>
		/>
		
		<br>
		
		<label>Last name:</label>
		<input name="lname" type="text" placeholder="LastName" 
			<?php echo('value="' . $userDetails['userLastName'] . '"'); ?>
		/>
		
		<br>
		
		<label>New password:</label>
		<input name="newPass" type="text" placeholder="NewPW" />
		
		<br>
		
		<label>Old password:</label>
		<input name="oldPW1" type="password" placeholder="OldPW" />
		
		<br>
		
		<label>Re-enter old password:</label>
		<input name="oldPW2" type="password" placeholder="OldPW2" />
		
		<br>
		
		<label>Email:</label>
		<input name="email" type="text" placeholder="Email" 
			<?php echo('value="' . $userDetails['userEmail'] . '"'); ?>
		/>
		
		<br>
		
		<label>Username:</label>
		<input name="username" type="text" placeholder="UserName" 
                       <?php echo('value="' . $userDetails['userName'] . '"'); ?>
                />
		
		<br>
		<input type="submit" value="Save settings" />
                
                <!--nested, hidden form for deleting user's account-->

	</form>
                <form method="POST" action="PHP_Scripts/account_delete.php">
                <input type="hidden" name="username" <?php echo('value="' . $username . '"'); ?> />
		<input type="submit" value="Delete Account" />
                </form>
                
</body>

</html>