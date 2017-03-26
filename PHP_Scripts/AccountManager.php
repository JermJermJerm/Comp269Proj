<?php	
    /*	
        Connect to the database as the account manager
        Only has permissions on the usersTable 
    */

    $dsn = 'mysql: host=localhost;dbname=studentsdb';
    $user = 'AccountManager';
    $pass = 'one';
    
    

    
    Try {
        /*
            PHP Data object that we provide args in order to connect to the database
            Will be used to execute commands to get and change records
        */
        
        $db = new PDO($dsn, $user, $pass);
        
    } catch (PDOException $err) {
        
        //Print out the error code if we can't
        $error = $err->getMessage();
        echo "<h2>Error: " . $error . "</h2>"; 
    }