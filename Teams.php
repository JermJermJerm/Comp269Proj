<?php 
    $dsn = "mysql:host=localhost;dbname=doWhatNowDB";
    $user = 'root';
    $pass = '';
    Try {
        $db = new PDO($dsn, $user, $pass);
    } catch (PDOException $err) {
        $error = $err->getMessage();
        echo "<h2>Error: " . $error . "</h2>"; 
    }	

    $username = filter_input(INPUT_COOKIE, 'username');
    $userID = filter_input(INPUT_COOKIE, 'userID');

    #unset this cookie because we'll set it again later when we click on another project to view
    #setcookie("ViewingTeamID", '', time()-86400, '/');

    echo('<h2>Welcome, ' . $username . ' </h2>');

    #ErrorMessage is set in project_create.php if no project name is supplied.
    $TeamErrorMessage = filter_input(INPUT_COOKIE, 'TeamErrorMessage');

    if($TeamErrorMessage != NULL){
        #If we have an error message specifically for the projects page, we will output and unset it.
        echo('<h2 class="ErrorMessage">' . $TeamErrorMessage . '</h2>');
        setcookie("TeamErrorMessage", '', time()-86400, '/');
    }

    $getTeamsQuery = "SELECT * FROM teamMembershipsTable WHERE userID = " . $userID;
    $getTeams = $db->prepare($getTeamsQuery);
    $getTeams->execute();
    $Teams = $getTeams->fetch();
    
    #Debug statement to show we're actually getting results
    #print_r($Projects);    
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
            <li><a href="Settings.php">Settings</a></li>
            <li><a href="Projects.php">Projects</a></li>
            <li><a href="Teams.php">Teams</a></li>
            <li><a href="./PHP_Scripts/signout.php">Sign out</a></li>
    </ul>
    <br> 

    <h1>Teams</h1>

    <div id="projectDiv">
        <?php
            if($Teams == NULL){
                echo('<h2>You are not a part of any teams. Create a team below.<h2>');
            }
            while($Teams != NULL){
                #Create a div for each project
                echo('<ul class="project">');
                    #Fill the list with project information
                    echo('<li>Team Name: ' . $Teams['teamName'] . '</li>');
                    echo('<li>Project Creator: ' . $username . '</li>');
                    echo('<li>Created on: ' . $Teams['teamCreationDate'] . '</li>');

                    #Invisible form for viewing the project on the ViewProject.php view
                    echo('<form method="POST" action="ViewProject.php" class="hiddenForm" >');
                        echo('<input type="hidden" value="' . $Teams['teamID'] . '" name="ProjectID">');
                        #echo('<li>');
                        echo('<input type="submit" value="View Project">');
                        #echo('</li>');
                    echo('</form>');
                    
                    #Invisible form for deleting the project via project_delete.php
                    echo('<form method="POST" action="./PHP_Scripts/project_delete.php" class="hiddenForm">');
                        echo('<input type="hidden" value="' . $Teams['teamID'] . '" name="ProjectID">');
                        #echo('<li>');
                        echo('<input type="submit" value="Delete Project">');
                        #echo('</li>');
                    echo('</form>');
                echo('</ul>');

                #Next Row
                $Teams = $getTeams->fetch();
            }
            $getTeams ->closeCursor();
        ?>



    </div> <!-- End of Projects container-->

    <div class="creationDiv">
        <h2>New Team:</h2>
        <form method="POST" action="PHP_Scripts/team_create.php" class="creationForm">
                <label>Team Name:</label>
                <input type="text" placeholder="Team Name" name="TeamName">

                <input type="submit" value="Create Team">
        </form>
    </div> <!-- End of Projects container-->

</body>

</html>