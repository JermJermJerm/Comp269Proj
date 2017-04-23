<?php
	#Get rid of all the existing session data and redirect
	session_destroy();
	$_SESSION = array();
        
    header("Location: ./../index.php");