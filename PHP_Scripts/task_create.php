<?php 
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

    $newTaskName = filter_input(INPUT_POST, 'newTaskName');
    $userID = filter_input(INPUT_COOKIE, 'userID');
    $projectID = filter_input(INPUT_COOKIE, 'ViewingProjectID');
    
    #set time
    date_default_timezone_set('America/New_York');
    $date = new DateTime();
    $currentTime = $date->format('Y-m-d H:i:s');

    #Only create the project if the projectName supplied is specified / not null
    if($newTaskName != NULL ){

        #insert the project into the projectstable
        $CreateTaskQuery = "INSERT INTO taskstable (taskID, taskName, taskCreator, taskCreationDate, parentProjectID) "
            . "VALUES ( 'DEFAULT', '" . $newTaskName . "', '" . $userID . "', '" . $currentTime . "', '" . $projectID . "')"; 
        
        $CreateTask = $db->prepare($CreateTaskQuery);
        $CreateTask->execute();
        $CreateTask->closeCursor();

    } else {
        $errormsg = "No Task Name Specified.";
        setcookie("NewTaskError", $errormsg, time()+86400, '/');
    }

    #Redirect
    header("Location: http://localhost/Comp269Proj/ViewProject.php");
        
?>