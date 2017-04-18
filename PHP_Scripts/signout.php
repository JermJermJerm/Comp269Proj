<?php
	
	session_destroy();
	
	#starting a brand new session will create a new, empty session
	#destroying that empty session will make sure we are Cleansed
	session_start();
	session_destroy();
	
	
    header("Location: ./../index.php");