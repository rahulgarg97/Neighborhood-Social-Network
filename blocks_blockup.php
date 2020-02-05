<!DOCTYPE html>
<html lang="en">
<?php include 'database.php';?>
<body>
	
<form name="gg" action = "confirmation2.php" method="post">

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $neighborhood = $_POST["name"];

<?php
    $blocks = "select block_id from block where neighborhood_id=(select neighborhood_id from neighborhood where neighborhood_name='$neighborhood')";
    $result = $link->query($blocks);

?>

<select name1 = "block_id">
<?php
    while ($row = $result->fetch_assoc()) 
    {
    	$name1 = $row['block_id'];
        echo "<option value = '$name1' >$name1 </option>";
	}
?> 

<input type = "submit">

header("location: confirmation2.php");
