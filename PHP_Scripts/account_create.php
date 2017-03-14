<?php 
	#Connect to database -> validate input -> redirect or 
	require('connectToDB.php');
	
	$missingFields = array();
	
	$user = filter_input[INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS];
	$fName = filter_input[INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS];
	$mName = filter_input[INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS];
	$lName = filter_input[INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS];
	$pass = filter_input[INPUT_POST, 'pw'];
	$emailaddr = filter_input[INPUT_POST, 'email'];
	
	#Validate each one being non-nuyll and meeing that field's requirements, else error message
	
	if($user == NULL){
		$missingFields += $user;
	}
	
	if($fName == NULL){
		$missingFields+=$fName;
	}
	
	if($lname == NULL{
		$missingFields += $lName;
	}
	
	if $($pass == NULL){                                                            
		$missingFields += $pass;
	}
	
	if ($emailaddr == NULl){
		$missinFields += $emailAddr;
	}
	else if ($str_pos($emailAddr, "@")!==FALSE){
		$missingFields += $emailAddr;
	}
	
	if ($missingFields.count() > 0){
		include('index.php');
		//Redirect
	} else {
		$query = 
	}