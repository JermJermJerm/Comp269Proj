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

    $ProjectID = filter_input(INPUT_POST, 'ProjectID');
    
    #Delete the project from the projectstable by matching the projectID passed from a Projects.php form
    $DeleteProjectQuery = "DELETE FROM projectstable WHERE projectID='" . $ProjectID . "'"; 

    $DeleteProject = $db->prepare($DeleteProjectQuery);
    $DeleteProject->execute();
    $DeleteProject->closeCursor();


    #Redirect
    header("Location: http://localhost/DoWhatNow/Projects.php");
        
?>