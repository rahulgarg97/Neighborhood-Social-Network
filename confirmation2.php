<html lang="en">
<?php include 'database.php';?>
<body>

<?php	
   

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $block = $_POST['b_id'];
    session_start();	
    $email= $_SESSION['signup_email4'];
    $neighborhood = $_SESSION['signup_neighborhood'];   
    
    echo $email;    
    echo $neighborhood;
    echo $block;

$sql1 = "select neighborhood_id from neighborhood where neighborhood_name = '$neighborhood'";
$result = $link->query($sql1);
if ($result -> num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{	
		$GLOBALS['n_id'] = $row["neighborhood_id"];
 	
	}
	
}
echo $n_id;
$sql2 = "CALL applying(?,?,?)";
$stmt2 = $link->prepare($sql2);
$stmt2->bind_param('sii', $email, $n_id, $block);
$stmt2->execute();
        //run the store proc
$stmt2->close();
echo "Your block join request has been submitted";
      


}

?>
<a href="login.php">Login here</a>
</body>
</html>