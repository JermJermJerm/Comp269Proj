<?php 
    /*
	#Connect to database -> validate input -> redirect appropriately
        require('AccountManager.php');
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
    
	$user = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
	$pass = filter_input(INPUT_POST, 'password');
	
        #We will only progress if neither user nor pass are non-null
        if($user!=NULL && $pass!=NULL){
            
        $GetUserQuery = "SELECT userPW, userID FROM userstable WHERE userName='" . $user . "'";
        $GetUser = $db->prepare($GetUserQuery);
	$GetUser->execute();
        $UserDetails = $GetUser->fetch();
        $GetUser->closeCursor();
        
	#echo('<h1> Password from input: ' . $pass . ', password from db: ' . $PWfromDB[0] . '</h1>');
		
            if ($pass != $UserDetails['userPW']){
                    setcookie("loginErrMsg", 'Username or Password not matched', time()+3600, '/');
                    header("Location: http://localhost/DoWhatNow/"); #redirect
                } else if ($pass == $UserDetails['userPW']){

                    setcookie("username", $user, time() + 86400, '/');

                    header("Location: http://localhost/DoWhatNow/Settings.php"); #redirect
                }
        } else{
            
            setcookie("loginErrMsg", 'No username or password supplied', time()+3600, '/');
            #redirect if no input is supplied.
            header("Location: http://localhost/DoWhatNow/");
        }
        