<?php 
    /*
	#Connect to database -> validate input -> redirect appropriately
        require('AccountManager.php');
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
    
    
	$user = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
	$pass = filter_input(INPUT_POST, 'password');
        
	
        $GetUserQuery = "SELECT userPW FROM userstable WHERE userName='" . $user . "'";
        $GetUser = $db->prepare($GetUserQuery);
		$GetUser->execute();
        $PWfromDB = $GetUser->fetch();
		echo('<h1> Password from input: ' . $pass . ', password from db: ' . $PWfromDB[0] . '</h1>');
		
        if ($pass != $PWfromDB[0]){
			require("./../index.php"); #redirect
			echo('<h1>Username or Password not matched</h1>');
		} else if ($pass == $PWfromDB[0]){
			
			setcookie('username', $user);
			header("Location: http://localhost/Comp269Proj/Settings.php"); #redirect
		}
      
        
		
        /*
		
		TO DO: Just try to connect as this user to determine whether they can be logged in or not
		
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