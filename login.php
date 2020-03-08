<?php 

session_start();

if ( isset($_POST['cancel'] ) ) {
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
// Hash corresponds to password 'php123'
$storedHash = '1a52e17fa899cf40fb04cfc42e6352f1';

// Check to see if we have some POST data, if we do process it
if ( isset($_POST['email']) && isset($_POST['pass']) ) {
	$check = hash('md5', $salt.$_POST['pass']);

	// Validation to protect against empty email or password 
	if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
            $_SESSION['error'] = "User name and password are required";
	    error_log("Login fail ".$_POST['email']." $check");
	    header("Location: login.php");
	    return;
	}  

	// check if there is an '@' sign
	$containsAtSign = false;
	for($i=0;$i<strlen($_POST['email']);$i++){
		if ($_POST['email'][$i] === '@') {
			$containsAtSign = true;
     		   }
	}

	// Validation to protect against email without '@' sign	
    	if (!$containsAtSign) {
		$_SESSION['error'] = "Email must have an at-sign (@)";
		error_log("Login fail ".$_POST['email']." $check");
		header("Location: login.php");
		return;
	}

	// Redirect user to index.php page if user name is valid and passoword is correct
	else if ( $check == $storedHash ) {
		// Redirect browser to view.php
		unset($_SESSION['name']);
		$_SESSION['name'] = $_POST['email'];
                error_log("Login success ".$_POST['email']);
		header("Location: index.php");
		return;

	// Notify the user if email is valid but they've input an incorrect password	
	} else {
	    $_SESSION['error'] = "Incorrect password";
            error_log("Login fail ".$_POST['email']." $check");
	    header("Location: login.php");
            return;
     }
}

?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "bootstrap.php"; ?>
<title>Elliot Rotwein's Automobiles</title>
</head>
<body>
<div class="container">
<h1>Please log in</h1>
<?php
// Flash error on screen in red if the user has not passed validation
if (isset($_SESSION['error'])) {
	echo('<p style="color:red;">'.htmlentities($_SESSION['error'])."</p>\n");
	unset($_SESSION['error']);
}
?>
<form method="POST">
<label>User Name</label>
<input type="text" name="email"><br/>
<label>Password</label>
<input type="text" name="pass"><br/>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>View the HTML source code for this page (by doing right-click and inspect) to find the password.</p>
<!-- Password = php123 --!>
</div>
</body>
