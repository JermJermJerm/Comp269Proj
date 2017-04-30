<?php 
    /*
	#Connect to database -> validate input -> redirect appropriately
        require('AccountManager.php');
	
	#$missingFields = array();
     */
        $dsn = 'mysql:host=localhost;dbname=studentsdb';
        $dbu = 'root'; #Replace these with AccountManager in the future
        $dbp = ''; #When we solve the issue of being able to connect as AccountManager
        try{ 
            $db = new PDO($dsn, $dbu, $dbp);
        
        } catch (PDOException $err) {
        
        //Print out the error code if we can't
        $error = $err->getMessage();
        echo "<h2>Error: " . $error . "</h2>"; 
    }
        
        $username = filter_input(INPUT_COOKIE, 'username');
        $projectName = filter_input(INPUT_POST, 'ProjectName');
        $userID = filter_input(INPUT_COOKIE, 'userID');
        
        #1: Insert the project into projectstable
        $CreateProjectQuery = "INSERT INTO projectstable (projectID, projectName, projectCreatorID, projectCreationDate) "
                . "VALUES ( 'DEFAULT', " .
                "'" . $projectName . "', " .  
                "'" . $userID . "', "
                . time() . " )"; 

        $CreateProject = $db->prepare($CreateProjectQuery);
        $CreateProject->execute();
        $CreateProject->closeCursor();
        
        #: Redirect
        header("Location: http://localhost/Comp269Proj/Projects.php");
?>