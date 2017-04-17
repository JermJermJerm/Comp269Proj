<?php 
    /*
	
		At this point we should already have an established connection with the db server
		So, all we really have to do is check for a sessionID if we really wanna be safe
			and a userID
        
    */

        
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
        #TO DO - try-catch error handling
        
        #2: Create the user's account
        $CreateAccountQuery = "CREATE USER '" . $user . "'@'localhost' IDENTIFIED BY '" . $pass . "'";
        $CreateAccount = $db->prepare($CreateAccountQuery);
        $CreateAccount->execute();
        
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
        
        #: Redirect
        header("Location: http://localhost/Comp269Proj/Settings.html");
        die();
        
        /*
            previous requires / includes as redirect experiments
            require('/../Project.html');
            require('/../main.css');
        */