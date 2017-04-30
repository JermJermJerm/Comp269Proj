<?php
	session_destroy(); #end session
	$_SESSION = array(); #unset session variables
        setcookie("username", "", time() - 3600, "/"); #delete username cookie by setting it in the past
        
    header("Location: ./../index.php");