<?php	
    /*	
        Domain to connect to with credentials - this is all for testing
        In the future there will be a limited-access account that will access the db
        to create users, delete users, and grant users permissions
    */
    $dsn = "mysql:host=localhost;dbname=doWhatNowDB";
    $user = 'root';
    $pass = '';
	
    /*
        PDO / PHP Data object that we provide args in order to connect to the database
        Will be used to execute commands to get and change records
    */
    Try {
	$db = new PDO($dsn, $user, $pass);
    } catch (PDOException $err) {
        
        //Print out the error code if we can't
        $error = $err->getMessage();
        echo "<h2>Error: " . $error . "</h2>"; 
    }