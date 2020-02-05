<!DOCTYPE html>
<html lang="en">
<?php include 'database.php';?>
<body>
	
<?php
    session_start();	
    $signup_email= $_SESSION['signup_email'];
    echo("{$_SESSION['signup_email']}");
    $_SESSION['signup_email2'] = $signup_email;


    $neighborhoods = "select neighborhood_name from neighborhood";
    $result = $link->query($neighborhoods);
if($result->num_rows>0)
{		
	while($row=$result->fetch_assoc())
	{
		$button_value = $row["neighborhood_name"];
		echo "<button name='n_name' form = 'form_new' value = '$button_value'>".$row["neighborhood_name"]."</button>";
	}
}	
$link->close();
?>

<form action="blocks.php" method="post" id="form_new">
</form>


<form action="confirmation2.php" method="post" id="form_new">
</form>



</body>
</html>