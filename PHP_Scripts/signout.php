<?php
	session_destroy(); #end session
	$_SESSION = array(); #unset session variables
        
        setcookie("username", "", time() - 86400, "/"); #delete username cookie by setting it in the past
        setcookie("userID", "", time() - 86400, "/"); #delete userID cookie
        setcookie("ViewingProjectID", "", time() - 86400, "/"); #delete userID cookie
    header("Location: ./../index.php"); 