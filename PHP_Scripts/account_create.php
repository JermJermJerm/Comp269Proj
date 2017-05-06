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
        
	$fName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
	$mName = filter_input(INPUT_POST, 'middleName', FILTER_SANITIZE_SPECIAL_CHARS);
	$lName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
	$pass = filter_input(INPUT_POST, 'password');
	$emailaddr = filter_input(INPUT_POST, 'email');
	$user = filter_input(INPUT_POST, 'userName');
        
	/*
            TODO:
            -See what's null and highlight as an error message
            -Check if the username has been taken
	*/
        # Insert the user into the usersTable
        $CreateUserQuery = "INSERT INTO usersTable VALUES ('DEFAULT', " .
                "'" . $fName . "', " . 
                "'" . $mName . "', " . 
                "'" . $lName . "', " . 
                "'" . $pass . "', " . 
                "'" . $emailaddr . "', " . 
                "'" . $user . "')";  #May need semi-colon?

        $CreateUser = $db->prepare($CreateUserQuery);
        $CreateUser->execute();
        $CreateUser->closeCursor();
        
        # Get the user's ID after creating the account
        
        $GetUserIDQuery = "SELECT userID FROM userstable WHERE userName='" . $user . "'";
        $GetUserID = $db->prepare($GetUserIDQuery);
	$GetUserID->execute();
        $UserID = $GetUserID->fetch();
        $GetUserID->closeCursor();
        
        setcookie("username", $user, time()+86400, "/");
       
        # Redirect
        header("Location: http://localhost/Comp269Proj/Settings.php");
?>