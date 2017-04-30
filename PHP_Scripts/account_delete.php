<?php 
    $dsn = 'mysql:host=localhost;dbname=studentsdb';
    $dbu = 'root';
    $dbp = '';
    try{ 
        #connect to db
        $db = new PDO($dsn, $dbu, $dbp);

    } catch (PDOException $err) {

    //Print out the error code if we can't
    $error = $err->getMessage();
    echo "<h2>Error: " . $error . "</h2>"; 
    }
        #Passed from Settings.php
        $user = filter_input(INPUT_POST, 'username');
        
        $deleteAccountQuery = "DELETE FROM userstable WHERE userName='" . $user . "'";
        $deleteAccount = $db->prepare($deleteAccountQuery);
        $deleteAccount->execute();
        $deleteAccount->closeCursor();
        #Delete account from userstable / db
        
        setcookie("username", "", time() - 3600, "/"); #unset username so if other pages are accessed, they won't be usable
        
        $_SESSION = array(); #Delete all session variables
        
        header("Location: http://localhost/Comp269Proj/"); #redirect
	
        