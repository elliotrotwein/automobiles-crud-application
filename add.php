<?php

require_once "pdo.php";
session_start();

	if (!isset($_SESSION['name'])) {
		die("ACCESS DENIED");
	}
	if (isset($_POST['cancel'])){
		header("Location: index.php");
		exit();
	}

	if (isset($_POST['add'])){
		if (empty($_POST['make']) || empty($_POST['model']) || empty($_POST['year']) || empty($_POST['mileage'])) {
		  $_SESSION['add'] = "All fields are required";
                  header("Location: add.php");
                  return;	
		}
		else if(!is_numeric($_POST['mileage']) || !is_numeric($_POST['year']) || is_null($_POST['mileage']) || is_null($_POST['year'])){
		   $_SESSION['add'] = "Mileage and year must be numeric";
		   header("Location: add.php");
		   return;
		} 
		/*
		 * TODO: Implement numeric validaiton for make and model
		else if (is_numeric($_POST['make']) || is_numeric($_POST['model'])) {
		   $_SESSION['add'] = "Make and model must not be numeric";
                   header("Location: add.php");
                   return;
		} */
		else {
		}
	}

## MODEL
  		
	if (isset($_POST['add']) && !isset($_SESSION['add']) ){
        $stmt = $pdo->prepare('INSERT INTO autos
	(make, model, year, mileage) VALUES ( :mk, :mo, :yr, :mi)');
         $stmt->execute(array(
	':mk' => $_POST['make'],
        ':mo' => $_POST['model'],
        ':yr' => $_POST['year'],
        ':mi' => $_POST['mileage'])
	);
	$_SESSION['success'] = "Record added";
	header("Location: index.php");
        return;	
	}

?>
<!-- VIEW -->
<!DOCTYPE html>
<html>
  <head>
	<title>Elliot Rotwein</title>
   <?php require_once "bootstrap.php"; ?>
  </head>
  <body>
<div class="container">
<?php
if ( isset($_SESSION['name']) ) {
    echo "<h1>Tracking Autos for ".htmlentities($_SESSION['name'])."</h1>\n";
}
?>
<form method="post">
<?php
if (isset($_SESSION['add'])){
        echo('<p style="color: red;">'.htmlentities($_SESSION['add'])."</p>");
        unset($_SESSION['add']);
}
?>
 <label for="make">Make:</label>
 <input type="text" name="make"><br>
 <label for="model">Model:</label>
 <input type="text" name="model"><br>
 <label for="year">Year:</label>
 <input type="text" name="year"><br>
 <label for="mileage">Mileage:</label>
 <input type="text" name="mileage"><br>
<input type="submit" name="add" value="Add">
<input type="submit" name="cancel" value="Cancel">
</form>
</div>
</body>
</html>
