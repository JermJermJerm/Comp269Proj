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
    setcookie("ViewingProjectID", '', time()-86400, '/');

    echo('<h2>Welcome, ' . $username . ' </h2>');

    #ErrorMessage is set in project_create.php if no project name is supplied.
    $ProjectErrorMessage = filter_input(INPUT_COOKIE, 'ProjectErrorMessage');

    if($ProjectErrorMessage != NULL){
        #If we have an error message specifically for the projects page, we will output and unset it.
        echo('<h2 class="ErrorMessage">' . $ProjectErrorMessage . '</h2>');
        setcookie("ProjectErrorMessage", '', time()-86400, '/');
    }

    $getProjectsQuery = "SELECT * FROM projectsTable WHERE projectCreatorID = " . $userID;
    $getProjects = $db->prepare($getProjectsQuery);
    $getProjects->execute();
    $Projects = $getProjects->fetch();

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
            <!--<li><a href="#">Home</a></li>
            <li><a href="Teams.html">Teams</a></li>-->
            <li><a href="Settings.php">Settings</a></li>
            <li><a href="Projects.php">Projects</a></li>
            <li><a href="Teams.php">Teams</a></li>
            <li><a href="./PHP_Scripts/signout.php">Sign out</a></li>
    </ul>
    <br> 

    <h1>Projects</h1>

    <div id="projectDiv">
        <?php
            if($Projects == NULL){
                echo('<h2>No projects to view. Create a project below.<h2>');
            }
            while($Projects != NULL){
                #Create a div for each project
                echo('<ul class="project">');
                    #Fill the list with project information
                    echo('<li>Project Name: ' . $Projects['projectName'] . '</li>');
                    echo('<li>Project Creator: ' . $username . '</li>');
                    echo('<li>Created on: ' . $Projects['projectCreationDate'] . '</li>');

                    #Invisible form for viewing the project on the ViewProject.php view
                    echo('<form method="POST" action="ViewProject.php" class="hiddenForm" >');
                        echo('<input type="hidden" value="' . $Projects['projectID'] . '" name="ProjectID">');
                        #echo('<li>');
                        echo('<input type="submit" value="View Project">');
                        #echo('</li>');
                    echo('</form>');
                    
                    #Invisible form for deleting the project via project_delete.php
                    echo('<form method="POST" action="./PHP_Scripts/project_delete.php" class="hiddenForm">');
                        echo('<input type="hidden" value="' . $Projects['projectID'] . '" name="ProjectID">');
                        #echo('<li>');
                        echo('<input type="submit" value="Delete Project">');
                        #echo('</li>');
                    echo('</form>');
                echo('</ul>');

                #Next Row
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