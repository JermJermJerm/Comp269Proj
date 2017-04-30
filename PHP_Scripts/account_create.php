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
        

        $userID = 'DEFAULT';
	$fName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
	$mName = filter_input(INPUT_POST, 'middleName', FILTER_SANITIZE_SPECIAL_CHARS);
	$lName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
	$pass = filter_input(INPUT_POST, 'password');
	$emailaddr = filter_input(INPUT_POST, 'email');
	$user = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS);
        
	/*
            TODO:
            Validate each one being non-null and meeing that field's requirements, else error message
            For the time being we'll have to let everything go for the sake of functionality and moving forward.
	*/
        #1: Insert the user into the usersTable
        $CreateUserQuery = "INSERT INTO usersTable VALUES (" . $userID . ", " .
                "'" . $fName . "', " . 
                "'" . $mName . "', " . 
                "'" . $lName . "', " . 
                "'" . $pass . "', " . 
                "'" . $emailaddr . "', " . 
                "'" . $user . "')";  #May need semi-colon?

        $CreateUser = $db->prepare($CreateUserQuery);
        $CreateUser->execute();
        $CreateUser->closeCursor();
        setcookie("username", $user, time+3600, "/");
        
        /*
        
            We won't need these for the sake of the project,
            We don't use accountmanager for simplicity sake - 
         * we focus on functionality over security for the time being so we do all table transactions via root
        
        #2: Create the user's account
        $CreateAccountQuery = "CREATE USER '" . $user . "'@'localhost' IDENTIFIED BY '" . $pass . "'";
        $CreateAccount = $db->prepare($CreateAccountQuery);
        $CreateAccount->execute();
        
        #2.1Get the userid by searching for the username, which would be user in this case
        $userIDquery = "'SELECT userID FROM usersTable WHERE username = " . $user . "'";
        $getUserID = $db->prepare($userIDquery);
        $userID = $getUserID->execute();
        setcookie('userID', $userID);	
        #Disconnect from the accountmanager mysql user
        $db=NULL;
        
        #3: Reconnect as the user we just created
        $dbu = $user;
        $dbp = $pass;
         try{ 
            $db = new PDO($dsn, $dbu, $dbp);
        } catch (PDOException $err) {
            //Print out the error code if we can't
            $error = $err->getMessage();
            echo "<h2>Error: " . $error . "</h2>"; 
        }
        */
        #: Redirect
        header("Location: http://localhost/Comp269Proj/Settings.php");
?>