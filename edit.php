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

	// Query for pre-populated data
	$stmt = $pdo->query("SELECT * FROM autos");
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	for ($i=0;$i<count($rows);$i++){
	  if ($rows[$i]['autos_id'] == $_REQUEST['autos_id']){
	    $make = $rows[$i]['make'];
	    $model= $rows[$i]['model'];
	    $year = $rows[$i]['year'];
	    $mileage = $rows[$i]['mileage'];
	    }
	}
	
	if (isset($_POST['save'])){
           if (empty($_POST['make']) || empty($_POST['model']) || empty($_POST['year']) || empty($_POST['mileage'])) {
                  $_SESSION['save'] = "All fields are required";
                  header("Location: edit.php?autos_id=".$_REQUEST['autos_id']);
                  return;
                }
	   	else if (!is_numeric($_POST['mileage']) || !is_numeric($_POST['year']) || is_null($_POST['mileage']) || is_null($_POST['year'])){
                   $_SESSION['save'] = "Mileage and year must be numeric";
                   header("Location: edit.php?autos_id=".$_REQUEST['id']);
                   return;
		}
		/*
		 * TODO: Implement numeric validation for make and model
	        else if (is_numeric($_POST['make']) || is_numeric($_POST['model'])) {
                   $_SESSION['save'] = "Make and model must not be numeric";
                   header("Location: edit.php?autos_id=".$_REQUEST['id']);
                   return;
		} */
		else {
		}
        }

	if (isset($_POST['save']) && !isset($_SESSION['save']) ){
        $stmt = $pdo->prepare('UPDATE autos SET 
	make = :mk, model = :mo, year = :yr, mileage = :mi WHERE autos_id = :id');
	$stmt->execute(array(
	':id' => $_REQUEST['autos_id'],
	':mk' => $_POST['make'],
        ':mo' => $_POST['model'],
        ':yr' => $_POST['year'],
        ':mi' => $_POST['mileage'])
	);
        $_SESSION['success'] = "Record updated";
        header("Location: index.php");
        return;	
	}
?>
<!-- VIEW -->
<!DOCTYPE html>
<html>
  <head>
	<title>Elliot Rotwein's Automobiles</title>
   <?php require_once "bootstrap.php"; ?>
  </head>
  <body>
<div class="container">
  <h1>Editing Automobile</h1>
<form method="post">
<?php
if (isset($_SESSION['save'])){
        echo('<p style="color: red;">'.htmlentities($_SESSION['save'])."</p>");
        unset($_SESSION['save']);
}
?>
 <label for="make">Make:</label>
 <input type="text" name="make" size="60" value="<?php echo htmlentities($make); ?>"><br>
 <label for="model">Model:</label>
 <input type="text" name="model" size="60" value="<?php echo htmlentities($model); ?>"><br>
 <label for="year">Year:</label>
 <input type="text" name="year" size="10" value="<?php echo htmlentities($year); ?>"><br>
 <label for="mileage">Mileage:</label>
 <input type="text" name="mileage" size="10" value="<?php echo htmlentities($mileage); ?>"><br>
<input type="submit" name="save" value="Save">
<input type="submit" name="cancel" value="Cancel">
</form>
</div>
</body>
</html>
