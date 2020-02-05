<?php include "header.php" ?>
</head>
<body>
<?php include "nav.php" ?>
	<?php
		session_start();
		$cemail = $_SESSION['jmail'];
		$receive = $_SESSION['receiving'] ;
		$thread = $_SESSION['threading'] ;
		$subject = $_SESSION['subjecting'];
		$message = $_SESSION['messaging'];
		$friendmail = $_POST['send'];

        $sql1 = "CALL frienddnemail (?,?,?,?,?,?)";
		$statement = $link->prepare($sql1);
		$statement->bind_param('isssss', $receive, $friendmail, $cemail, $thread, $subject, $message);
		$statement->execute();
		$result = $statement->get_result();
		          //  $result = $link->query($sql);
		  ?>       
		 <form action="newmessage.php" method="post" id="form_new_5">
              
              <input type="hidden" name="receivertype" value="<?=$receive?>"/>
              
              <input type="hidden" name="thread" value="<?=$thread?>"/>
              <input type="hidden" name="subject" value="<?=$subject?>"/>
              <input type="hidden" name="message" value="<?=$message?>"/>
         <?php
              echo "<button name='back' value=''>Go Back to Friends List</button><br>";
       
		// header('refresh:3; url=newmessage.php');
		// echo "The message has been sent to your friend";
		// echo "<br>";
		// echo "You will be redirected to yor friends list in 3 seconds";
		// //$result->close();
		// echo "</ul>";



		?>
	</body>

	</html>
		