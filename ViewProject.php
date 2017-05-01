<?php 
    $dsn = "mysql:host=localhost;dbname=studentsdb";
    $user = 'root';
    $pass = '';
    try {
        $db = new PDO($dsn, $user, $pass);
    } catch (PDOException $err) {
        $error = $err->getMessage();
        echo "<h2>Error: " . $error . "</h2>"; 
    }	

    $username = filter_input(INPUT_COOKIE, 'username');
    $userID = filter_input(INPUT_COOKIE, 'userID');
    $projectID = filter_input(INPUT_POST, 'ProjectID');

    if($projectID!=NULL){

        #this cookie will only get set if projectID was passed via POST
        #we won't need to set this again after redirects if it's still a cookie
        setcookie("ViewingProjectID", $projectID, time()+3600, '/');
    } else if ($projectID==NULL){
        #We're redundant with this because the rest of the page uses $projectID rather than the cookie value
        #so we just access the cookie value by setting it as a variable
        $projectID = filter_input(INPUT_COOKIE, 'ViewingProjectID');
    }
    $taskErrMsg = filter_input(INPUT_COOKIE, 'NewTaskError');


    echo('<h2>Welcome, ' . $username . ' </h2>');

    if($taskErrMsg != NULL){
        #If we have an error message specifically for the projects page, we will output and unset it.
        echo('<h2 class="ErrorMessage">' . $taskErrMsg . '</h2>');
        setcookie("NewTaskError", '', time()-86400, '/');
    }

    $getProjectQuery = "SELECT * FROM projectsTable WHERE projectID = '" . $projectID . "'";
    $getProject = $db->prepare($getProjectQuery);
    $getProject->execute();
    $Project = $getProject->fetch();
    $getProject->closeCursor();

    $getTasksQuery = "SELECT * FROM taskstable WHERE parentProjectID = '" . $projectID . "'";
    $getTasks = $db->prepare($getTasksQuery);
    $getTasks->execute();
    $Tasks = $getTasks->fetch();

    #$getTasksQuery = "SELECT * FROM tasks ";

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
            <li><a href="./PHP_Scripts/signout.php">Sign out</a></li>
    </ul>
    <br> 

    <h1>Project: <?php echo($Project['projectName']); ?> </h1>

    <div id="projectDiv">



        <?php 
            #Existing Task goes here
            #TO-DO: another invisible form for marking tasks as in/complete and a php file for it 
            echo('<h3>Tasks</h3>');
            echo('<ul id="tasksUL">'); #start of tasksUL
                while($Tasks != NULL){
                    echo('<div class="task">');
                    
                        echo('<li>Task Name: ' . $Tasks['taskName'] . '</li>' );
                        #echo('<li>Task ID: ' . $Tasks['taskID'] . '</li>');
                        echo('<li>');
                            #Invisible form for deleting each task
                            echo('<form method="POST" action="./PHP_Scripts/task_delete.php">');
                            echo('<input type="hidden" value="' . $Tasks['taskID'] . '" name="taskID">');
                            echo('<input type="submit" value="Delete Task">');  
                            echo('</form>');
                        echo('</li>');
                    
                    echo('</div>');
                    
                    $Tasks=$getTasks->fetch();
                }
                $getTasks->closeCursor();

            echo('</ul>'); #end of tasksUL

            #Form for adding a new task
            echo('<form method="POST" action="./PHP_Scripts/task_create.php" class="creationForm">');
            echo('<input type="hidden" value="' . $projectID . '" name="projectID">');
            echo('<input type="text" name="newTaskName" placeholder="New Task Name Here">');
            echo('<input type="submit" value="Create New Task">');
            echo('</form>');
        ?>

    </div> <!-- End of Projects container-->

</body>

</html>