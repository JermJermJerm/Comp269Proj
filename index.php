<?php 
    
    #include('PHP_Scripts/connectToDB.php');
    #Check if someone is logged in, redirect if they are
    $Username = filter_input(INPUT_COOKIE, 'username');
    if ($Username != NULL){
        header("Location: http://localhost/Comp269Proj/Settings.php");
    }
    $loginError = filter_input(INPUT_COOKIE, 'loginErrMsg');
    if($loginError != NULL){
        #output error message if it exists, then unset it
        echo('<h2 class="ErrorMessage">' . $loginError . '</h2>');
        setcookie('loginErrMsg', '', time()-86400, '/');
    }
    
?>

<html>

<head>
	<!-- CSS and JS -->
	<link href="styles.php" type="text/css" rel="stylesheet"/>
</head>

<body>



    <h1 id="dowhatnow">Do What Now?</h1>
    <h2>Log in or create an account</h2>

    <div id="indexContainer">

            <h3>Log in</h3>
            <form action="PHP_Scripts/login.php" method="post" id="logInForm">
                    <label>Username</label>
                    <input type="text" id="userName" name="username" maxlength="20" placeholder="Username">

                    <label>Password</label>
                    <input type="password" id="password" name="password" maxlength="32" placeholder="Password">

                    <input type="Submit" value="Log in" class="submitButton">
            </form>
        <br>
        <hr>
        <br>
            <h3>Create an account</h3>
            <form action="PHP_Scripts/account_create.php" method="post" id="createAccountForm">

                    <label>Username<span class="required">*</span>:</label>
                    <input type="text" id="userName" maxlength="20" name="userName" placeholder="Username">
                    <br>
                    <label>First Name<span class="required">*</span>:</label>
                    <input type="text" id="firstName" maxlength="20" name="firstName" placeholder="First name">
                    <br>
                    <label>Middle Name:</label>
                    <input type="text" id="middleName" maxlength="20" name="middleName" placeholder="Middle name">
                    <br>
                    <label>Last Name<span class="required">*</span>:</label>
                    <input type="text" id="lastName" maxlength="20" name="lastName" placeholder="Last name">
                    <br>
                    <label>Password<span class="required">*</span>:</label>
                    <input type="text" id="password" maxlength="32" name="password" placeholder="Password">
                    <br>
                    <label>Email Address:</label>
                    <input type="text" id="email" maxlength="32" name="email" placeholder="email@address.com">
                    <br>
                    <input type="submit" value="Create account" class="submitButton">

            </form>

    </div>
</body>

</html>