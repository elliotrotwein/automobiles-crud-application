<?php

require_once "pdo.php";
session_start();

// Check to see if user is logged in
// $_SESSION['name'] is created in login.php once the user logs in successfully
$loggedIn = isset($_SESSION['name']);


// Query for data
$stmt = $pdo->query("SELECT * FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
  <head>
	<title>Elliot Rotwein's Automobiles</title>
  </head>
  <body>
	<h3>Welcome to the Automobiles Database</h3>
  <p>
    <?php
      if (isset($_SESSION['success'])) {
        echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
	unset($_SESSION['success']);
    } ?>
  </p> 
<?php
  if (!$loggedIn) {
    echo "<a href='login.php'>Please log in</a>";
    echo "<p>Attempt to go to <a href='add.php'>add data<a/> without logging.</p>";
  } else if (!$rows) {
    // if there are no automobiles in the database	  
    echo "<p>No rows found</p>";
  } else { ?>  
    <table border="1">
      <tr>
	<th>Make</th>
        <th>Model</th>
	<th>Year</th>
        <th>Mileage</th>
        <th>Action</th>
      </tr>
	<?php for ($i=0;$i<count($rows);$i++){ ?>
	<tr>
	  <td><?php echo htmlentities($rows[$i]['make']); ?></td>
      	  <td><?php echo htmlentities($rows[$i]['model']); ?></td>
	  <td><?php echo htmlentities($rows[$i]['year']); ?></td>
   	  <td><?php echo htmlentities($rows[$i]['mileage']); ?></td> 
	  <td><a href="edit.php?autos_id=<?php echo htmlentities($rows[$i]['autos_id']);?>">Edit<a/>/<a href="delete.php?autos_id=<?php echo htmlentities($rows[$i]['autos_id']);?>">Delete</a></td>
	</tr>
  <?php }
  echo "</table>";
  }
  if ($loggedIn){
?>
    <p><a href='add.php'>Add New Entry</a></p>
    <p><a href='logout.php'>Logout</a></p>
<?php } ?>
  </body>
</html>
