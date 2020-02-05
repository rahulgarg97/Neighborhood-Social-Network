<!DOCTYPE html>
<html lang="en">
<?php include 'database.php';?>
<body>

<?php	
   

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $neighborhood = $_POST['n_name'];

    session_start();	
    $signup_email3= $_SESSION['signup_email2'];
    echo("{$_SESSION['signup_email2']}");
    echo $neighborhood;    
    $_SESSION['signup_email4'] = $signup_email3;

    $_SESSION['signup_neighborhood'] = $neighborhood;
     
   

    $blocks = "select block_id from block where neighborhood_id=(select neighborhood_id from neighborhood where neighborhood_name='$neighborhood')";
    $result = $link->query($blocks);
if($result->num_rows>0)
{	
	while($row = $result->fetch_assoc())
	{	
		$button_value = $row["block_id"];
		echo "<button name='b_id' form = 'form_new_1' value = '$button_value'>".$row["block_id"]."</button>";
	}
} }
$link->close();
?>


<form action="confirmation2.php" method="post" id="form_new_1">
</form>

