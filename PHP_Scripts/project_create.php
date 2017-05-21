<?php 
    
    $dsn = 'mysql:host=localhost;dbname=doWhatNowDB';
    $dbu = 'root'; #Replace these with AccountManager in the future
    $dbp = ''; #When we solve the issue of being able to connect as AccountManager
    try{ 
        $db = new PDO($dsn, $dbu, $dbp);

    } catch (PDOException $err) {

    //Print out the error code if we can't
    $error = $err->getMessage();
    echo "<h2>Error: " . $error . "</h2>";
    }

    $projectName = filter_input(INPUT_POST, 'ProjectName');
    $userID = filter_input(INPUT_COOKIE, 'userID');
    
    #set time
    date_default_timezone_set('America/New_York');
    $date = new DateTime();
    $currentTime = $date->format('Y-m-d H:i:s');

    #Only create the project if the projectName supplied is specified / not null
    if($projectName != NULL ){

        #insert the project into the projectstable
        $CreateProjectQuery = "INSERT INTO projectstable (projectID, projectName, projectCreatorID, projectCreationDate) "
            . "VALUES ( 'DEFAULT', '" . $projectName . "', '" . $userID . "', '" . $currentTime . "' )"; 
        
        $CreateProject = $db->prepare($CreateProjectQuery);
        $CreateProject->execute();
        $CreateProject->closeCursor();

    } else {
        $errormsg = "No Project Name Specified.";
        setcookie("ProjectErrorMessage", $errormsg, time()+86400, '/');
    }

    #Redirect
    header("Location: http://localhost/DoWhatNow/Projects.php");
        
?>