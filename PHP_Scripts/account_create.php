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
        #setcookie() - fetch the userID that was set when the account was created
       
        #: Redirect
        header("Location: http://localhost/Comp269Proj/Settings.php");
?>