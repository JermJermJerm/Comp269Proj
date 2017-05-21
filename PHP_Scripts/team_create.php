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

    $teamName = filter_input(INPUT_POST, 'TeamName');
    $userID = filter_input(INPUT_COOKIE, 'userID');
    
    #set time
    date_default_timezone_set('America/New_York');
    $date = new DateTime();
    $currentTime = $date->format('Y-m-d H:i:s');

    #Only create the project if the projectName supplied is specified / not null
    if($teamName != NULL ){
        
        #try catch block here 
        #insert the project into the projectstable
        $CreateTeamQuery = "INSERT INTO teamsTable (teamID, teamName, teamCreator, teamCreationDate) "
            . "VALUES ( 'DEFAULT', '" . $teamName . "', '" . $userID . "', '" . $currentTime . "' )"; 
        
        $CreateTeam = $db->prepare($CreateTeamQuery);
        $CreateTeam->execute();
        $CreateTeam->closeCursor();
        
        $GetTeamIDQuery = "SELECT teamID FROM teamsTable WHERE teamName='" . $teamName . "'";
        $getTeamID = $db->prepare($GetTeamIDQuery);
        $getTeamID->execute();
        $teamID = $getTeamID->fetch();
        $getTeamID->closeCursor();
        
        $CreateTeamMembershipQuery = "INSERT INTO teamMembershipsTable (userID, teamID) " 
                . "VALUES ('" . $userID . "', '" . $teamID . "')";
        $CreateMembershipQuery = $db->prepare($CreateTeamMembershipQuery);
        $CreateMembershipQuery->execute();
        $CreateMembershipQuery->closeCursor();
        
    } else {
        $errormsg = "No Team Name Specified.";
        setcookie("TeamErrorMessage", $errormsg, time()+86400, '/');
    }

    #Redirect
    header("Location: http://localhost/DoWhatNow/Teams.php");
        
?>