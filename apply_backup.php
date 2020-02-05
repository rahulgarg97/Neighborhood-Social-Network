<!DOCTYPE html>
<html lang="en">
<?php include 'database.php';?>
<body>
	
<form name="gg" action = "blocks.php" method="post">
<?php
    $neighborhoods = "select neighborhood_name from neighborhood";
    $result = $link->query($neighborhoods);

?>

<select name = "neighborhood">
<?php
    while ($row = $result->fetch_assoc()) 
    {
    	$name = $row['neighborhood_name'];
        echo "<option value = '$name' >$name </option>";
	}
?> 

<input type = "submit">
</select>
<?php
?>

</form>
</body>
</html>