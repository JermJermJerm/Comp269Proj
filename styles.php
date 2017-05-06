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
.bigContainer{
	width: 500px;
	height: 400px;
	border: 1px #bdc3c7 solid;
	border-radius: 25px;
	display: block;
	margin: 0 auto;
}

form{
	width: 350px;
	display: block;
	margin: 0 auto;
	height: 50px;
}

label{
	display: block;
	float: left;
	clear: left;
	width: 150px;
	color: #ecf0f1;
        height: 21px;
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
	padding-top: 25px;
        width: 350px;
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
	width: 33.33%;
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
    border: 1px white solid;
}
.project, .team{
	width: 100%;
        list-style: none;
	/*border: 1px #2ecc71 solid;*/
	background-color: #2980b9;
	padding-left: 0;
}

.project li{
    padding-left: 25px;
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

.ErrorMessage{
    color: orange;
}

#tasksUL{
    list-style: none;
    padding-left: 0;
}

#tasksUL li form{
    height: 21px;
}

.task{
    width: 100%;
    height: 75px;
    font-size: 20px;
    color: #ecf0f1;
    
    //#background-color: #2980b9;
    margin: 5px auto;
}

.task.complete{
    background-color: green;
}
.task.incomplete{
    background-color: red;
}

.task li{
    padding-left: 25px;
}

.hiddenForm{
    height: 22px;
    margin-right: 25px;
    padding-bottom: 5px;
}