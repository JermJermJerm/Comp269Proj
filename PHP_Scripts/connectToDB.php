<?php
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