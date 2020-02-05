<?php include "database.php" ?>
<?php

session_start();
$email = $_SESSION['demail'];
$send = $_POST["send"];

$sql1 = "select uemail_1, uemail_2 from friend_request where uemail_1 = '$email' and uemail_2='$send'";
$result = $link->query($sql1);
if ($result->num_rows <= 0)
{
$sql2 = "CALL frequest(?,?)";
        $stmt2 = $link->prepare($sql2);
        $stmt2->bind_param('ss', $email, $send);        
	$stmt2->execute();
        //run the store proc
        //if (!$stmt2->execute()) {
        //    die( "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
        //}
        $stmt2->close();
        header("location: home.php");
}
else
{
header('refresh:3; url=home.php');
echo "The request has already been sent";
echo "<br>";
echo "You will be redirected to home page in 3 seconds";
}


?>