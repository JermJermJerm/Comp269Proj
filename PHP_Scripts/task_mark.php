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
    $markTaskAs = filter_input(INPUT_POST, 'action'); #0 for marking as incomplete, 1 for marking as complete
    $userID = filter_input(INPUT_COOKIE, 'userID');
    #$projectID = filter_input(INPUT_COOKIE, 'ViewingProjectID'); I don't think we need this
    
    
    if($markTaskAs==1){
        #Include taskCompletionDate if it is being marked as complete
        date_default_timezone_set('America/New_York');
        $date = new DateTime();
        $currentTime = $date->format('Y-m-d H:i:s');
        
        $MarkTaskQuery = "UPDATE taskstable SET taskcompleted=" . $markTaskAs . ", taskCompletionDate='"
                . $currentTime . "'  WHERE taskID=" . $taskID;
    } else {
        #Set taskCompletionDate to null when setting as incomplete
            ##if taskCompletionDate is not set to NULL it will be set as 0000-00-00
        $MarkTaskQuery = "UPDATE taskstable SET taskcompleted=" . $markTaskAs . ", taskCompletionDate=NULL"
                . "  WHERE taskID=" . $taskID;
    }
   
    $MarkTask = $db->prepare($MarkTaskQuery);
    $MarkTask->execute();
    $MarkTask->closeCursor();

    #Redirect
    header("Location: http://localhost/DoWhatNow/ViewProject.php");