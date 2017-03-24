<?php
<<<<<<< HEAD
	
	/*	
		Domain to connect to with credentials - this is all for testing
		In the future there will be a limited-access account that will access the db
		to create users, delete users, and grant users permissions
	*/
	$dsn = 'mysql:dbname=test;host=127.0.0.1';
	$user = 'root';
	$pass = '';
	
	/*
		PHP Data object that we provide args in order to connect to the database
		Will be used to execute commands to get and change records
	*/
	$db = new PDO($dsn, $user, $password);
	
	//Use a try catch in the future to get connection success /errors

?>
=======
	//PDO = dsn, username, password
	//Create Php Database Object parameters
	$dsn = "mysql:host=localhost;dbname=studentsDB";
	$username = "root";
	$password = "";
	
    Try {
        
		//try to connect to the database using the parameters we set
		$db = new PDO($dsn, $username, $password);
    } catch (PDOException $err) {
        
        //Print out the error code if we can't
        $error = $err->getMessage();
        echo "<h2>Error: " . $error . "</h2>"; 
    }
>>>>>>> origin/master
