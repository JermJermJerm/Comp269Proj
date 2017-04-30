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
        $userID = filter_input(INPUT_COOKIE, 'userID');
        
	echo('<h2>Welcome, ' . $username . ' </h2>');
        
        
        $getProjectsQuery = "SELECT * FROM projectsTable WHERE projectCreatorID = " . $userID;
        $getProjects = $db->prepare($getProjectsQuery);
        $getProjects->execute();
        $Projects = $getProjects->fetch();
                    print_r($Projects);
        
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
		<li><a href="Settings.php">Settings</a></li>
		<li><a href="Projects.php">Projects</a></li>
		<li><a href="Teams.html">Teams</a></li>
		<li><a href="./PHP_Scripts/signout.php" >Sign out</a></li>
	</ul>
	<br> 

	<h1>Projects</h1>
	
	<div id="projectDiv">
		<ul class="project">
			<li>Project name:</li>
			<li>Project team:</li>
			<li>Number of team members:</li>
			<li>Creation date:</li>
			<li>Deadline:</li>
		</ul>
		<ul class="project">
			<li>Server installation #3498db</li>
			<li>Night Crew</li>
			<li>5 team members</li>
			<li>Creation date: March 6, 2017</li>
			<li>Deadline: March 11, 2017</li>
		</ul>
            <?php
                
                while($Projects != NULL){
                    
                    echo('<ul class="project">');
                    echo('<li>Project Name: ' . $Projects['projectName'] . '</li>');
                    echo('<li>Project Creator: ' . $username . '</li>');
                    echo('<li>Created on: ' . $Projects['projectCreationDate']);
                    echo('</ul>');
                    #Get a project's details
                    $Projects = $getProjects->fetch();
                }
                $getProjects->closeCursor();
            ?>
                
            
		
	</div> <!-- End of Projects container-->
	
	<div class="creationDiv">
		<h2>New Project:</h2>
		<form method="POST" action="PHP_Scripts/project_create.php" class="creationForm">
			<label>Project Name:</label>
			<input type="text" placeholder="Project Name" name="ProjectName">
			
			<input type="submit" value="Create Project">
		</form>
	</div> <!-- End of Projects container-->
	

</body>

</html>