<?php 
	header("Content-type: text/css"); 
?>

body{
	background-color: #34495e;
}

h1, h2, h3{
	text-align: center;
	color: #3498db;
}

/*specific h1 that says DoWhatNow*/
#dowhatnow{
	color: #2ecc71;
}

/*Big, centered block with round corners*/
#bigContainer{
	width: 500px;
	height: 400px;
	border: 1px #bdc3c7 solid;
	border-radius: 25px;
	display: block;
	margin: 0 auto;
}

form{
	width: 300px;
	display: block;
	margin: 0 auto;
	height: 50px;
}

label{
	display: block;
	float: left;
	clear: left;
	width: 100px;
	color: #ecf0f1;
}

input{
	display: block;
	float: right;
	clear: right;
}

/*Submit buttons are input elements
so by default they float left and don*/
.submitButton{
	float:right;
	margin-left: 75px;
}

hr{
	width: 400px;
	height: 1px;
	display: block;
	clear: both;
	margin: 0 auto;
	margin-top: 10px;
	background-color: green;
}

/*Form on the Settings page*/
#settingsForm{
	width: 400px;
	height: 225px;
	padding: 25px;
	border: 1px #bdc3c7 solid;
	border-radius: 25px;
}

/*Banners on the top of webpages besides login / account creation*/
.topbanner{
	width: 100%;
	margin: 0;
	margin-top: 5px;
	text-align: center;
	background-color: #3498db;
}
.topbanner p{
	margin: 0;
	color: #ecf0f1;
}

/*navUL styles - nav at the top of the non-home webpages*/
.navUL{
	height: 25px;
	width: 100%;
	display: block;
	clear: both;
	margin: 0;
	padding: 0;
	text-align: center;
}

.navUL li{
	height: auto;
	margin: 0;
	padding: 0;
	width: 20%;
	text-align: center;
	background-color: #2980b9;
	display: block;
	float: left;
	list-style: none;
}

.navUL li a{
	margin-top: 15px;
	color: #ecf0f1;
	
}

/*Styles for the Projects and Teams webpages, they're just lists'*/
#projectDiv, #teamsDiv{
	width: 500px;
	display: block;
	margin: 0 auto;
}
.project, .team{
	width: 450px;
	/*border: 1px #2ecc71 solid;*/
	background-color: #2980b9;
	padding: auto 10px;
}

.team{
	height: 25px;
	margin: 0 auto;
	padding: auto;
	color: #ecf0f1;
	text-align: center;
}

.project li{
	color: #ecf0f1;
}

.project li:first-child{
	font-size: 24px;
	color: #2ecc71;
}


.creationDiv{
	width: 500px;
	display: block;
	margin: 0 auto;
	border: 1px #3498db solid;
	border-radius: 15px;
	#padding-bottom: 
}

.creationDiv h2{
	margin: 10px;
}
.creationForm{
	padding-bottom: 10px;
}