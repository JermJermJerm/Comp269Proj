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

    $taskID = filter_input(INPUT_POST, 'taskID');
    
    #Delete the project from the projectstable by matching the projectID passed from a Projects.php form
    $DeleteTaskQuery = "DELETE FROM taskstable WHERE taskID='" . $taskID . "'"; 

    $DeleteTask = $db->prepare($DeleteTaskQuery);
    $DeleteTask->execute();
    $DeleteTask->closeCursor();


    #Redirect
    header("Location: http://localhost/DoWhatNow/ViewProject.php");
        
?>