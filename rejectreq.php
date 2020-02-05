<?php include "database.php" ?>
<?php

session_start();
$email = $_SESSION['femail'];
$requestee_deny = $_POST["reject"];
$sql2 = "CALL reject(?,?)";
        $stmt2 = $link->prepare($sql2);
        $stmt2->bind_param('ss', $requestee_deny, $email);        
	    $stmt2->execute();
        //run the store proc
        //if (!$stmt2->execute()) {
        //    die( "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
        //}
        $stmt2->close();
        // header("location: home.php");
        header('refresh:3; url=home.php');
		echo "Friend request has been denied.";
		echo "<br>";
		echo "You will be redirected to home page in 3 seconds";

?>