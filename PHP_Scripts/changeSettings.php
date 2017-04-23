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
        	
	#Get input from form via POST array	
	$fName = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_SPECIAL_CHARS);
	$mName = filter_input(INPUT_POST, 'midname', FILTER_SANITIZE_SPECIAL_CHARS);
	$lName = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_SPECIAL_CHARS);
	$newpass = filter_input(INPUT_POST, 'newpass');
        $oldpw1 = filter_input(INPUT_POST, 'oldPW1');
        $oldpw2 = filter_input(INPUT_POST, 'oldPW2');
	$emailaddr = filter_input(INPUT_POST, 'email');
	$user = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        
        #Get data that is currently in the database, for comparison and stuff
        $GetUserDetailsQuery = "SELECT userFirstName, userMiddleName, userLastName, userPW, userEmail, userName "
                . "FROM userstable WHERE userName = '" . $user . "'"; #prepare query for getting info from the db
        $GetUserDetails = $db->prepare($GetUserDetailsQuery); #prepare the query
        $GetUserDetails->execute(); #execute the query
        $UserDetails = $GetUserDetails->fetch(); #store the details in an array 
        print_r($UserDetails);
        
	#STEPS: 
	# 1: Make sure no fields are null, else redirect with err message
	# 2: Make sure oldPW1, oldPW2, and userPW match
	# 3: try to update table fields - report success
	# 4: catch error if it does not - report failure
	# 5: return to settings.php
	
	/*
            TODO:
            Validate each one being non-null and meeing that field's requirements, else error message
            For the time being we'll have to let everything go for the sake of functionality and moving forward.
	*/
        #2: Make sure old passwords from form and password in db all match
        if($oldpw1 == $oldpw2 && $oldpw1 == $UserDetails['userPW'] && $oldpw2 == $UserDetails['userPW']){
            
            #Everything is nested because we'll only operate if all PWs match
            
            #3: try to update table fields, report success
            try{
                $UpdateUserQuery = "UPDATE userstable SET "
                        . "userFirstName = '" . $fName . "', "
                        . "userMiddleName = '" . $mName . "', "
                        . "userLastName = '" . $lName . "', "
                        . "userPW = '" . $newpass . "', "
                        . "userEmail = '" . $emailaddr . "', "
                        . "userName = '" . $user . "' "
                        . "WHERE userName = '" . $_COOKIE['username'] ;  
                

                $UpdateUser = $db->prepare($UpdateUserQuery);
                $UpdateUser->execute();
             } catch (PDOException $err) {
        
                //Print out the error code if we can't
                $error = $err->getMessage();
                echo "<h2>Error: " . $error . "</h2>"; 
            } //end of catch
            
        } //end of if
            
        #header("Location: http://localhost/Comp269Proj/Settings.php"); #redirect
        
        /*
        $CreateUserQuery = "INSERT INTO usersTable VALUES (" . $userID . ", " .
                "'" . $fName . "', " . 
                "'" . $mName . "', " . 
                "'" . $lName . "', " . 
                "'" . $pass . "', " . 
                "'" . $emailaddr . "', " . 
                "'" . $user . "')";  #May need semi-colon?

        $CreateUser = $db->prepare($CreateUserQuery);
        $CreateUser->execute();
        */