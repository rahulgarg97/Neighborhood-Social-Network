<?php include "database.php" ?>
<?php

session_start();
$email = $_SESSION['kemail'];
$direct = $_POST["add"];
$sql2 = "CALL adddn(?,?)";
        $stmt2 = $link->prepare($sql2);
        $stmt2->bind_param('ss', $email, $direct);        
        $stmt2->execute();
        //run the store proc
        //if (!$stmt2->execute()) {
        //    die( "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
        //}
        $stmt2->close();
        // header("location: home.php");
        header('refresh:3; url=home.php');
		echo "Direct neighbor has been added.";
		echo "<br>";
		echo "You will be redirected to home page in 3 seconds";

?>