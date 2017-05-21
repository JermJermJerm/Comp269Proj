<?php 
        /*
            #Connect to database -> validate input -> redirect appropriately
            require('AccountManager.php');

            #$missingFields = array();
        */
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
        
	$fName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
	$mName = filter_input(INPUT_POST, 'middleName', FILTER_SANITIZE_SPECIAL_CHARS);
	$lName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
	$pass = filter_input(INPUT_POST, 'password');
	$emailaddr = filter_input(INPUT_POST, 'email');
	$user = filter_input(INPUT_POST, 'userName');
        
        
        $userMissingInput = FALSE; #bool, marks if any required field is missing
        
        #required fields: fname, lname, pass, user
        if($user==NULL || $user==" "){
            $missingField = "Username";
            $userMissingInput=TRUE;
        } else if($fName==NULL){
            $missingField = "First name";
            $userMissingInput=TRUE;            
        } else if($lName==NULL){
            $missingField = "Last name";
            $userMissingInput=TRUE;            
        } else if($pass==NULL){
            $missingField = "Password";
            $userMissingInput=TRUE;            
        } 
        
        #Set an alert message if a required field is missing
        if($userMissingInput==TRUE){
            setcookie('loginErrMsg', "Missing required field: " . $missingField, time()+3600, "/");
            header("Content-Length: 0"); #tell the server there's nothing else to execute so the redirect happens
            header("Location: http://localhost/DoWhatNow/index.php");
        }
        else { #Only check if a username is available if the user supplies one
            
            $checkUsernameQuery = "SELECT * FROM usersTable WHERE username = '" . $user . "'";
            $checkUsername = $db->prepare($checkUsernameQuery);
            $checkUsername->execute();
            $usernameAvailable = $checkUsername->fetch();

            #Look for results matching to the username, if usernameAvailable is not null the username is taken
            if($usernameAvailable != NULL){
                $errorMsg = 'The username "' . $user . '" is unavailable. Please try another.';
                setcookie('loginErrMsg', $errorMsg , time()+3600, "/");
                header("Content-Length: 0"); #tell the server there's nothing else to execute so the redirect happens
                header("Location: http://localhost/DoWhatNow/index.php");
            }
            else{
                #Only proceed if the user has given us all required input and the username is not taken
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
                header("Location: http://localhost/DoWhatNow/Settings.php");
            }
        }
?>